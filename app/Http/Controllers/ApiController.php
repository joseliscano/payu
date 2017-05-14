<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Product;
use App\Payment;
use App\Cart;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function index()
    {
        $response = $_REQUEST;
        error_log("Llega index: " . print_r($_REQUEST, true) . "\n", 3, 'files/response' . Carbon::now() . '.txt');
        if ($response['lapTransactionState'] == 'APPROVED') {
        	session()->flash('message', 'Transacción aprobada!');
        	return view('partials.result.result', compact('response'));
        }
        return redirect('/');
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
    	error_log("Llega: " . print_r($request->input(), true) . "\n", 3, 'files/confirmation' . Carbon::now() . '.txt');
    	$payment = Payment::where('referenceCode', $request->reference_sale)->update(['status' => 'confirmed']);
    	//$payment->status = "confirmed";
    	//$payment->save();
    	var_dump($payment);
    	die();
    	
    	/*App\Flight::where('active', 1)
    	->where('destination', 'San Diego')
    	->update(['delayed' => 1]);*/
    	
    	$cart = Cart::all()->where('referenceCode', $request->reference_sale);
    	switch ($request->response_message_pol){
    		case "APPROVED":
    			$payment->status = "confirmed";
    			$cart->status = "confirmed";
    			$payment->update();
    			$cart->update();
    			break;
    			
    		case "REJECTED":
    			break;
    			
    		case "PENDING":
    			break;
    			
    		default:
    			error_log("No valid Status. \n", 3, 'files/confirmation' . Carbon::now() . '.txt');
    	}
    	return response()->json('Received', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	error_log("Llega: " . print_r($id, true) . "\n", 3, 'files/response' . Carbon::now() . '.txt');
    	$products = Product::all();
    	return redirect('/');
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
