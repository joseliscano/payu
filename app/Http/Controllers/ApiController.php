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
        unset($response['XSRF-TOKEN']);
        unset($response['laravel_session']);
        return view('partials.result.result', compact('response'));

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
    	error_log("Response: " . print_r($request->input(), true) . "\n", 3, 'files/confirmation' . $request->reference_sale . '.txt');
    	switch ($request->response_message_pol){
    		case "APPROVED":
    			Payment::where('referenceCode', $request->reference_sale)->update(['status' => 'confirmed']);
    			Cart::where('referenceCode', $request->reference_sale)->update(['status' => 'confirmed']);
    			break;
    			
    		case "REJECTED":
    			Payment::where('referenceCode', $request->reference_sale)->update(['status' => 'rejected']);
    			Cart::where('referenceCode', $request->reference_sale)->update(['status' => 'rejected']);
    			break;
    			
    		case "PENDING":
    			Payment::where('referenceCode', $request->reference_sale)->update(['status' => 'pending']);
    			Cart::where('referenceCode', $request->reference_sale)->update(['status' => 'pending']);
    			break;
    			
    		default:
    			Payment::where('referenceCode', $request->reference_sale)->update(['status' => $request->response_message_pol]);
    			Cart::where('referenceCode', $request->reference_sale)->update(['status' => $request->response_message_pol]);
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
