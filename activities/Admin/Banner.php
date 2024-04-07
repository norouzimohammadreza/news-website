<?php
namespace Admin;
use database\DataBase;
class Banner extends Admin{
    function index(){
        $db = new DataBase;
        $banners = $db->select('SELECT * FROM banners')->fetchAll();
        require_once((BASE_PATH) . '/template/admin/banner/index.php');
    }
    function create(){
       
        require_once((BASE_PATH) . '/template/admin/banner/create.php');
    }
    function store($request){
        $db = new DataBase;
        $request['image'] = $this->saveImage($request['image'], 'banner-image');

            if ($request['image']) {
               
                $db->insert('banners', array_keys($request), array_values($request));
            } 
            $this->redirect('admin/banner');
        }
}