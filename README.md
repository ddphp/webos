# Webos Laravel 5.3 框架

集合了私人项目在 Laravel 5.3 安装后的常用扩展模块，以避免重复性工作。

## 安装

`composer create-project --prefer-dist phpv/webos [project] ["5.2.*"]`

**如果你的model是extend的Eloquent，这个插件还可以给项目中的model添加phpDoc，直接显示字段名，便于阅读**  

`php artisan ide-helper:models MyModel`