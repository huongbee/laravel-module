<?php
namespace App\Modules\User\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller{
    function index(){
        $author = "Huong Huong";
        return view("User::home", compact('author'));
    }
}