<?php


use Illuminate\Support\Facades\Auth;
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

Route::view('/', 'main')->name('dashboard');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('media/{media?}', 'MediaController@getMedia')
    ->middleware('auth')
    ->name("media");

Route::middleware(['auth', 'can:access-common-page'])->group(function(){

    Route::prefix('pdf')->namespace('Reprint')->group(function(){
        Route::get('akta-lahir/{card?}', 'BirthCertificateController@pdf')->name('al.pdf');
        Route::get('kk/{card?}', 'FamilyCardController@pdf')->name('kk.pdf');
        Route::get('kia/{card?}', 'ChildIdentityCard@pdf')->name('kia.pdf');
        Route::get('akta-kematian/{card?}', 'DeathCertificateController@pdf')->name('ak.pdf');
        Route::get('ktp/{card?}', 'IdentityCardController@pdf')->name('ktp.pdf');
    });

    Route::group(['prefix' => 'pengajuan', 'as' => 'apply.'], function () {
        Route::get('/buat-ktp', 'IdentityCardController@index')->name('ktp');
        Route::post('/buat-ktp', 'IdentityCardController@store')->name('ktp.submit');

        Route::get('/buat-kia', 'ChildIdCardController@index')->name('kia');
        Route::post('/buat-kia', 'ChildIdCardController@store')->name('kia.submit');

        Route::get('/buat-akta-lahir', 'BirthCertificateController@index')->name('aktelahir');
        Route::post('/buat-akta-lahir', 'BirthCertificateController@store')->name('aktelahir.submit');

        Route::get('/buat-kartu-keluarga', 'FamilyCardController@index')->name('kartukeluarga');
        Route::post('/buat-kartu-keluarga', 'FamilyCardController@store')->name('kartukeluarga.submit');

        Route::get('/buat-akta-kematian', 'DeathCertificateController@index')->name('aktakematian');
        Route::post('/buat-akta-kematian', 'DeathCertificateController@store')->name('aktakematian.submit');
    });

    Route::get('/pengajuan-antrian', 'QueueController@index')->name('queue.index');
    Route::post('/pengajuan-antrian', 'QueueController@store')->name('queue.store');
});


Route::group(['prefix' => 'periksa-pengajuan', 'as' => 'check.', 'namespace' => 'Check'], function(){
    Route::get('/', 'MainController@index')->name('index');
    Route::post('/', 'MainController@submit')->name('submit');

    Route::group(['namespace' => 'Pdf', 'as' => 'pdf.'], function() {
        Route::get('/ktp/{card?}', 'IdentityCardController@pdf')->name('ktp');
        Route::get('/kia/{card?}', 'ChildIdCardController@pdf')->name('kia');
        Route::get('/kk/{card?}', 'FamilyCardController@pdf')->name('kk');
        Route::get('/al/{card?}', 'BirthCertificateController@pdf')->name('al');
        Route::get('/ak/{card?}', 'DeathCertificateController@pdf')->name('ak');
    });
});

Route::group(['prefix' => 'persyaratan', 'as' => 'requirement.'], function(){
    Route::get('/', 'RequirementsContentController@index')->name('index');
    Route::get('document', 'RequirementsContentController@getItem')->name('show');
});

Route::group(["prefix" => "cetak-ulang", 'as' => 'reprint.', 'namespace' => 'Reprint'], function(){

    Route::get('dokumen', 'MyDocumentController@index')->name('index');

    Route::get('ktp', 'IdentityCardController@index')->name('ktp.index');
    Route::post('ktp/submit', 'IdentityCardController@submit')->name('ktp.submit');

    Route::get('kk', 'FamilyCardController@index')->name('kk.index');
    Route::post('kk/submit', 'FamilyCardController@submit')->name('kk.submit');

    Route::get('akta-lahir', 'BirthCertificateController@index')->name('al.index');
    Route::post('akta-lahir/submit', 'BirthCertificateController@submit')->name('al.submit');

    Route::get('akta-kematian', 'DeathCertificateController@index')->name('ak.index');
    Route::post('akta-kematian/submit', 'DeathCertificateController@submit')->name('ak.submit');

    Route::get('kia', 'ChildIdentityCardController@index')->name('kia.index');
    Route::post('kia/submit', 'ChildIdentityCardController@submit')->name('kia.submit');

    Route::get('permintaan', 'ReprintRequestController@create')->name('check');
    Route::post('permintaan', 'ReprintRequestController@submit')->name('check.submit');
});

