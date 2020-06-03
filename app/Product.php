<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cart;
use Session;
use Image;
use Storage;

class Product extends Model
{
    public static function getProducts($category,$request, &$data) {

      $sortby_arr = ['Name A to Z','Name Z to A','Price low to high','Price high to low'];

      // get color filter options
      $colors_arr = ['white','grey','black','yellow','orange','brown','red','pink','blue','purple','green','multi'];

      if ($category == 'all') {
        $data['colors_arr'] = $colors_arr;
      } else {
        foreach ($colors_arr as $color) {
          if (self::where('color','LIKE',"%$color%")->where('categorie_id',Categorie::where('curl',$category)->first()->id)->get()->toArray()) {
            $data['colors_arr'][] = $color;
          }
        }
      }
      $data['color_checked'] = [];
      // get color filter options END


      // get brand filter options
      if ($category == 'all') {
        $data['brand_arr'] = self::get('brand')->groupBy('brand')->toArray();
      } else {
        $data['brand_arr'] = self::get()->where('categorie_id',Categorie::where('curl',$category)->first()->id)->groupBy('brand')->toArray();
      }

      $data['brand_checked'] = [];
      $brand_names = self::distinct()->pluck('brand')->toArray();
      // get brand filter options END



      $products = DB::table('products as p')
                    ->join('categories as c','c.id','=','p.categorie_id');

                    if (strtolower($category) !== 'all') {
                      $products = $products->where('c.curl','=', $category);
                    }
                    $products = $products->select('p.*','c.ctitle','curl')

                                        // search functionality
                                        ->when($request['search'], function ($q,$r) {
                                            return $q->where('p.ptitle','LIKE',"%$r%");
                                        });
                                        // search functionality END

                                        // sortBy filter
                                         $products = $products->when($request['sortBy'], function ($q,$r) {
                                           if (in_array($r, ['Nothing','Name A to Z','Name Z to A','Price low to high','Price high to low'])) {

                                             switch ($r) {
                                               case 'Name A to Z':
                                                 return $q->orderBy('p.ptitle','ASC');
                                                 break;
                                               case 'Name Z to A':
                                                 return $q->orderBy('p.ptitle','DESC');
                                                 break;
                                               case 'Price low to high':
                                                 return $q->orderBy('p.price','ASC');
                                                 break;
                                               case 'Price high to low':
                                                 return $q->orderBy('p.price','DESC');
                                                 break;

                                               default:
                                                 // code...
                                                 break;
                                             }
                                           }
                                         });
                                         // sortBy filter END
                                         // brand filter
                                          $products = $products->when($request['brand'], function ($q,$r) use($brand_names,&$data) {
                                            $q->where(function ($q) use($r,$brand_names,&$data) {
                                              foreach ($r as $brand) {
                                                if (in_array($brand, $brand_names)) {
                                                  $data['brand_checked'][] = $brand;
                                                  $q->orwhere('p.brand', 'LIKE',  '%' . $brand .'%');
                                                }
                                              }
                                            });
                                          });
                                          // brand filter END
                                          // color filter
                                           $products = $products->when($request['color'], function ($q,$r) use($colors_arr,&$data) {
                                             $q->where(function ($q) use($r,$colors_arr,&$data) {
                                               foreach ($r as $color) {
                                                 if (in_array($color, $colors_arr)) {
                                                   $data['color_checked'][] = $color;
                                                   $q->orwhere('p.color', 'LIKE',  '%' . $color .'%');
                                                 }
                                               }
                                             });
                                           });
                                           // color filter END
                                         $products = $products->paginate(12);
                                         $products->appends(request()->query());


    if ($products) {
        if ($products->currentPage() <= $products->lastPage()) {

          if (in_array($category, Categorie::pluck('curl')->toArray()) || $category == 'all') {
            $data['page_title'] = "| Shop $category";
            $data['page_header'] = (strtolower($category) == 'all') ? 'All Products' : ucfirst($category);
          } else {
            abort(404);
          }

          $data['products'] = $products;
          $data['product_count'] = self::count();
          $data['category'] = $category;
          $data['sortBy'] = in_array($request['sortBy'],$sortby_arr) ? $request['sortBy'] : 'Select';

          foreach (Categorie::all()->toArray() as $cat) {
            $data['categories'][$cat['ctitle']]['curl'] = $cat['curl'];
            $data['categories'][$cat['ctitle']]['count'] = self::where('categorie_id','=',$cat['id'])->count();
          }

        } else {
          abort(404);
        }
      } else {
        abort(404);
      }
    }

