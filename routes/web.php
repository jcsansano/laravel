<?php
namespace App\Http\Controllers;
use App\Http\Controllers;
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


Route::get('/', 'App\Http\Controllers\MainController@home')->name('inicio');

/** Grup de rutes de taules auxiliars **/

/** Rutes de Seus */
Route::group(['middleware'=>'web'], function(){
    Route::put('acutalitzaSeu/{edit_id}', 'App\Http\Controllers\SeuController@update')
        ->name('seusUpdate');
    Route::match(['get','post'],'llistaSeu', 'App\Http\Controllers\SeuController@index')
        ->name('seusList');
    Route::get('novaSeu',   'App\Http\Controllers\SeuController@create') 
        ->name('seusCreate');
    Route::post('editaSeu',  'App\Http\Controllers\SeuController@edit')
        ->name('seusEdit');
    Route::post('emmagatzemaSeus', 'App\Http\Controllers\SeuController@store')
        ->name('seusStore');    
    
    Route::post('baixaSeu', 'App\Http\Controllers\SeuController@destroy')
        ->name('seusDestroy');
    Route::post('canviSeu', 'App\Http\Controllers\SeuController@changeState')
        ->name('seusChangeState');
});

/** Rutes d'OrganAcreditador */
Route::group(['middleware'=>'web'], function(){
    Route::match(['get','post'],'llistaOrgAcred', 'App\Http\Controllers\OrgAcreditControlador@index')->name('orgAcredList');
    Route::get('nouOrgAcred', 'App\Http\Controllers\OrgAcreditControlador@create')->name('orgAcredCreate');
    Route::post('grabarOrgAcred', 'App\Http\Controllers\OrgAcreditControlador@store')->name('orgAcredStore');
    Route::post('updateOrgAcred', 'App\Http\Controllers\OrgAcreditControlador@update')->name('orgAcredUpdate');
//  Route::post('baixaOrgAcred', 'App\Http\Controllers\OrgAcreditControlador@destroy')->name('orgAcredBaixa'); 
    Route::post('voreOrgAcred', 'App\Http\Controllers\OrgAcreditControlador@show')->name('orgAcredShow');
    Route::post('canviOrgAcred', 'App\Http\Controllers\OrgAcreditControlador@changeState')->name('orgAcredChangeState');
    
});
    
/** Rutes d'Acreditacions */
    Route::group(['middleware'=>'web'], function(){
    Route::match(['get','post'],'llistaAcredit', 'App\Http\Controllers\AcreditacioControlador@index')->name('acreditList');
    Route::post('nouAcredit', 'App\Http\Controllers\AcreditacioControlador@create')->name('acreditNou');
    Route::post('grabarAcredit', 'App\Http\Controllers\AcreditacioControlador@store')->name('acreditStore');
    Route::post('editAcredit', 'App\Http\Controllers\AcreditacioControlador@edit')->name('acreditEdit');
    Route::post('updateAcredit', 'App\Http\Controllers\AcreditacioControlador@update')->name('acreditUpdate');
    Route::post('baixaAcredit', 'App\Http\Controllers\AcreditacioControlador@destroy')->name('acreditBaixa');    
    Route::post('canviAcredit', 'App\Http\Controllers\AcreditacioControlador@changeState')->name('acreditChangeState');
}); 

/** Rutes de Col·laboladors */
 //   Route::group(['middleware'=>'web'], function(){
   // Route::get('llistaColaborador', 'App\Http\Controllers\ColaboradorsCo@index')->name('colaboradorsList');
//    Route::get('nouColaborador', 'App\Http\Controllers\ColaboradorsControlador@create')->name('colaboradorsNou');
   // Route::get('editaColaborador/{Acredit}', 'App\Http\Controllers\ColaboradorControlador@edit')->name('colaboradorsEdita');
  //Route::post('baixaColaborador', 'App\Http\Controllers\ColaboradorControlador@destroy')->name('colaboradorsBaixa');    
//});


Route::get('/hola/{persona?}', 'App\Http\Controllers\PrimerControlador@hola');

Route::get('/usuarinou', function(){ return view('usuariCrear'); });

Route::resource('/seus', 'App\Http\Controllers\SeuController');


Route::resource('/usuaris', 'App\Http\Controllers\UsuariController');