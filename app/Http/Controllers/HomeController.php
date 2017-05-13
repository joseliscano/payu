<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('partials.home.home', compact('products'));
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
    	$products = Product::all();
    	$checkAvailable = Product::find($request->product_id);
    	$quantity = $checkAvailable->quantity;
    	if ($quantity <= 0) {
    		session()->flash('notAvailable', 'No hay unidades disponible de este producto.');
    		return view('partials.home.home', compact('products'));
    	}
    	$checkAvailable->quantity = $checkAvailable->quantity - 1;
    	$checkAvailable->update();
    	$product = new Cart();
        $product->product_id = $request->product_id;
        $product->price = $request->price;
        $product->description= $request->description;
        $product->quantity = 1;
        $product->status = "added";
        $product->created_at= Carbon::now();
        $product->updated_at= Carbon::now();
        $product->save();
        $products = Product::all();
        session()->flash('message', 'Se ha añadido el producto al carrito.');
        return view('partials.home.home', compact('products'));
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
