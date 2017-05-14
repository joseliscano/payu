<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Product;

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
        if ($response['lapTransactionState'] == 'APPROVED') {
        	session()->flash('message', 'Transacción aprobada!');
        	return view('partials.result.result', compact('response'));
        }
    	error_log("Llega index: " . print_r($_REQUEST, true) . "\n", 3, 'files/response' . Carbon::now() . '.txt');
        $products = Product::all();
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
    	error_log("Llega: api post \n", 3, 'files/confirmation' . Carbon::now() . '.txt');
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
