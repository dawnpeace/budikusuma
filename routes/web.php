<?php

use App\enums\DocumentStatus;
use App\IdentityCardSubmission;
use Illuminate\Support\Arr;
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

Route::view('/', 'main');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'pengajuan', 'as' => 'apply.'], function(){
    Route::get('/buat-ktp', 'IdentityCardController@index')->name('ktp');
    Route::post('/buat-ktp', 'IdentityCardController@store')->name('ktp.submit');

    Route::get('/buat-kia', 'ChildIdCardController@index')->name('kia');
    Route::post('/buat-kia', 'ChildIdCardController@store')->name('kia.submit');

    Route::get('/buat-akte-lahir', 'BirthCertificateController@index')->name('aktelahir');
    Route::post('/buat-akte-lahir', 'BirthCertificateController@store')->name('aktelahir.submit');

    Route::get('/buat-kartu-keluarga', 'FamilyCardController@index')->name('kartukeluarga');
    Route::post('/buat-kartu-keluarga', 'FamilyCardController@store')->name('kartukeluarga.submit');

});

Route::group(['prefix' => 'persyaratan', 'as' => 'requirement.'], function(){
    Route::get('/', 'RequirementsContentController@index')->name('index');
    Route::get('document', 'RequirementsContentController@getItem')->name('show');
});

Route::group(["prefix" => "cetak-ulang", 'as' => 'reprint.', 'namespace' => 'Reprint'], function(){
    Route::get('ktp', 'IdentityCardController@index')->name('ktp.index');
    Route::post('ktp/submit', 'IdentityCardController@submit')->name('ktp.submit');
    Route::post('ktp', 'IdentityCardController@addToReprint')->name('ktp.store');

    Route::get('kk', 'FamilyCardController@index')->name('kk.index');
    Route::post('kk/submit', 'FamilyCardController@submit')->name('kk.submit');
    Route::post('kk', 'FamilyCardController@addToReprint')->name('kk.store');

    Route::get('akta-lahir', 'BirthCertificateController@index')->name('al.index');
    Route::post('akta-lahir/submit', 'BirthCertificateController@submit')->name('al.submit');
    Route::post('akta-lahir', 'BirthCertificateController@addToReprint')->name('al.store');

    Route::get('kia', 'ChildIdentityCardController@index')->name('kia.index');
    Route::post('kia/submit', 'ChildIdentityCardController@submit')->name('kia.submit');
    Route::post('kia', 'ChildIdentityCardController@addToReprint')->name('kia.store');

    Route::get('permintaan', 'ReprintRequestController@create')->name('check');
    Route::post('permintaan', 'ReprintRequestController@submit')->name('check.submit');
});


// Admin Routes Starts Here

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function(){
    Route::group(['prefix' => 'pengajuan', 'namespace' => 'Submission', 'as' => 'submission.'], function() {
        Route::view('/ktp', 'admin.submission.ktp')->name('ktp');
        Route::get('/ktp/datatable', 'IdentityCardController@datatable')->name('ktp.datatable');
        Route::get('/ktp/edit/{card}', 'IdentityCardController@edit')->name('ktp.edit');
        Route::post('/ktp/hapus/{card}', 'IdentityCardController@delete')->name('ktp.delete');
    });
});

Route::view('asun','admin.main');


