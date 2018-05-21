<?php
namespace App\Modules\User;

use Route;
                
$namespace = 'App\Modules\User\Controllers';

Route::group(['prefix'=>'/','namespace'=>'App\Modules\User\Controllers'],function(){
	//route here
	Route::get('user',"UserController@index");
});