<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('master');
    }

    public function allData()
    {
        $products = Product::all();
        return Datatables::of($products)
            ->addColumn('action', function ($product) {
                return '<button data-id="'. $product->id.'" data-name="'. $product->name.'" data-stock="'. $product->stock.'" data-price="'. $product->price.'" class="btn btn-xs btn-primary edit-modal-link"><i class="glyphicon glyphicon-edit"></i> Edit</button>';
            })
            // ->editColumn('id', '<span>ID: {{$id}} </span>')
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::create($request->all());
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return $product;
    }
}