##########################################################################
######################## Admin Routes Starts Here ########################
##########################################################################

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.', 'middleware' => ["auth", "can:access-admin-page"]], function(){

    Route::get('login', function() {
        return view("admin.login");
    });

    Route::get('/', 'StatisticController@index');
    Route::get('/queue-list', 'QueueController@datatable')->name('queue.datatable');

    Route::group(['prefix' => 'pengajuan', 'namespace' => 'Submission', 'as' => 'submission.'], function() {
        Route::prefix('ktp')->group(function(){
            Route::view('/', 'admin.submission.ktp.index')->name('ktp');
            Route::get('/datatable', 'IdentityCardController@datatable')->name('ktp.datatable');
            Route::get('/edit/{card}', 'IdentityCardController@edit')->name('ktp.edit');
            Route::post('/update/{card}', 'IdentityCardController@update')->name('ktp.update');
            Route::post('/hapus/{card}', 'IdentityCardController@delete')->name('ktp.delete');
        });

        Route::prefix('kia')->group(function(){
            Route::view('/', 'admin.submission.kia.index')->name('kia');
            Route::get('/datatable', 'ChildIdCardController@datatable')->name('kia.datatable');
            Route::get('/edit/{card}', 'ChildIdCardController@edit')->name('kia.edit');
            Route::post('/update/{card}', 'ChildIdCardController@update')->name('kia.update');
            Route::post('/hapus/{card}', 'ChildIdCardController@delete')->name('kia.delete');
        });

        Route::prefix('kk')->group(function () {
            Route::view('/', 'admin.submission.kk.index')->name('kk');
            Route::get('/datatable', 'FamilyCardController@datatable')->name('kk.datatable');
            Route::get('/edit/{card}', 'FamilyCardController@edit')->name('kk.edit');
            Route::post('/update/{card}', 'FamilyCardController@update')->name('kk.update');
            Route::post('/hapus/{card}', 'FamilyCardController@delete')->name('kk.delete');
        });

        Route::prefix('akta-lahir')->group(function () {
            Route::view('/', 'admin.submission.al.index')->name('al');
            Route::get('/datatable', 'BirthCertificateController@datatable')->name('al.datatable');
            Route::get('/edit/{card}', 'BirthCertificateController@edit')->name('al.edit');
            Route::post('/update/{card}', 'BirthCertificateController@update')->name('al.update');
            Route::post('/hapus/{card}', 'BirthCertificateController@delete')->name('al.delete');
        });

        Route::prefix('akta-kematian')->group(function () {
            Route::view('/', 'admin.submission.ak.index')->name('ak');
            Route::get('/datatable', 'DeathCertificateController@datatable')->name('ak.datatable');
            Route::get('/edit/{card}', 'DeathCertificateController@edit')->name('ak.edit');
            Route::post('/update/{card}', 'DeathCertificateController@update')->name('ak.update');
            Route::post('/hapus/{card}', 'DeathCertificateController@delete')->name('ak.delete');
        });
    });

    Route::group(["prefix" => 'cetak-ulang', 'namespace' => 'Reprint', 'as' => 'reprint.'], function() {
        Route::get('/', 'ReprintController@index')->name('index');
        Route::get('/datatable', 'ReprintController@datatable')->name('datatable');
        Route::get('/edit/{reprint}', 'ReprintController@edit')->name('edit');
        Route::post('/delete/{reprint}', 'ReprintController@destroy')->name('destroy');
        Route::post('/submit/{reprint}', 'ReprintController@markAsPrinted')->name('submit');
    });

    Route::group(["prefix" => "persyaratan", "namespace" => "Requirement", "as" => "requirement."], function(){
        Route::get('/', 'RequirementController@index')->name('index');
        Route::post('/', 'RequirementController@store')->name('store');
    });

    Route::group(["prefix" => "arsip", "namespace" => "Stored", "as" => "stored."], function() {
        Route::group(["prefix" => "ktp" ,"as" => "ktp."], function(){
            Route::get('/', 'IdentityCardController@index')->name('index');
            Route::get('/datatable', 'IdentityCardController@datatable')->name('datatable');
            Route::get('/edit/{card}', 'IdentityCardController@edit')->name('edit');
            Route::post('/update/{card}', 'IdentityCardController@update')->name('update');
            Route::get('/export', 'IdentityCardController@export')->name('export');
        });

        Route::group(["prefix" => "akta-lahir", "as" => "al."], function () {
            Route::get('/', 'BirthCertificateController@index')->name('index');
            Route::get('/datatable', 'BirthCertificateController@datatable')->name('datatable');
            Route::get('/edit/{card}', 'BirthCertificateController@edit')->name('edit');
            Route::post('/update/{card}', 'BirthCertificateController@update')->name('update');
            Route::get('/export', 'BirthCertificateController@export')->name('export');
        });

        Route::group(["prefix" => "kia", "as" => "kia."], function () {
            Route::get('/', 'ChildIdController@index')->name('index');
            Route::get('/datatable', 'ChildIdController@datatable')->name('datatable');
            Route::get('/edit/{card}', 'ChildIdController@edit')->name('edit');
            Route::post('/update/{card}', 'ChildIdController@update')->name('update');
            Route::get('/export', 'ChildIdController@export')->name('export');

        });

        Route::group(["prefix" => "kk", "as" => "kk."], function () {
            Route::get('/', 'FamilyCardController@index')->name('index');
            Route::get('/datatable', 'FamilyCardController@datatable')->name('datatable');
            Route::get('/edit/{card}', 'FamilyCardController@edit')->name('edit');
            Route::post('/update/{card}', 'FamilyCardController@update')->name('update');
            Route::get('/export', 'FamilyCardController@export')->name('export');
        });

        Route::group(["prefix" => "akta-kematian", "as" => "ak."], function () {
            Route::get('/', 'DeathCertificateController@index')->name('index');
            Route::get('/datatable', 'DeathCertificateController@datatable')->name('datatable');
            Route::get('/edit/{card}', 'DeathCertificateController@edit')->name('edit');
            Route::post('/update/{card}', 'DeathCertificateController@update')->name('update');
            Route::get('/export', 'DeathCertificateController@export')->name('export');
        });
    });

    Route::group(["prefix" => "pengajuan-terkualifikasi", "namespace" => "Qualified", "as" => "qualified."], function() {
        Route::group(["prefix" => "ktp", "as" => "ktp."], function(){
            Route::get('/', 'IdentityCardController@index')->name('index');
            Route::get('/datatable', 'IdentityCardController@datatable')->name('datatable');
            Route::get('/edit/{card}', 'IdentityCardController@edit')->name('edit');
            Route::post('/update/{card}', 'IdentityCardController@update')->name('update');
        });

        Route::group(["prefix" => "akta-lahir", "as" => "al."], function(){
            Route::get('/', 'BirthCertificateController@index')->name('index');
            Route::get('/datatable', 'BirthCertificateController@datatable')->name('datatable');
            Route::get('/edit/{card}', 'BirthCertificateController@edit')->name('edit');
            Route::post('/update/{card}', 'BirthCertificateController@update')->name('update');
        });

        Route::group(["prefix" => "kia", "as" => "kia."], function () {
            Route::get('/', 'ChildIdCardController@index')->name('index');
            Route::get('/datatable', 'ChildIdCardController@datatable')->name('datatable');
            Route::get('/edit/{card}', 'ChildIdCardController@edit')->name('edit');
            Route::post('/update/{card}', 'ChildIdCardController@update')->name('update');
        });

        Route::group(["prefix" => "kk", "as" => "kk."], function () {
            Route::get('/', 'FamilyCardController@index')->name('index');
            Route::get('/datatable', 'FamilyCardController@datatable')->name('datatable');
            Route::get('/edit/{card}', 'FamilyCardController@edit')->name('edit');
            Route::post('/update/{card}', 'FamilyCardController@update')->name('update');
        });

        Route::group(["prefix" => "akta-kematian", "as" => "ak."], function() {
            Route::get('/', 'DeathCertificateController@index')->name('index');
            Route::get('/datatable', 'DeathCertificateController@datatable')->name('datatable');
            Route::get('/edit/{card}', 'DeathCertificateController@edit')->name('edit');
            Route::post('/update/{card}', 'DeathCertificateController@update')->name('update');

        });

    });
});




