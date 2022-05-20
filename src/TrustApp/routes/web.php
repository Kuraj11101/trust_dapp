<?php

use Illuminate\Support\Facades\Route;

// if(env('APP_FORCE_HTTPS', false)) {
//     URL::forceScheme('https');
// }

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
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

//Registration Routes
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

//Auth::routes(['verify' => true]);

// Route::get('profile', function () {
     // Only verified users may enter...
// })->middleware('verified');

Route::get('/transfer', 'TransferController@index')->name('transfer');
Route::post('/transfer', 'TransferController@index')->name('transfer');

Route::get('/usecredit', 'UseCreditController@index')->name('usecredit');
Route::post('/usecredit', 'UseCreditController@index')->name('usecredit');

Route::get('/paybills', 'PayBillsController@index')->name('paybills');
Route::post('/paybills', 'PayBillsController@index')->name('paybills');

Route::get('/makepayments', 'MakePaymentsIController@index')->name('makepayments');
Route::post('/makepayments', 'MakePaymentsIController@index')->name('makepayments');

Route::get('/buyairtimedata', 'BuyAirtimeDataController@index')->name('buyairtimedata');
Route::post('/buyairtimedata', 'BuyAirtimeDataController@index')->name('buyairtimedata');

Route::get('/requestpayment', 'RequestPaymentController@index')->name('requestpayment');
Route::post('/requestpayment', 'RequestPaymentController@index')->name('requestpayment');

Route::get('/addbank', 'AddBankController@index')->name('addbank');
Route::post('/addbank', 'AddBankController@index')->name('addbank');

Route::get('/addcard', 'AddCardController@index')->name('addcard');
Route::post('/addcard', 'AddCardController@index')->name('addcard');

Route::get('/accountstatus', 'AccountStatusController@index')->name('accountstatus');
Route::post('/accountstatus', 'AccountStatusController@index')->name('accountstatus');



Route::group(['middleware' => 'web'], function () {

            Route::get('/home', 'HomeController@index')->name('home');

            Route::get('/profile', 'ProfileController@index')->name('profile');
            Route::put('/profile', 'ProfileController@update')->name('profile.update');
            Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
            Route::post('login', 'Auth\LoginController@login');
            Route::post('logout', 'Auth\LoginController@logout')->name('logout');

            //Registration Routes
            Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
            Route::post('register', 'Auth\RegisterController@register');

            //Auth::routes(['verify' => true]);

           // Route::get('profile', function () {
              // Only verified users may enter...
           // })->middleware('verified');

			 Route::get('/transfer', 'TransferController@index')->name('transfer');
			 Route::post('/transfer', 'TransferController@index')->name('transfer');

             Route::get('/usecredit', 'UseCreditController@index')->name('usecredit');
             Route::post('/usecredit', 'UseCreditController@index')->name('usecredit');

             Route::get('/paybills', 'PayBillsController@index')->name('paybills');
             Route::post('/paybills', 'PayBillsController@index')->name('paybills');

             Route::get('/makepayments', 'MakePaymentsIController@index')->name('makepayments');
             Route::post('/makepayments', 'MakePaymentsIController@index')->name('makepayments');

             Route::get('/buyairtimedata', 'BuyAirtimeDataController@index')->name('buyairtimedata');
             Route::post('/buyairtimedata', 'BuyAirtimeDataController@index')->name('buyairtimedata');

             Route::get('/requestpayment', 'RequestPaymentController@index')->name('requestpayment');
             Route::post('/requestpayment', 'RequestPaymentController@index')->name('requestpayment');

             Route::get('/addbank', 'AddBankController@index')->name('addbank');
             Route::post('/addbank', 'AddBankController@index')->name('addbank');

             Route::get('/addcard', 'AddCardController@index')->name('addcard');
             Route::post('/addcard', 'AddCardController@index')->name('addcard');

             Route::get('/accountstatus', 'AccountStatusController@index')->name('accountstatus');
             Route::post('/accountstatus', 'AccountStatusController@index')->name('accountstatus');

             Route::get('/applyforcredit', 'ApplyForCreditController@index')->name('applyforcredit');
             Route::post('/applyforcredit', 'ApplyForCreditController@index')->name('applyforcredit');

             Route::get('/homeinapptransfer', 'HomeInAppTransferCreditController@index')->name('homeinapptransfer');
             Route::post('/homeinapptransfer', 'HomeInAppTransferController@update_index')->name('update_homeinapptransfer');
 });

 /**
     * Paypal routes
     */
    // route for view/blade file
    Route::get('paywithpaypal', array(
        'as' => 'paywithpaypal',
        'uses' => 'PaypalController@payWithPaypal',
    ));
    // route for post request
    Route::post('paypal', array(
        'as' => 'paypal',
        'uses' => 'PaypalController@postPaymentWithpaypal',
    ));
    // route for check status responce
    Route::get('paypal', array(
        'as' => 'status',
        'uses' => 'PaypalController@getPaymentStatus',
    ));
        /**
     * Credit/debit card routes
     */
    Route::get('/carddeposit',[
        'uses'=>'TransaktionController@getcarddeposit',
        'as'=>'carddeposit'
    ]);
    Route::post('/cardDeposit',[
        'uses'=>'TransaktionController@cardDeposit',
        'as'=>'cardDeposit'
    ]);



 Auth::routes();
