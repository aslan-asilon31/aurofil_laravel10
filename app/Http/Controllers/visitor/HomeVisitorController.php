<?php

namespace App\Http\Controllers\visitor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class HomeVisitorController extends Controller
{
    public function index(){
        $users = User::count();
        return view('visitor.index', compact('users'));
    }
}
