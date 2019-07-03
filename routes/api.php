<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// registration client route
Route::post('registration', 'ApiController@Registration');
// updateprofile client route
Route::post('updateprofile', 'ApiController@updateprofile');
// Login route
Route::post('login', 'ApiController@login');
// logout  route
Route::post('logout', 'ApiController@logout');
//// category route
Route::get('category', 'ApiController@category');
//// advhome route
Route::get('advhome', 'ApiController@advhome');
//// advproduct route
Route::get('advproduct', 'ApiController@advproduct');
//// productincategory route
Route::post('productincategory', 'ApiController@productincategory');
//// addtocart route
Route::post('addtocart', 'ApiController@addtocart');
//// price route
Route::get('price', 'ApiController@allprices');
//// order route
Route::post('order', 'ApiController@order');
//// Addtofav route
Route::post('addtofavirate', 'ApiController@Addtofav');
//// deletefavirate route
Route::post('deletefavirate', 'ApiController@deletefavirate');
//// allfavirateforuser route
Route::post('allfavirateforuser', 'ApiController@allfavirateforuser');
//// allorderforuser route
Route::post('allorderforuser', 'ApiController@allorderforuser');
//// allproductinorder route
Route::post('allproductinorder', 'ApiController@allproductinorder');
//// search route
Route::post('search', 'ApiController@search');
//// search route
Route::get('about', 'ApiController@About');
//// search route
Route::get('contactus', 'ApiController@Contactus');
