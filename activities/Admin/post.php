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
        if ($request['cat_id']) {

            $request['image'] = $this->saveImage($request['image'], 'post-image');

            if ($request['image']) {
                $request = array_merge($request, ['user_id' => 1]);
                $db->insert('posts', array_keys($request), array_values($request));
            } else {
                dd($request);
            }
            $this->redirect('admin/post');
        }
    }
    function delete($id)
    {
        $db = new Database;
        $post = $db->select('SELECT * FROM posts WHERE id = ?', [$id])->fetch();

        $this->removeImage($post['image']);

        $db->delete('posts', $id);
        $this->redirect('admin/post');
    }
    function selected($id)
    {
        $db = new Database;
        $post = $db->select('SELECT * FROM posts WHERE id = ?', [$id])->fetch();
        
        if ($post['selected'] == 1) {
            $post['selected'] = 0;
        } else {
            $post['selected'] = 1;
        }
    
        $db->update('posts',$id,['selected'],[$post['selected']]);
        $this->redirectBack();
    }
    function breakingNews($id)
    {
        
        $db = new Database;
        $post = $db->select('SELECT * FROM posts WHERE id = ?', [$id])->fetch();
        
        if ($post['breaking_news'] == 1) {
            $post['breaking_news'] = 0;
        } else {
            $post['breaking_news'] = 1;
        }
        
    
        $db->update('posts',$id,['breaking_news'],[$post['breaking_news']]);
        $this->redirectBack();
    }
}
