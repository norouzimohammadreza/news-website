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
        function edit($id)
    {
        
        $db = new Database;
        $banner = $db->select('SELECT * FROM banners WHERE id=?', [$id])->fetch();
        require_once((BASE_PATH) . '/template/admin/banner/edit.php');
    }
        function update($request, $id){
            $db = new Database;
        
            if ($request['image']['tmp_name'] != null) {
                
                $banner = $db->select('SELECT * FROM banners WHERE id=?', [$id])->fetch();
                $this->removeImage($banner['image']);
                $request['image'] = $this->saveImage($request['image'], 'banner-image');
            } else {
                unset($request['image']);
            }
            
            $db->update('banners', $id, array_keys($request), array_values($request));
        
        $this->redirect('admin/banner');
        }
        function delete($id)
    {   
        
        $db = new Database;
        $banner = $db->select('SELECT * FROM banners WHERE id = ?', [$id])->fetch();

        $this->removeImage($banner['image']);

        $db->delete('banners', $id);
        $this->redirect('admin/banner');
    }
}