    public static function getProduct($product, &$data) {

      if ($item = self::where('purl','=', $product)->first()) {

        if (Categorie::where('id','=',$item['categorie_id'])->first()) {

          $data['product'] = $item->toArray();
          $data['product']['pgallery'] = explode('|', $data['product']['pgallery']);
          $data['product']['curl'] = Categorie::where('id','=',$item['categorie_id'])->first()->toArray()['curl'];
          $data['page_title'] = '| ' . $data['product']['ptitle'];
          self::getProductsFor('product_lookalike', $data ,NULL,$data['product']['curl']);
          
        } else {
          abort(404);
        }
      } else {
        abort(404);
      }
    }

    public static function getProductsFor($key, &$data,$amount = 3,$lookalike_cat = NULL)
    {

      if ($key === 'new_arrivals') {

        $products = DB::table('products as p')
                      ->join('categories as c','c.id','=','p.categorie_id')
                      ->select('p.*','curl')
                      ->orderBy('p.created_at', 'desc')
                      ->take(3)
                      ->get()->toArray();

        if ($products) {
          $data[$key] = $products;
        } else {
          abort(500);
        }

      } elseif ($key === 'best_sellers' || $key === 'most_viewed' || $key === 'deal_product') {

        $products = DB::table('products as p')
                      ->join('categories as c','c.id','=','p.categorie_id')
                      ->select('p.*','curl')
                      ->inRandomOrder()
                      ->take($amount)
                      ->get()->toArray();

        if ($products) {
          $data[$key] = $products;
          foreach ($data[$key] as $prod) {
            $prod->discount = rand(10,50);
          }
        } else {
          abort(500);
        }

      } elseif ($key === 'product_lookalike') {

        $products = DB::table('products as p')
                      ->join('categories as c','c.id','=','p.categorie_id')
                      ->select('p.*','curl')
                      ->where('c.curl','=', $lookalike_cat)
                      ->inRandomOrder()
                      ->take(8)
                      ->get()->toArray();

        if ($products) {
          $data[$key] = $products;
          foreach ($data[$key] as $prod) {
            $prod->discount = rand(10,50);
          }
        } else {
          abort(500);
        }

      }
    }

    public static function addToCart($pid)
    {

      if (!empty($pid) && is_numeric($pid)) {
        if ( $product = self::find($pid) ) {

          $product = $product->toArray();

          if (! Cart::get($pid)) {

            Cart::add($pid,$product['ptitle'],$product['price'],1,
            [
              'image' => $product['pimage'],
              'url' => Categorie::where('id','=',$product['categorie_id'])->first()->toArray()['curl'] . '/' . $product['purl'],
            ]);
            Session::flash('successM',$product['ptitle'] . ' added to cart!');
          }
        }
      }
    }

    public static function updateCart($op,$product)
    {
      if (!empty($product) && is_numeric($product) && Cart::get($product)) {
        if (!empty($op)) {

          if ($op === 'plus') {
            Cart::update($product,['quantity' => 1]);
          } elseif ($op === 'minus') {
            Cart::update($product,['quantity' => -1]);
          }
        }
      }
    }


    public static function ajaxSearch($query)
    {

      if (!empty($query)) {

        $products = DB::table('products as p')
                      ->join('categories as c','c.id','=','p.categorie_id')
                      ->select('p.ptitle','p.pimage','p.purl','c.curl')
                      ->where('p.ptitle','LIKE',"%$query%")
                      ->take(10)
                      ->get()->toArray();

        if ($products) echo json_encode($products);

      }
    }


