<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\User;

class UsersController extends Controller
{
    public function index(){
        $objUsers = new User();
        $users = $objUsers->get();
        return view('admin.users.index',['users' => $users]);
    }
}
