<?php 
namespace Auth;
use database\DataBase;
class Login extends Auth{
     function index()
    {
        require_once((BASE_PATH) . '/template/auth/login.php');
    }
    function checkLogin($request){
       
       if(empty($request['user']) ||empty($request['password']) ){
        flash('error_login','Please fill in all the fields.');
        $this->redirectBack();
    }else{
     $db = new DataBase;
     if(filter_var($request['user'],FILTER_VALIDATE_EMAIL)){
        $user = $db->select('SELECT * FROM users WHERE email = ? AND is_active = 1 ;',[$request['user']])->fetch();
       }else{
        $user = $db->select('SELECT * FROM users WHERE username = ? AND is_active = 1 ;',[$request['user']])->fetch();
       }
       
       if($user){
        if(password_verify($request['password'],$user['password'])){
            $_SESSION['user'] = $user['id'];
            $this->redirect('admin');
        }else{
            flash('error_login','The password is not valid.');
            $this->redirectBack();
        }
       }else{
        flash('error_login','The user is not registered.');
        $this->redirectBack();
       }
      
    }
       
    }
}