    public static function search($query, &$data)
    {

      if (!empty($query)) {

        $products = DB::table('products as p')
                      ->join('categories as c','c.id','=','p.categorie_id')
                      ->select('p.*','c.curl')
                      ->where('p.ptitle','LIKE',"%$query%")
                      ->get()->toArray();

        $data['products'] = $products;

      }
    }


    public static function save_new($request)
    {

      if ($request->hasFile('pimage') && $request->file('pimage')->isValid() ) {

        $file = $request->file('pimage');
        $main_image_name = date('Y.m.d.H.i.s'). '-' . rand(111111,999999) . '-' . $file->getClientOriginalName();

        $to_save_dir = public_path() . '/imgs/products/';

        $file->move($to_save_dir,$main_image_name);

        $main_img = Image::make($to_save_dir . $main_image_name);
        $main_img->resize(600,null,function ($constraint) {
          $constraint->aspectRatio();
        });
        $main_img->save();

      }


      $images_list = [];



      if ($request->hasFile('pgallery')) {
        foreach ($request->file('pgallery') as $image) {
          if ($image->isValid()) {

            $file = $image;
            $image_name = date('Y.m.d.H.i.s'). '-' . rand(111111,999999) . '-' . $file->getClientOriginalName();


            $to_save_dir = public_path() . '/imgs/products/';

            $file->move($to_save_dir,$image_name);

            $img = Image::make($to_save_dir . $image_name);
            $img->resize(600,null,function ($constraint) {
              $constraint->aspectRatio();
            });
            $img->save();

            $images_list[] = $image_name;
          }
        }
      }

      $product = new self();
      $product->categorie_id = $request['category_id'];
      $product->ptitle = $request['ptitle'];
      $product->particle = $request['particle'];
      $product->purl = $request['purl'];
      $product->price = $request['price'];
      $product->brand = $request['brand'];
      $product->color = implode(',', $request['color']);
      $product->pimage = $main_image_name;
      $product->pgallery = '';

      if (!empty($images_list)) {
        $product->pgallery = implode('|', $images_list);
      }

      $product->save();

      Session::flash('successM','Product Added Successfuly!');

    }



    public static function update_item($request, $id)
    {

      $main_image_name = '';

      if ($request->hasFile('pimage') && $request->file('pimage')->isValid() ) {

        $file = $request->file('pimage');
        $main_image_name = date('Y.m.d.H.i.s'). '-' . rand(111111,999999) . '-' . $file->getClientOriginalName();


        $to_save_dir = public_path() . '/imgs/products/';

        $file->move($to_save_dir,$main_image_name);

        $main_img = Image::make($to_save_dir . $main_image_name);
        $main_img->resize(600,null,function ($constraint) {
          $constraint->aspectRatio();
        });
        $main_img->save();

      }

      $images_list = [];


      if ($request->hasFile('pgallery')) {
        foreach ($request->file('pgallery') as $image) {
          if ($image->isValid()) {

            $file = $image;
            $image_name = date('Y.m.d.H.i.s'). '-' . rand(111111,999999) . '-' . $file->getClientOriginalName();

            $to_save_dir = public_path() . '/imgs/products/';

            $file->move($to_save_dir,$image_name);

            $img = Image::make($to_save_dir . $image_name);
            $img->resize(600,null,function ($constraint) {
              $constraint->aspectRatio();
            });
            $img->save();

            $images_list[] = $image_name;
          }
        }
      }

      $product = self::find($id);
      $product->categorie_id = $request['category_id'];
      $product->ptitle = $request['ptitle'];
      $product->particle = $request['particle'];
      $product->purl = $request['purl'];
      $product->price = $request['price'];
      $product->brand = $request['brand'];
      $product->color = implode(',', $request['color']);

      if ($main_image_name) {
        $product->pimage = $main_image_name;
      }

      if (!empty($request['old_gallery'])) {
        foreach ($request['old_gallery'] as $old_gallery) {
          $images_list[] = $old_gallery;
        }
      }

      $product->pgallery = !empty($images_list) ? implode('|', $images_list) : '';

      $product->save();

      Session::flash('successM','Product Updated Successfuly!');

    }
}
