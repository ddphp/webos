<!--success toast-->
<div id="toast" style="display: none;" v-show="show.toast">
    <div class="weui-mask_transparent"></div>
    <div class="weui-toast">
        <i class="weui-icon-success-no-circle weui-icon_toast"></i>
        <p class="weui-toast__content">@{{ toast }}</p>
    </div>
</div>
{{--loading toast--}}
<div id="loading" style="display: none;" v-show="show.loading">
    <div class="weui-mask_transparent"></div>
    <div class="weui-toast">
        <i class="weui-loading weui-icon_toast"></i>
        <p class="weui-toast__content">数据加载中</p>
    </div>
</div>
{{-- tips --}}
<div class="weui-toptips weui-toptips_warn js_tooltips" :style="style.tips">@{{ tips }}</div>