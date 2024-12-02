<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Arsip;
use App\Models\Kategorisurat;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [
            'title' => 'Home',
            'menu' => 'home',
            'submenu' => '',
            'type' => 'home',
            'countUser' => User::count('id'),
            'countArsip' => Arsip::count('id'),
            'countKategorisurat' => Kategorisurat::count('id'),
            'arsips' => Arsip::latest()->limit(7)->get() // Limit to 5 recent records
        ];
        return view('home', $data);
    }
}
