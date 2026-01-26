<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Desain;

class DesainController extends Controller
{
     public function index()
    {
        $desains = Desain::all();
        return view('design.index', compact('desains'));
    }
}
