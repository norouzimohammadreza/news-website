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
}
