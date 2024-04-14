<?php
//session request

use database\Database;

session_start();


//config 
define('BASE_PATH', __DIR__);
define('CURRENT_DOMAIN', currentDomain() . '/projects/news-php/');
define('DISPLAY_ERROR', true);
define('HOST', 'localhost');
define('DB_NAME', 'news_tutorial');
define('USER_NAME', 'root');
define('PASSWORD', '');
require_once ('database/Database.php');
require_once ('activities/Admin/Admin.php');
require_once ('activities/Admin/Category.php');
require_once ('activities/Admin/Post.php');
require_once ('activities/Admin/Banner.php');
require_once ('activities/Admin/User.php');
require_once ('activities/Admin/Comment.php');
require_once ('activities/Admin/Menu.php');
require_once ('activities/Admin/WebSetting.php');
require_once ('activities/Auth/Auth.php');
require_once ('activities/Auth/Register.php');
require_once ('activities/Auth/login.php');


spl_autoload_register(function ($className)
{
    $path = BASE_PATH . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR;
    include $path . $className .'.php';
});
function jalaliData($date){
    return \Parsidev\Jalali\jdate::forge($date)->format('datetime');
}
// echo jalaliData('today');
// exit;


//mail
define('MAIL_HOST', 'smtp.gmail.com');
define('SMTP_AUTH', true);
define('MAIL_USERNAME', 'newsa720@gmail.com');
define('MAIL_PASSWORD', 'qinjlklkklttuugh');
define('MAIL_PORT', 587);
define('SENDER_MAIL', 'newsa720@gmail.com');
define('SENDER_NAME', 'NEWS');





//routing helper
function uri($reservedUrl, $class, $method, $requestMethod = 'GET')
{
    //current url array
    $currentUrl = explode('?', currentUrl())[0];
    $currentUrl = str_replace(CURRENT_DOMAIN, '', $currentUrl);
    $currentUrl = trim($currentUrl, '/');
    $currentUrlArray = explode('/', $currentUrl);
    $currentUrlArray = array_filter($currentUrlArray);

    //reserved url array
    $reservedUrl = trim($reservedUrl, '/');
    $reservedUrlArray = explode('/', $reservedUrl);
    $reservedUrlArray = array_filter($reservedUrlArray);

    // compare (reserved url) with (current url)
    if ((sizeof($reservedUrlArray) != sizeof($currentUrlArray)) && methodField() != $requestMethod) {
        return false;
    }
    ///admin/panel/edit/{id} reserved url
    // admin/panel/edit/5 current url
    $parameters = [];
    for ($ix = 0; $ix < sizeof($currentUrlArray); $ix++) {
        if ($reservedUrlArray[$ix][0] == '{' && $reservedUrlArray[$ix][strlen($reservedUrlArray[$ix]) - 1] == '}') {
            array_push($parameters, $currentUrlArray[$ix]);
        } else if ($reservedUrlArray[$ix] !== $currentUrlArray[$ix]) {
            return false;
        }
    }
    if(methodField()=='POST'){
       global $request;
       if (isset($_FILES)) {
       $request = array_merge($_FILES,$_POST);
       }else{
        $request = $_POST;
       }
       $parameters = array_merge([$request],$parameters);
    }
    $object = new $class;
    call_user_func_array(array($object,$method),$parameters);
    exit;
}



//helpers
function dd($var)
{
    echo"<pre>";
    var_dump($var);
    exit;
}
function protocol()
{
    if (strpos($_SERVER['SERVER_PROTOCOL'], 'https') === true) {
        return 'https://';
    } else {
        return 'http://';
    }
}
function currentDomain()
{
    return protocol() . $_SERVER['HTTP_HOST'];
}
function asset($file)
{
    return trim(CURRENT_DOMAIN, '/ ') . '/' . trim($file, '/');
}
function url($url)
{
    return trim(CURRENT_DOMAIN, '/ ') . '/' . trim($url, '/');
}
function currentUrl()
{
    return currentDomain() . $_SERVER['REQUEST_URI'];
}
function methodField()
{
    return $_SERVER['REQUEST_METHOD'];
}
function displayError($error)
{
    if ($error) {
        ini_set('display_erorrs', 0);
        ini_set('display_startup_erorrs', 0);
        error_reporting(0);
    } else {
    }
}
displayError(DISPLAY_ERROR);

