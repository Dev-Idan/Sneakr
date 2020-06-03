<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Categorie;
use App\Product;
use App\Order;
use Cart;
use Session;

class ShopController extends MainController
{
  public function categories()
  {
    self::$data['categories'] = Categorie::all()->toArray();
    self::$data['page_title'] = '| Shop';
    return view('shop.categories',self::$data);
  }

  public function products($category, Request $request)
  {
    if (in_array($category, Categorie::pluck('curl')->toArray()) || $category == 'all') {
      Product::getProducts($category,$request, self::$data);
      return view('shop.products', self::$data);
    } else {
      abort(404);
    }
  }

  public function product($category,$product)
  {
    Product::getProduct($product, self::$data);
    return view('shop.product', self::$data);
  }

  public function ajaxAddToCart(Request $request)
  {
    Product::addToCart($request['pid']);
  }

  public function cart() {
    self::$data['page_title'] = '| Cart';
    $cart = Cart::getContent()->toArray();
    sort($cart);
    self::$data['cart'] = $cart;
    return view('shop.cart', self::$data);
  }

  public function clearCart()
  {
    Cart::clear();
    return redirect('cart');
  }

  public function removeItem($product)
  {
    Cart::remove($product);
    return redirect('cart');
  }

  public function updateItem($op,$product)
  {
    Product::updateCart($op,$product);
    return redirect('cart');
  }

  public function orderComplete()
  {
    if (Cart::isEmpty()) {
      return redirect('cart');
    }

    if (! Session::has('user_id')) {
      return redirect('login?redirect=cart');
    }

    Order::save_new(self::$data);
    self::$data['page_title'] = '| Order Complete!';
    return view('shop.thankyou', self::$data);
  }

  public function ajaxSearch(Request $request)
  {
    Product::ajaxSearch($request['search']);
  }
}
