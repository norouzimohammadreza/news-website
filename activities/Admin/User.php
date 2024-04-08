<?php

namespace Admin;

use database\DataBase;

class User extends Admin
{
    function index()
    {
        $db = new DataBase;
        $users = $db->select('SELECT * FROM users')->fetchAll();
        require_once((BASE_PATH) . '/template/admin/user/index.php');
    }
    function isAdmin($id)
    {
        $db = new DataBase;
        $user = $db->select('SELECT * FROM users WHERE id= ?', [$id])->fetch();
        
        if ($user['is_admin'] == 1) {
            
            $user['is_admin'] = 0;
        } else {
            $user['is_admin'] = 1;
        }
        
        $db->update('users',$id,['is_admin'],[$user['is_admin']]);
        $this->redirectBack();
        }
        function delete($id){
            $db = new DataBase;
            $db->delete('users',$id);
            $this->redirectBack();
        }
        function edit($id){
            $db = new DataBase;
            $user = $db->select('SELECT * FROM users WHERE id= ?', [$id])->fetch();
            require_once((BASE_PATH) . '/template/admin/user/edit.php');
        }
        function update($request,$id){
            //dd($request);
            $db = new DataBase;
            $db->update('users',$id,array_keys($request),array_values($request));
            $this->redirect('admin/user');
        }
}