global $flashMessage;

function flash($name, $value = null)
{
    global $flashMessage;

    if ($value === null) {
        if (isset($_SESSION['flash_message'][$name])) {
            $flashMessage[$name] = $_SESSION['flash_message'][$name];
            unset($_SESSION['flash_message'][$name]);
        }
        global $flashMessage;
        $message = isset($flashMessage[$name]) ? $flashMessage[$name] : '';
        return $message;
    } else {
        $_SESSION['flash_message'][$name] = $value;
    }
}
/*flash('loginError', 'ورود شما با مشکل همراه شده است');
echo (flash('loginError') ." </br>");
flash('product', 'محصول به سبد خرید شما اضافه شد');
echo (flash('product') ." </br>");
echo (flash('loginError') ." </br>");*/

//catogory
uri('admin/category', 'Admin\Category', 'index');
uri('admin/category/create', 'Admin\Category', 'create');
uri('admin/category/store', 'Admin\Category', 'store', 'POST');
uri('admin/category/edit/{id}', 'Admin\Category', 'edit');
uri('admin/category/update/{id}', 'Admin\Category', 'update', 'POST');
uri('admin/category/delete/{id}', 'Admin\Category', 'delete');


//post
uri('admin/post', 'Admin\Post', 'index');
uri('admin/post/create', 'Admin\Post', 'create');
uri('admin/post/store', 'Admin\Post', 'store', 'POST');
uri('admin/post/edit/{id}', 'Admin\Post', 'edit');
uri('admin/post/update/{id}', 'Admin\Post', 'update', 'POST');
uri('admin/post/delete/{id}', 'Admin\Post', 'delete');
uri('admin/post/selected/{id}', 'Admin\Post', 'selected');
uri('admin/post/breaking-news/{id}', 'Admin\Post', 'breakingNews');

//banner
uri('admin/banner', 'Admin\Banner', 'index');
uri('admin/banner/create', 'Admin\Banner', 'create');
uri('admin/banner/store', 'Admin\Banner', 'store', 'POST');
uri('admin/banner/edit/{id}', 'Admin\Banner', 'edit');
uri('admin/banner/update/{id}', 'Admin\Banner', 'update', 'POST');
uri('admin/banner/delete/{id}', 'Admin\Banner', 'delete');

//user
uri('admin/user', 'Admin\User', 'index');
uri('admin/user/edit/{id}', 'Admin\User', 'edit');
uri('admin/user/update/{id}', 'Admin\User', 'update', 'POST');
uri('admin/user/isadmin/{id}', 'Admin\User', 'isAdmin');
uri('admin/user/delete/{id}', 'Admin\User', 'delete');

//comments
uri('admin/comment', 'Admin\Comment', 'index');
uri('admin/comment/change/{id}', 'Admin\Comment', 'change');

//menus
uri('admin/menu', 'Admin\Menu', 'index');
uri('admin/menu/create', 'Admin\Menu', 'create');
uri('admin/menu/store', 'Admin\Menu', 'store', 'POST');
uri('admin/menu/edit/{id}', 'Admin\Menu', 'edit');
uri('admin/menu/update/{id}', 'Admin\Menu', 'update', 'POST');
uri('admin/menu/delete/{id}', 'Admin\Menu', 'delete');

//web-setting
uri('admin/web-setting', 'Admin\WebSetting', 'index');
uri('admin/web-setting/edit', 'Admin\WebSetting', 'edit');
uri('admin/web-setting/update', 'Admin\WebSetting', 'update', 'POST');

//َAuth
uri('register', 'Auth\Register', 'index');
uri('register/store', 'Auth\Register', 'store', 'POST');
uri('activation/{verify_token}', 'Auth\Register', 'activation');
uri('login', 'Auth\Login', 'index');
uri('check-login', 'Auth\Login', 'checkLogin', 'POST');
uri('logout', 'Auth\Login', 'logout');
uri('forgot-password', 'Auth\Login', 'forgotPassword');
uri('forgot-password/request', 'Auth\Login', 'requestPassword','POST');
uri('reset-password/{token}', 'Auth\Login', 'resetPassword');
uri('new-password/{token}', 'Auth\Login', 'newPassword','POST');

echo '404';
