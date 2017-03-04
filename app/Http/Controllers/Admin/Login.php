<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\NMTrait;
use App\Models\Admin\Account;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Login extends Controller
{
    use NMTrait;

    public function __construct()
    {
        $this->setRetErr('admin');
    }

    public function index()
    {
        if (\Session::has('admin')) {
            return \Redirect::to(route('admin.profile').'?t=menu&i=2');
        }

        $head = [
            'html' => ['class' => 'uk-height-1-1'],
            'body' => ['class' => 'uk-height-1-1'],
        ];

        return view('admin.login', compact('head'));
    }

    public function store(Request $request)
    {
        if (\Session::has('admin')) {
            $this->setRet(100003, ['存在已登录用户']);
        } else {
            $accountInput = $request->input();
            $accountModel = Account::where('user', $accountInput['user'])->first();
            if ($accountModel) {
                if ($accountModel['pass'] === '') {
                    $error = '';
                    if (\Oa\User::checkPw($accountInput['user'], $accountInput['pass'], $error)) {
                        $this->success($accountModel);
                    } else {
                        $this->setRet(100003, [$error]);
                    }
                } else {
                    if ($accountInput['pass'] == $accountModel['pass']) {
                        $this->success($accountModel);
                    } else {
                        $this->setRet(100001);
                    }
                }
            } else {
                $this->setRet(100002, [$accountInput['user']]);
            }
        }
        return $this->getRet();
    }

    private function success($accountModel)
    {
        session(['admin.user.account' => $accountModel->toArray()]);

        $info = \DB::connection('oa')->table('user')
            ->where('USER_ID', 30068)
            ->select(['USER_ID', 'USER_NAME', 'USER_PRIV_NAME'])
            ->first();
        if ($info) {
            session(['admin.user.info' => (array) $info]);
        }

        $this->setRet('登录成功');
    }
}
