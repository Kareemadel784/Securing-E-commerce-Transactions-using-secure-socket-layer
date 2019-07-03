<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Auth;
use App\User;
class Logincontroller extends Controller
{

    public function index()
    {
        return view('admin.login.login');
    }
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect(route('login'));
    }
}
