<?php

Route::middleware(['denyreaccess'])->group(function () {

  Route::get('access', 'AccessController@getLogin');
  Route::post('access', 'AccessController@postLogin');
});

Route::middleware(['mainaccess'])->group(function () {

  // cart
  Route::get('cart', 'ShopController@cart');
  Route::get('cart/clear', 'ShopController@clearCart');
  Route::get('cart/update/{op}/{product}', 'ShopController@updateItem');
  Route::get('cart/remove-item/{product}', 'ShopController@removeItem');

  // shop
  Route::get('shop', 'ShopController@categories');
  Route::get('shop/ajaxSearch', 'ShopController@ajaxSearch');
  Route::get('shop/add-to-cart', 'ShopController@ajaxAddToCart');
  Route::get('shop/order-complete', 'ShopController@orderComplete');
  Route::get('shop/{category}', 'ShopController@products');
  Route::get('shop/{category}/{product}', 'ShopController@product');

  // user
  Route::get('login', 'UserController@getLogin');
  Route::post('login', 'UserController@postLogin');
  Route::get('signup', 'UserController@getSignup');
  Route::post('signup', 'UserController@postSignup');
  Route::get('account', 'UserController@getAccount');
  Route::post('account', 'UserController@updateAccount');
  Route::get('account/view-order/{order}', 'UserController@getUserOrder');
  Route::get('logout', 'UserController@logout');

  // CMS
  Route::middleware(['cmsguard'])->group(function () {
    Route::prefix('cms')->group(function () {

      Route::get('dashboard', 'CmsController@dashboard');
      Route::get('get-graph', 'CmsController@getGraph');
      Route::get('menu/restore-defaults','MenuController@getRestoreDefaults');
      Route::post('menu/restore-defaults','MenuController@postRestoreDefaults');
      Route::resource('menu', 'MenuController');
      Route::resource('content', 'ContentController');
      Route::resource('categories', 'CategoriesController');
      Route::resource('products', 'ProductsController');
      Route::get('orders', 'CmsController@getOrders');
      Route::resource('users', 'CmsUserController');
      Route::get('messages', 'MessagesController@getMessages');
      Route::get('messages/do-action', 'MessagesController@doAction');
      Route::get('messages/{id}', 'MessagesController@getMessage');

    });
  });


  Route::get('/', 'PagesController@index');
  Route::get('/get-captcha', 'MainController@getCaptcha');
  Route::get('about', 'PagesController@about');
  Route::get('contact', 'PagesController@getContact');
  Route::post('contact', 'PagesController@postContact');
  Route::get('{url}', 'PagesController@content');


});
