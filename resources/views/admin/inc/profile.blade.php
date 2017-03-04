@extends('admin.inc.base')

@section('foot')
    <script src="{{ asset('ctrl/admin/index.js') }}"></script>
@stop

@section('body')
    <nav class="uk-navbar uk-navbar-attached uk-margin-bottom">
        <a href="javascript:" class="uk-navbar-brand"><i class="uk-icon-home"></i></a>
        <ul class="uk-navbar-nav">
            @foreach(\App\Models\Admin\MenuGroup::orderBy('sort')->select(['id', 'name'])->get() as $g)
                <li class="uk-parent" data-uk-dropdown>
                    <a href="javascript:">{{ $g->name }}</a>
                    <div class="uk-dropdown uk-dropdown-navbar">
                        <ul class="uk-nav uk-nav-navbar">
                            @foreach($g->menu->sortBy('group_num')->groupBy('group_num') as $m)
                                @foreach($m as $menu)
                                    <li>
                                        <a href="{{ route('admin.profile')."?t=menu&i={$menu->id}" }}">
                                            @if ($menu->icon)
                                                <i class="fa fa-{{ $menu->icon }}" aria-hidden="true"></i> {{ $menu->name }}
                                            @else
                                                &nbsp;&nbsp;&nbsp; {{ $menu->name }}
                                            @endif
                                        </a>
                                    </li>
                                @endforeach
                                @if (!$loop->last)
                                    <li class="uk-nav-divider"></li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </li>
            @endforeach
            <li class="uk-parent" data-uk-dropdown>
                <a href="#">微信</a>
                <div class="uk-dropdown uk-dropdown-navbar">
                    <ul class="uk-nav uk-nav-navbar">
                        <li><a href="https://mp.weixin.qq.com" target="_blank">公众号</a></li>
                        <li><a href="https://mpkf.weixin.qq.com" target="_blank">多客服</a></li>
                    </ul>
                </div>
            </li>
        </ul>
        <div id="app-user" class="uk-navbar-flip uk-margin-right">
            <ul class="uk-navbar-nav">
                <li class="uk-parent" data-uk-dropdown>
                    <a href=""><i class="uk-icon-user"></i> 彭未峰 <i class="uk-icon-caret-down"></i></a>
                    <div class="uk-dropdown uk-dropdown-navbar">
                        <ul class="uk-nav uk-nav-navbar">
                            <li>
                                <a v-on:click="logout('{{ route('admin.logout') }}', '{{ route('admin.login.index') }}')">
                                    <i class="uk-icon-sign-out"></i> 退出登录
                                </a>
                            </li>
                            <li class="uk-nav-divider"></li>
                            <li>
                                <a  v-on:click="info('{{ route('admin.system.user') }}')">
                                    <i class="uk-icon-user"></i> 个人资料
                                </a>
                            </li>
                            {{--<li><a href=""><i class="uk-icon-lock"></i> 修改密码</a></li>--}}
                            <li class="uk-nav-divider"></li>
                            {{--<li><a  href=""><i class="uk-icon-envelope-square"></i> 意见反馈</a></li>--}}
                            <li>
                                <a v-on:click="info('{{ route('admin.system.info') }}')">
                                    <i class="uk-icon-info-circle"></i> 系统信息
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <div class="uk-navbar-content uk-navbar-center">微信公众号管理系统</div>
    </nav>
    <div class="uk-width-8-10 uk-container-center">
        <div class="uk-grid uk-grid-divider">
            <div class="uk-width-1-4">
                <ul class="uk-nav uk-nav-side uk-nav-parent-icon" data-uk-nav>
                    <li class="uk-nav-header"><i class="uk-icon-lastfm"></i> {{ $profile['menu']->name }} <i class="fa fa-lastfm fa-rotate-180"></i></li>
                    <li class="uk-nav-divider"></li>
                    @foreach(\App\Models\Admin\Lists::where('menu_id', $profile['menu']->id)->get()->sortBy('sort')->groupBy('gnum') as $lists)
                        @foreach($lists as $list)
                            @if($list->act)
                                <li class="{{ $profile['curr']===$list->id ? 'uk-active' : ''  }}">
                                    <a href="{{ menu_route($list->act)."?t=list&i={$list->id}" }}">
                                        {{ $list->name }}
                                    </a>
                                </li>
                            @else
                                <li class="uk-parent {{ $profile['curr']===$list->id ? 'uk-active' : ''  }}">
                                    <a href="#">{{ $list->name }}</a>
                                    <ul class="uk-nav-sub">
                                        @foreach($list->child->sortBy('gnum')->groupBy('gnum') as $children)
                                            @foreach($children as $child)
                                                <li>
                                                    <a href="{{ menu_route($child->act)."?t=item&i={$child->id}" }}">
                                                        @if ($child->icon)
                                                            <i class="uk-icon-{{ $child->icon }}"></i> {{ $child->name }}
                                                        @else
                                                            &nbsp;&nbsp;&nbsp; {{ $child->name }}
                                                        @endif
                                                    </a>
                                                </li>
                                            @endforeach
                                            @if (!$loop->last)
                                                <li class="uk-nav-divider"></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                        @endforeach
                        @if (!$loop->last)
                            <li class="uk-nav-divider"></li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="uk-width-3-4">
                <ul class="uk-breadcrumb uk-margin-bottom">
                    <li class="uk-text-bold">当前位置：</li>
                    @foreach($profile['crumb'] as $crumb)
                        @if ($crumb['act'])
                            @if (!$loop->last)
                                <li><a href="{{ menu_route($crumb['act']).$crumb['param'] }}">{{ $crumb['name'] }}</a></li>
                            @else
                                <li class="uk-active"><span>{{ $crumb['name'] }}</span></li>
                            @endif
                        @else
                            <li><span>{{ $crumb['name'] }}</span></li>
                        @endif
                    @endforeach
                </ul>
                <hr class="uk-divider">
                @yield('profile')
            </div>
        </div>
    </div>
@stop