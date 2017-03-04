<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Tools\ProfileTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Demo extends Controller
{
    use ProfileTrait;

    public function index(Request $request)
    {
        $profile = $this->profile($request);

        return view('admin.demo', compact('profile'));
    }
}
