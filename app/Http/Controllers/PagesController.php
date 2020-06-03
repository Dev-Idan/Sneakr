<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Categorie;
use App\Product;
use App\Message;
use App\Content;
use Cart;
use Session;
use App\Http\Requests\ContactRequest;

class PagesController extends MainController
{

  public function index()
  {
    self::$data['page_title'] = '| Home';
    Product::getProductsFor('new_arrivals', self::$data);
    Product::getProductsFor('best_sellers', self::$data);
    Product::getProductsFor('most_viewed', self::$data);
    Product::getProductsFor('deal_product', self::$data,5);
    return view('pages.index',self::$data);
  }

  public function about()
  {
    self::$data['page_title'] = '| About';
    return view('pages.about',self::$data);
  }

  public function getContact()
  {
    self::$data['page_title'] = '| Contact us';
    return view('pages.contact',self::$data);
  }

  public function postContact(ContactRequest $request)
  {
    self::$data['page_title'] = '| Thank you!';
    Message::save_new($request);
    return view('pages.contact',self::$data);
  }

  public function content($url)
  {
    Content::getByUrl($url, self::$data);
    return view('content.dynamic', self::$data);
  }

}
