<?php
namespace App\Http\Controllers;

trait NMTrait
{
    protected $_ret = [
        'num' => 0,
        'msg' => ''
    ];

    protected $_err = [];

    protected function setRetErr($moduleName)
    {
        $this->_err = config('errors.'.$moduleName) + $this->_err;
    }

    /**
     * @param int|string $num
     * @param array $args
     * @throws NMException
     */
    protected function setRet($num, $args = [])
    {
        if (is_string($num)) {
            $err = $num;
            $num = 0;
        } else {
            $err = $this->_err[$num];
        }

        if (isset($err)) {
            if (is_array($err)) {
                $this->_ret['num'] = $num;
                $this->_ret['msg'] = json_decode(vsprintf(json_encode($err), $args));
            } else {
                $this->_ret['num'] = $num;
                $this->_ret['msg'] = vsprintf($err, $args);
            }
        } else {
            throw new NMException('错误未定义');
        }
    }

    protected function getRet()
    {
        return $this->_ret;
    }
}