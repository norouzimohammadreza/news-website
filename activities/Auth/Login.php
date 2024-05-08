<?php 
namespace Auth;
use database\DataBase;
class Login extends Auth{
     function index()
    {
        if(!isset($_SESSION['user'])){
        require_once((BASE_PATH) . '/template/auth/login.php');
    }else {
        $this->redirect('home');
    }}
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
    function checkAdmin(){
        if(isset($_SESSION['user'])){
            $db = new DataBase;
            $admin = $db->select('SELECT * FROM users WHERE id = ? AND is_admin = 1 ;',[$_SESSION['user']])->fetch();
            if(!$admin){
  
                $this->redirect('home');
             }
            //else{
            //     $this->redirect('admin');
            // }
        }else{
            $this->redirect('home');
        }
    }
    function logout(){
        if(isset($_SESSION['user'])){
            unset($_SESSION['user']);
            session_destroy();
        }
        $this->redirect('home');
    }
    function forgotPassword(){
        if(!isset($_SESSION['user'])){
            require_once((BASE_PATH) . '/template/auth/forgotPassword.php');
        }else {
            $this->redirect('home');
        }}
        
        function requestPassword($request){
           $db = new DataBase;
           if(filter_var($request['user'],FILTER_VALIDATE_EMAIL)){
            $user = $db->select('SELECT * FROM users WHERE email = ? AND is_active = 1 ;',[$request['user']])->fetch();
           }else{
            $user = $db->select('SELECT * FROM users WHERE username = ? AND is_active = 1 ;',[$request['user']])->fetch();
           }
           if($user == null){
            flash('error_pssfrg','The user is not found.');
            $this->redirectBack();
           }else{
            $randomToken = $this->random();
            $activationMessage = $this->forgotToken($user['username'],$randomToken);
            $email= $user['email'];
            $result = $this->sendMail($email,'Password Recovery', $activationMessage);
            if($result){
                date_default_timezone_set('Iran');
               $expire = date('Y-m-d H:i:s',strtotime('+15 minutes'));
               $db->update('users',$user['id'],['forget_token','forget_token_expire'],[$randomToken,$expire]);
               echo "<script>alert('Done')</script>";
               $this->redirect('login');
            }else{
                flash('error_pssfrg','Email could not be sent.');
                $this->redirectBack();
            }
        }
    }
 function resetPassword($token)
{
    $db = new DataBase;
    $user = $db->select('SELECT * FROM users WHERE forget_token = ?',[$token])->fetch();
    if($user && $token == $user['forget_token']){
        require_once((BASE_PATH) . '/template/auth/resetPassword.php');
    }else{
        $this->redirect('login');
    }
}
function newPassword($request,$token){
    $db = new DataBase;
    date_default_timezone_set('Iran');
    if(strlen($request['password']) >=8 && strlen($request['repassword'])>=8 ){
    if($request['password']==$request['repassword']){
        $user = $db->select('SELECT * FROM users WHERE forget_token = ? ',[$token])->fetch();
        if($user!=null){
        if($user['forget_token_expire'] > date('Y-m-d H:i:s')){
            $db->update('users',$user['id'],['password'],[$this->hash($request['password'])]);
            $this->redirect('login');
        }else{
            flash('error_reset','The password recovery period has expired.');
            $this->redirectBack();
        }
    }else{
        $this->redirect('login');
    }
    }else{
        flash('error_reset','The password and its repetition are not the same.');
        $this->redirectBack();
    }
}else{
    flash('error_reset','Please make the password more than 8 characters.');
    $this->redirectBack();
}
}
}
