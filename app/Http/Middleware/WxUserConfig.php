<?php

namespace App\Http\Middleware;

use App\Models\Admin\Config;
use Closure;

class WxUserConfig
{
    use \App\Traits\Config;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $onlyWx = 'no')
    {
        $wechat = $this->config('mp.base');
        if ($wechat) {
            config(['wechat' => $wechat]);
            if ($onlyWx !== 'yes') {
                config([
                    'app.company'  => $this->config('member.company'),
                    'app.sms'      => $this->config('member.sms'),
                    'app.sms_code' => $this->config('member.verify'),
                    'app.card'     => $this->config('member.card')
                ]);
                return $next($request);
            }
        }
        return abort(404);
    }
}
