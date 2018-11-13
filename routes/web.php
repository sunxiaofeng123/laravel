<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//home page
Route::get('/', 'PagesController@root')->name('root');
Route::redirect('/', '/products')->name('root');
Route::get('products','ProductsController@index')->name('products.index');
Route::get('products/{product}', 'ProductsController@show')->name('products.show');

Auth::routes();

//登录后可以访问的页面
Route::group(['middleware' => 'auth'], function() {
    //验证邮件页面
    Route::get('/email_verify_notice', 'PagesController@emailVerifyNotice')->name('email_verify_notice');
    //发送通知邮件
    Route::get('/email_verification/send', 'EmailVerificationController@send')->name('email_verification.send');
    //校验通知邮件
    Route::get('/email_verification/verify', 'EmailVerificationController@verify')->name('email_verification.verify');

    //邮箱验证之后才可访问
    Route::group(['middleware' => 'email_verified'], function() {
        Route::get('user_addresses', 'UserAddressesController@index')->name('user_addresses.index');
        Route::get('user_addresses/create', 'UserAddressesController@create')->name('user_addresses.create');
        Route::post('user_addresses', 'UserAddressesController@store')->name('user_addresses.store');
        Route::get('user_addresses/{user_address}', 'UserAddressesController@edit')->name('user_addresses.edit');
        Route::put('user_addresses/{user_address}', 'UserAddressesController@update')->name('user_addresses.update');
        Route::delete('user_addresses/{user_address}', 'UserAddressesController@destroy')->name('user_addresses.destroy');

        //收藏和取消收藏
        Route::post('products/{product}/favorite', 'ProductsController@favor')->name('products.favor');
        Route::delete('products/{product}/favorite', 'ProductsController@disfavor')->name('products.disfavor');

    });
});

