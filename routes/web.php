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

Route::get('/', function () {
//    return view('website.home.index');
});

// change language ////////////

Route::get('/language','HomeController@Changelang');


Route::group(['prefix'=>'admin','middleware'=>'admin'],function () {

//    Account controller
   // order  route
    Route::resource('/order', 'admin\OrderController');
   // price route
    Route::resource('/price', 'admin\priceController');
 // gove route
    Route::resource('/gove', 'admin\GoveController');
  // area route
    Route::resource('/area', 'admin\AreaController');
  // village route
    Route::resource('/village', 'admin\VillageController');
    // category route
    Route::resource('/category', 'admin\CategoryController');
// Subcategory  route
    Route::resource('/subcategory', 'admin\SubcategoryController');
// Advertisment  route
    Route::resource('/adv', 'admin\AdvertismentController');
// Product  route
    Route::resource('/product', 'admin\ProductController');
    Route::get('/pindingproduct/{id}', 'admin\ProductController@pindingproduct')->name('pindingproduct');
    Route::get('/activeproduct/{id}', 'admin\ProductController@activeproduct')->name('activeproduct');
    //account route
    Route::resource('/account', 'admin\Acounts_controller');
    //captin route
    Route::resource('/captin', 'admin\CaptinController');
    //client  route
    Route::resource('/client', 'admin\ClientController');
    //Blog   route
    Route::resource('/blog', 'admin\BlogController');
 //testomanial   route
    Route::resource('/testomanial', 'admin\TestimonialController');
  //SeettingController route
    Route::resource('/seetting', 'admin\SeettingController');
    // Route::get('accounts','admin\Acounts_controller@index')->middleware(['permission:عرض حساب|اضافه حساب|تعديل حساب|حذف حساب'])->name('accounts.index');
    // Route::get('accounts/create','admin\Acounts_controller@create')->middleware(['permission:عرض حساب'])->name('accounts.create');
    // Route::POST('accounts/create','admin\Acounts_controller@store')->middleware(['permission:عرض حساب'])->name('accounts.store');
    // Route::get('accounts/{id}','admin\Acounts_controller@show');
    // Route::get('accounts/{id}/edit','admin\Acounts_controller@edit')->middleware(['permission:تعديل حساب'])->name('accounts.edit');;
    // Route::patch('accounts/{id}','admin\Acounts_controller@update')->middleware(['permission:تعديل حساب'])->name('accounts.update');
    // Route::delete('accounts/{id}','admin\Acounts_controller@destroy')->middleware(['permission:حذف حساب'])->name('accounts.destroy');;
    Route::resource('permission', 'PermissionController');
    Route::resource('role', 'RoleController');
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/notfound', 'HomeController@notfound')->name('notfound');
    Route::post('/acceptorder', 'admin\OrderController@acceptorder')->name('acceptorder');
    Route::post('/finishorder', 'admin\OrderController@finishorder')->name('finishorder');
    Route::post('/inwayorder', 'admin\OrderController@inwayorder')->name('inwayorder');
    Route::get('/filterorder', 'admin\OrderController@filterorder')->name('filterorder');
    Route::get('/accepted', 'admin\OrderController@accepted')->name('accepted');
    Route::get('/inway', 'admin\OrderController@inway')->name('inway');
    Route::get('/finish', 'admin\OrderController@finish')->name('finish');
    Route::get('/prinorder/{id}', 'admin\OrderController@prinorder')->name('prinorder');
    Route::get('/shownotification', 'admin\NotificationController@shownotification')->name('shownotification');
    Route::post('/sendnotification', 'admin\NotificationController@sendnotification')->name('sendnotification');
    Route::get('/collectorder', 'admin\OrderController@collectorder')->name('collectorder');
    Route::resource('/message', 'admin\MessageController');
    // get subcategory  route
    Route::get('/subcategoryincategory/{id}', 'admin\ProductController@subcategoryincategory');

});

$this->get('admin/login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('admin/login', 'Auth\LoginController@login');//->middleware('admin');
$this->get('admin/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
/////////////////// front //////////

Route::get('/', 'front\FrontController@front')->name('front');
Route::get('/shop/{id}', 'front\FrontController@shop')->name('shop');
Route::get('/productdetials/{id}', 'front\FrontController@productdetials')->name('productdetials');
Route::get('/registrationform', 'front\FrontController@registrationform')->name('registrationform');
Route::post('/registration', 'front\FrontController@Registration')->name('registration');
Route::post('/loginclient', 'front\FrontController@loginclient')->name('loginclient');
Route::get('/addtofaivirate/{id}', 'front\FrontController@addtofaivirate')->name('addtofaivirate');
Route::get('/deletefaivrate/{id}', 'front\FrontController@deletefaivrate')->name('deletefaivrate');
Route::get('/addtocart/{id}', 'front\FrontController@addtocart')->name('addtocart');
Route::get('/contact', 'front\FrontController@contact')->name('contact');
Route::post('/contactus', 'front\FrontController@contactus')->name('contactus');
Route::get('/blog', 'front\FrontController@allblog')->name('blog');
Route::get('/blogdetials/{id}', 'front\FrontController@blogdetials')->name('blogdetials');
Route::get('/deletecart/{id}', 'front\FrontController@deletecart')->name('deletecart');
Route::get('/cart', 'front\FrontController@cart')->name('cart');
Route::post('/sendorderfromcart', 'front\FrontController@sendorderfromcart')->name('sendorderfromcart');
Route::get('/about', 'front\FrontController@about')->name('about');
Route::get('/fav', 'front\FrontController@fav')->name('fav');
