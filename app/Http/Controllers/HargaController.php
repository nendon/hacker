<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;

class HargaController extends Controller
{
    public function index()
    {
      $packages = Package::all();
      return view('web.harga', [
        'packages' => $packages
      ]);
    }
}
