<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cart;
use Carbon\Carbon;
use App\Product;
use App\Payment;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$items = Cart::select(DB::raw('product_id, description, price, sum(quantity) as quantity'))
    			->where('status', 'added')
    			->groupBy('product_id', 'description', 'price')
    			->get();
    	$total = Cart::select(DB::raw('sum(quantity * price) as total'))
    			->where('status', 'added')
    			->get();
    	$totalPrice = $total[0]['total'];

        return view('partials.cart.cart', compact('items', 'totalPrice'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$orders = Payment::all();
    	$merchantId = 508029;
    	$ApiKey = "4Vj8eK4rloUd272L48hsrarnUA";
    	$currency = "COP";
    	$accountId = 512321;
    	$buyerEmail = "test@test.com";
    	return view('partials.forms.order', compact('orders', 'merchantId', 'ApiKey', 'currency', 'accountId', 'buyerEmail'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$products = Cart::select(DB::raw('*'))
			    	->where('status', 'added')
			    	->get();
    	$total = Cart::select(DB::raw('sum(quantity * price) as total'))
		    	->where('status', 'added')
		    	->get();
    	$totalPrice = $total[0]['total'];
    	$dt = Carbon::now();
    	$referenceCode = $dt->year . $dt->month . $dt->day . $dt->hour . $dt->minute . $dt->second . $dt->micro ;
    	foreach ($products as $product) {
    		$item = Cart::find($product->id);
    		$item->referenceCode = $referenceCode;
    		$item->status = "order";
    		$item->update();
    	}
    	$merchantId = 508029;
    	$ApiKey = "4Vj8eK4rloUd272L48hsrarnUA";
    	$currency = "COP";
    	$accountId = 512321;
    	$buyerEmail = "test@test.com";
    	$order = new Payment();
    	$order->status = 'ready';
    	$order->referenceCode = $referenceCode;
    	$order->price = $totalPrice;
    	$order->signature = md5($ApiKey . '~' . $merchantId . '~' . $referenceCode . '~' . $totalPrice . '~' . $currency);
    	$order->save();
    	$orders = Payment::all();
    	return view('partials.forms.order', compact('orders', 'merchantId', 'ApiKey', 'currency', 'accountId', 'buyerEmail'));
    	
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	return view('partials.home.instructions');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	Payment::where('referenceCode', $id)->update(['status' => 'cancelled']);
    	Cart::where('referenceCode', $id)->update(['status' => 'cancelled']);
    	$products = Cart::where('referenceCode', $id)->get();
    	foreach ($products as $product) {
    		Product::where('id', $product->product_id)->increment('quantity', 1);
    	}
    	return redirect('/showOrders');
    }
}
