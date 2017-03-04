<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Tools\ProfileTrait;
use App\Http\Controllers\NMTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Index extends Controller
{
    use NMTrait;
    use ProfileTrait;

    public function index(Request $request)
    {
        $profile = $this->profile($request);
        \Clockwork::alert($profile);

        return view('admin.index', compact('profile'));
    }

    public function logout()
    {
        session(['admin' => null]);

        $this->setRet('操作成功');

        return $this->getRet();
    }
}
