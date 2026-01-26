<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ui;

class UiController extends Controller
{
        public function index()
        {
            $uis = Ui::all();
            return view('ui.index', compact('uis'));
        }
}
