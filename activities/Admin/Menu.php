<?php 
namespace Admin;
use database\DataBase;
class Menu extends Admin{
    function index(){
        $db = new DataBase;
        $menus = $db->select('SELECT m1.*,m2.name AS par_name FROM menus m1
        LEFT JOIN menus m2 ON m1.parent_id = m2.id
     order by id DESC')->fetchAll();
        require_once((BASE_PATH) . '/template/admin/menu/index.php');
    }
    function create(){
        $db = new DataBase;
        $menus = $db->select('SELECT * FROM menus
     order by id DESC')->fetchAll();
        require_once((BASE_PATH) . '/template/admin/menu/create.php');
    }
    function store($request){
        $db = new DataBase;
        if($request['parent_id'] == 0){
            $request['parent_id'] = null;
        }
        $db->insert('menus', array_keys($request), array_values($request));
        $this->redirect('admin/menu');
    }
    function edit($id){
        $db = new DataBase;
        $menu = $db->select('SELECT * FROM menus WHERE id = ?
     order by id DESC',[$id])->fetch();
     $menus =$db->select('SELECT * FROM menus
     order by id DESC')->fetchAll();
    
        require_once((BASE_PATH) . '/template/admin/menu/edit.php');
    }
    function update($request,$id){
        $db = new DataBase;
        if($request['parent_id'] == 0){
            $request['parent_id'] = null;
        }
        $db->update('menus',$id,array_keys($request),array_values($request));
        $this->redirect('admin/menu');
    }
    
    function delete($id){
        $db = new DataBase;
        $db->delete('menus',$id);
        $this->redirectBack();
    }
}