<?php

namespace Admin;

use database\DataBase;

class Comment extends Admin
{
    function index()
    {

        $db = new DataBase;
        $comments = $db->select('SELECT comments.*,
         posts.title AS post_name,
         users.username AS user_name
       FROM comments LEFT JOIN posts ON comments.post_id = posts.id
       LEFT JOIN users ON comments.user_id = users.id order by id DESC')->fetchAll();
        require_once((BASE_PATH) . '/template/admin/comment/index.php');
    }
    function change($id)
    {
        $db = new DataBase;
        $comment = $db->select('SELECT * FROM comments WHERE id = ? ', [$id])->fetch();
        if($comment['status']==='seen'){
            $comment['status']='approved';
        }else {
           
            $comment['status']='seen';
        }
        $db->update('comments',$id,['status'],[$comment['status']]);
        $this->redirectBack();
    }
}
