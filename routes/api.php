<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/errors', function () {
    return "Not Authorized Please Login first";
})->name('error');

// Route sinup



// Routes Forgot password

Route::group(['prefix' => 'forgot_password'], function() {

    Route::get('find/{token}', 'PasswordResetController@find');

    Route::group(['prefix' => 'office'], function() {

        Route::post('reset', 'PasswordResetOfficeController@reset');
        Route::post('create', 'PasswordResetOfficeController@create');
    });

    // Route::group(['prefix' => 'admin'], function() {

    //     Route::post('reset', 'PasswordResetController@reset');
    //     Route::post('create', 'PasswordResetController@create');
    // });

    Route::group(['prefix' => 'marketer'], function() {

        Route::post('reset', 'PasswordResetMarketerController@reset');
        Route::post('create', 'PasswordResetMarketerController@create');
    });


    });
    // end route forgot password



    // routes for admin
// Route::group(['prefix' => 'admin'],function(){


//     Route::post('login','Auth\UsersController@login');
//     Route::post('register','Auth\UsersController@register');
//     Route::post('logout','Auth\UsersController@logout');


//     Route::post('addofficeowner','Auth\UsersController@AddOfficeOwner');

//     Route::group( ['middleware' => ['auth:users','scope:users'] ],function(){

//     //    Route::post('addadmin','Auth\UsersController@AddAdmin');
//        Route::delete('deleteadmin/{id}','Auth\UsersController@destroyAdmin');
//        Route::get('showadmin/{id}', 'Auth\UsersController@showadmin');
//        Route::get('showadmin', 'Auth\UsersController@alladmin');

//        Route::delete('destroyoffice/{id}','Auth\UsersController@destroyoffice');
//        Route::get('showoffice/{id}', 'Auth\UsersController@showoffice');
//     //    Route::get('showoffice', 'Auth\UsersController@alloffice');
//        Route::put('activeoffice/{id}', 'Auth\UsersController@updateStatusOffice');

//        Route::get('showmarketer/{id}', 'Auth\UsersController@showmarketer');
//        Route::get('showmarketer', 'Auth\UsersController@allmarketer');

//        Route::get('report', 'Auth\UsersController@ReportAdmin');
//        Route::get('report/{id}', 'Auth\UsersController@ReportAdminForOne');



//     });
// });



// end routes for admin





// routes for officeowner

Route::group(['prefix' => 'officeowner'],function(){


Route::post('signup', 'SignupController@store');



    Route::post('login','Auth\OfficeOwnerController@login');


    Route::post('notification','Auth\OfficeOwnerController@notification');



    Route::group( ['middleware' => ['auth:officeowner','scope:officeowner'] ],function(){
        Route::post('logout','Auth\OfficeOwnerController@logout');
        // Route::post('dashboard','Auth\OfficeOwnerController@dashboard');
        Route::post('addmarketer','Auth\OfficeOwnerController@AddMarketer');
        Route::delete('destroymarketer/{id}','Auth\OfficeOwnerController@destroymarketer');
        Route::get('showmarketer', 'Auth\OfficeOwnerController@allmarketer');
        Route::get('showmarketer/{id}', 'Auth\OfficeOwnerController@showmarketer');

        Route::apiResource('/real_state','RealStateController');

        Route::post('/real_state/{id}/addimage', 'ImageController@store');
        Route::delete('/real_state/delete_picture/{id}', 'ImageController@destroy');

        Route::apiResource('/request','RequestController');
        Route::put('request/{id}/update_status_request', 'RequestController@updateStatusRequest');
        Route::put('request/{id}/update_marketer_request', 'RequestController@ChangeRequestToAnotherMareketer');

       Route::get('report', 'Auth\OfficeOwnerController@ReportOffice');
       Route::get('report/{id}', 'Auth\OfficeOwnerController@ReportOfficeOne');



       // filter

       Route::get('new/request','RequestController@new');
       Route::get('send/request','RequestController@send');
       Route::get('Canceled/request','RequestController@Canceled');
       Route::get('Completed/request','RequestController@Completed');










    });
});

// end routes for officeowner





// routes for marketer
Route::group(['prefix' => 'marketer'],function(){

    Route::post('login','Auth\MarketerController@login');


    Route::post('notification','Auth\MarketerController@notification');


    Route::group( ['middleware' => ['auth:marketer','scope:marketer'] ],function(){
    Route::post('logout','Auth\MarketerController@logout');

        Route::apiResource('/real_state','RealStateController')->except(['store', 'index']);
        Route::post('/real_state', 'RealStateController@storemarketer');
        Route::get('/real_state', 'RealStateController@indexmarketer');

        Route::post('/real_state/{id}/addimage', 'ImageController@store');
        Route::delete('/real_state/delete_picture/{id}', 'ImageController@destroy');

        Route::post('/request', 'RequestController@storemarketer');
        Route::get('/request', 'RequestController@indexmarketer');
        Route::get('/request/{id}', 'RequestController@show');
        Route::put('/request/{id}', 'RequestController@update');
        Route::delete('/request/{id}', 'RequestController@destroy');
        Route::put('/request/{id}/update_status_request', 'RequestController@updateStatusRequest');

       Route::get('report', 'Auth\MarketerController@ReportMarketer');

       Route::get('new/request','RequestController@newmarketer');
       Route::get('send/request','RequestController@sendmarketer');
       Route::get('Canceled/request','RequestController@Canceledmarketer');
       Route::get('Completed/request','RequestController@Completedmarketer');





    });
});

// end routes for marketer

// route pdf

Route::get('RealStatePdf/{id}', "RealStateController@DownloadPdf");


