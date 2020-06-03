<?php

namespace App\Http\Controllers;

use App\Categorie;
use App\Product;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

class ProductsController extends CmsController
{

    public function index()
    {
      self::$data['products'] = Product::paginate(8);
      return view('cms.products', self::$data);
    }


    public function create()
    {
      self::$data['categories'] = Categorie::all()->toArray();
      self::$data['colors_arr'] = ['white','grey','black','yellow','orange','brown','red','pink','blue','purple','green','multi'];
      self::$data['brands_arr'] = Product::distinct('brand')->pluck('brand')->toArray();
      return view('cms.add_product', self::$data);
    }


    public function store(ProductRequest $request)
    {
      Product::save_new($request);
      return redirect('cms/products');
    }


    public function show($id)
    {
      self::$data['item_id'] = $id;
      return view('cms.delete_product', self::$data);
    }


    public function edit($id)
    {
      self::$data['categories'] = Categorie::all()->toArray();
      self::$data['product_item'] = Product::find($id)->toArray();
      self::$data['colors_arr'] = ['white','grey','black','yellow','orange','brown','red','pink','blue','purple','green','multi'];
      self::$data['brands_arr'] = Product::distinct('brand')->pluck('brand')->toArray();
      return view('cms.edit_product',self::$data);
    }


    public function update(ProductRequest $request, $id)
    {
      Product::update_item($request, $id);
      return redirect('cms/products');
    }


    public function destroy($id)
    {
      Product::destroy($id);
      Session::flash('successM','Product has been deleted!');
      return redirect('cms/products');
    }
}
