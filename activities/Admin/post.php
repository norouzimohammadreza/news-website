<?php

namespace Admin;

use database\DataBase;

class Post extends Admin
{
    function index()
    {
        $db = new DataBase;
        $posts = $db->select('SELECT * FROM posts order by id DESC')->fetchAll();
        require_once((BASE_PATH) . '/template/admin/post/index.php');
    }
    function create()
    {
        $db = new DataBase;
        $categories = $db->select('SELECT * FROM categories order by id DESC')->fetchAll();
        require_once((BASE_PATH) . '/template/admin/post/create.php');
    }
    function store($request)
    {
        
        $realTimeStamp = substr($request['published_time'], 0, 10);
        $request['published_time'] = date('Y-m-d H:i:s', (int)$realTimeStamp);
        $db = new DataBase;
        if($request['cat_id']){
            
            $request['image'] = $this->saveImage($request['image'],'post-image');
         
            if ($request['image']) {
                $request = array_merge($request,['user_id'=>1]);
                $db->insert('posts',array_keys($request),array_values($request));
                
            }else{
                dd($request);
                
            }
            $this->redirect('admin/post');
        }
        
    }
}
