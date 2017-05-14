<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cart;
use Carbon\Carbon;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$products = Cart::all()
			    	->where('status', 'added')
			    	->get();
    	dd($products);
    	$total = Cart::select(DB::raw('sum(quantity * price) as total'))
    	->where('status', 'added')
    	->get();
    	$totalPrice = $total[0]['total'];
    	$dt = Carbon::now();
    	$referenceCode = $dt->year . $dt->month . $dt->day . $dt->hour . $dt->minute . $dt->second . $dt->micro ;
    	$merchantId = 508029;
    	$ApiKey = "4Vj8eK4rloUd272L48hsrarnUA";
    	$currency = "COP";
    	$accountId = 512321;
    	$buyerEmail = "test@test.com";
    	$signature = md5($ApiKey . '~' . $merchantId . '~' . $referenceCode . '~' . $totalPrice . '~' . $currency);
    	return view('partials.cart.cart', compact('items', 'totalPrice', 'referenceCode', 'merchantId', 'ApiKey', 'currency', 'accountId', 'buyerEmail', 'signature'));
    	
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }
}
