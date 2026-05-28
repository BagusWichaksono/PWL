<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Route;

class WelcomeController extends Controller
{
    // public function hello() {
    //     return 'Hello World';
    // }

    public function index() {
        return 'Selamat Datang';
    }

    public function about() {
        return 'Bagus, 244107020238';
    }

    public function articles($id) {
        return 'Halaman  Artikel dengan Id '.$id;
    }

    public function hello(){
        return('Hello World');
    }

    public function greeting(){
        return view('blog.hello')
            ->with('name','Bagus')
            ->with('occupation','Astronaut');
    }
}
