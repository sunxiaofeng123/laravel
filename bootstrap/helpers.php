<?php
/**
 * Created by PhpStorm.
 * User: sunxiaofeng
 * Date: 2018/10/7
 * Time: 15:58
 * composer.json 辅助函数文件自动加载。在命令行使用 composer dumpautoload
 */

/**
 * 此方法会将当前请求的路由名称转换为 CSS 类名称，作用是允许我们针对某个页面做页面样式定制
 */
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}
