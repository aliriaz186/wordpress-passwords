<?php

use Illuminate\Support\Facades\Route;

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
// Auth::routes();
Route::get('/', function () {
    return view('welcome');
});

Route::get('/', "AuthController@welcome");

Route::get('/reviews', function () {
    return view('reviews');
});
Route::get('/contact', function () {
    return view('contact');
});

Route::get('/login', function () {
    return view('auth.login');
});
Route::post('upload-file', "AuthController@uploadFile");
Route::post('code-get', "AuthController@codeGet");
Route::post('like-btn', "AuthController@liked");
Route::post('unlike-btn', "AuthController@unliked");
Route::post('sendmessage', "AuthController@sendmessage");
Route::get('send-password', "AuthController@sendpassword");
Route::get('show-image/{fileId}', "DashboardController@showImage");
Route::get('about', "AuthController@about");
Route::get('user-agreement', "AuthController@userAgreement");
Route::post('search-entries', "AuthController@searchEntries");
Route::post('send-reset-password-link', "AuthController@sendresetpasswordlink");
Route::get('reset-password/{token}', "AuthController@resetPassword");
Route::post('resetpassword', "AuthController@resetPasswordBackend");

Route::get('logout-user', function (){
    \Illuminate\Support\Facades\Session::flush();
    \Illuminate\Support\Facades\Auth::logout();
    return redirect('/');
})->name('logout-user');



//dashboard routes
Route::get('dashboard', "DashboardController@dashboard")->middleware('dashboard');
Route::get('upload-new-entry', "DashboardController@showUploadNewEntryPage")->middleware('dashboard');
Route::get('add-more-tokens', "DashboardController@addMoreTokens")->middleware('dashboard');
Route::get('personal-details', "DashboardController@personalDetails")->middleware('dashboard');
Route::get('billing', "DashboardController@billing")->middleware('dashboard');
Route::get('delete-entry/{id}', "DashboardController@deleteEntry")->middleware('dashboard');
Route::post('saving-new-entry', "DashboardController@savingNewEntry")->middleware('dashboard');
Route::post('set-certificate-password', "DashboardController@resetCertificatePassword")->middleware('dashboard');
Route::get('profile', "DashboardController@profile")->middleware('dashboard');
Route::post('change-password', "DashboardController@saveProfileInfo")->middleware('dashboard');
Route::post('update-card-info', "DashboardController@updateCardInfo")->middleware('dashboard');
Route::get('entries', "DashboardController@entries")->middleware('dashboard');
Route::get('cancel-auto-renew', "DashboardController@cancelAutoRenew")->middleware('dashboard');
Route::get('turnon-auto-renew', "DashboardController@turnOnAutoRenew")->middleware('dashboard');
Route::get('view-certificate/{id}', "DashboardController@viewCertificate")->middleware('dashboard');
Route::get('download-logo/{userId}/{fileId}', "DashboardController@downloadLogo")->middleware('dashboard');
Route::get('edit-entry/{id}', "DashboardController@editEntry")->middleware('dashboard');
Route::post('update-entry', "DashboardController@updateEntry")->middleware('dashboard');
Route::post('search-entries-by-admin', "DashboardController@searchEntries")->middleware('dashboard');

