<?php

namespace App\Http\Controllers;

use App\Horario;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
    	return view('admin.index');
    }

    public function mostrar() {
        return view('admin.show');
    }
}
