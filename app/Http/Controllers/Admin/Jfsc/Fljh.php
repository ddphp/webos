<?php

namespace App\Http\Controllers\Admin\Jfsc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Fljh extends Controller
{
    public function index()
    {
        return view('admin.jfsc.fljh.index');
    }
}
