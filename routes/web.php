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

 // !! todas las rutas middleware autentificados o pagados   
 
 
// Route::get('/home', 'HomeController@index');

//public
Route::get('/', 'HomeController@index');

//login
// fix register form
Auth::routes([ 'register' => true,
               'verify'   => true,
            ]);
// fix auth routes and route(login)
Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']); 
// Route::get('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@create']); 

//correo
Route::get('correo', 'HomeController@correo')->middleware(['auth', 'verified']);

//profile
Route::get('profile', 'AdminController@profile')->middleware(['auth', 'verified']);
Route::get('dashboard', 'AdminController@dashboard')->middleware(['auth', 'verified'])->middleware(\App\Http\Middleware\AdminMiddleware::class);   //
Route::get('users', 'AdminController@admin')->middleware(['auth', 'verified'])->middleware(\App\Http\Middleware\AdminMiddleware::class);   //
Route::get('speakers', 'AdminController@adminPresentation')->middleware(['auth', 'verified'])->middleware(\App\Http\Middleware\AdminMiddleware::class);   //
Route::get('pays', 'AdminController@adminPays')->middleware(['auth', 'verified'])->middleware(\App\Http\Middleware\AdminMiddleware::class);   //

// admin photo
Route::post('upload','AdminController@upload')->middleware(['auth', 'verified']); // verificado 
Route::get('view/{fileName}/','AdminController@view')->middleware(['auth', 'verified']);

// user crud
Route::get('add', 'AdminController@add')->middleware(['auth', 'verified'])->middleware(\App\Http\Middleware\AdminMiddleware::class);   //
Route::get('edit/{id?}', 'UserController@edit')->middleware(['auth', 'verified'])->middleware(\App\Http\Middleware\AdminMiddleware::class);   //
Route::post('store', 'UserController@store')->middleware(['auth', 'verified'])->middleware(\App\Http\Middleware\AdminMiddleware::class);   //
Route::get('destroy/{id?}', 'UserController@destroy')->middleware(['auth', 'verified'])->middleware(\App\Http\Middleware\AdminMiddleware::class);   //
Route::post('edit/{id?}', 'UserController@update')->middleware(['auth', 'verified'])->middleware(\App\Http\Middleware\AdminMiddleware::class);   //

// speaker
Route::get('speaker', 'SpeakerController@speaker')->middleware(['auth', 'verified'])->middleware(\App\Http\Middleware\SpeakerMiddleware::class);
Route::get('modify/{id}', 'SpeakerController@modify')->middleware(['auth', 'verified'])->middleware(\App\Http\Middleware\SpeakerMiddleware::class);
// Route::get('unsubscribe/{id}', 'SpeakerController@unsubscribe');

// presentation
Route::get('presentation', 'SpeakerController@presentation');
Route::post('storePresentation', 'SpeakerController@storePresentation')->middleware(['auth', 'verified'])->middleware(\App\Http\Middleware\SpeakerMiddleware::class);

// asistant
Route::get('asistant', 'AsistantController@asistant')->middleware(['auth', 'verified'])->middleware(\App\Http\Middleware\AsistantMiddleware::class);
Route::get('subscribe/{id}', 'AsistantController@subscribe')->middleware(['auth', 'verified'])->middleware(\App\Http\Middleware\AsistantMiddleware::class);
Route::post('pdf/{idpresentation}', 'AsistantController@pdf')->middleware(['auth', 'verified'])->middleware(\App\Http\Middleware\AsistantMiddleware::class);
Route::post('pdfOtherPage', 'AsistantController@pdfOtherPage')->middleware(['auth', 'verified'])->middleware(\App\Http\Middleware\AsistantMiddleware::class);
Route::post('pdf2/{idpresentation}', 'AsistantController@pdf2')->middleware(['auth', 'verified'])->middleware(\App\Http\Middleware\AsistantMiddleware::class);
Route::get('video/{id}', 'AsistantController@video')->middleware(['auth', 'verified'])->middleware(\App\Http\Middleware\AsistantMiddleware::class)->middleware(\App\Http\Middleware\PayMiddleware::class);  // custom middelware  pay que ha pagado
Route::post('uploadPay/{idpresentation}', 'AsistantController@uploadPay')->middleware(['auth', 'verified']);

//middleware  
//borrados confirmar mirar middleware crud pagos

// rutas middelware  
// rutas recurso 
Route::resource('presentations', 'SpeakerResourceController')->middleware(\App\Http\Middleware\SpeakerMiddleware::class);
Route::post('editPresentation/{idpresentation}', 'SpeakerResourceController@editPresentation')->middleware(\App\Http\Middleware\SpeakerMiddleware::class);
Route::get('unsubscribe/{idpresentation}', 'SpeakerResourceController@destroy')->middleware(\App\Http\Middleware\SpeakerMiddleware::class);


Route::resource('/pay', 'PayResourceController', ['except' => ['create', 'show']])->middleware(\App\Http\Middleware\AdminMiddleware::class);   //
Route::get('editPay/{idpay}', 'PayResourceController@editPay')->middleware(\App\Http\Middleware\AdminMiddleware::class);   //
Route::post('checkPay/{idpay}', 'AdminController@checkPay')->middleware(\App\Http\Middleware\AdminMiddleware::class);   //
Route::post('checkNoPay/{idpay}', 'AdminController@checkNoPay')->middleware(\App\Http\Middleware\AdminMiddleware::class);   //
Route::post('updatePay/{idpay}', 'PayResourceController@updatePay')->middleware(\App\Http\Middleware\AdminMiddleware::class);   //

// Route::get('deletePay/{idpay}', 'SpeakerResourceController@destroy');
// correo mejorar 