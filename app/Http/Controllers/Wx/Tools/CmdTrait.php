<?php
namespace App\Http\Controllers\Wx\Tools;

trait CmdTrait
{
    private function cmd($code, $msg, $data=[])
    {
        return [
            'code' => $code,
            'msg'  => $msg,
            'data' => $data
        ];
    }
}