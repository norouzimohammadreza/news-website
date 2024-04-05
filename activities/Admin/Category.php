<?php

namespace Admin;

use database\Database;

class Category extends Admin
{
  function index()
  {
    $db = new Database;
    $categories = $db->select('SELECT * FROM categories order by id DESC')->fetchAll();
    require_once((BASE_PATH) . '/template/admin/category/index.php');
  }
  function create()
  {
    require_once((BASE_PATH) . '/template/admin/category/create.php');
  }
  function store($request)
  {
    $db = new DataBase();
    $db->insert('categories', array_keys($request), array_values($request));
    $this->redirect('admin/category');
  }
  function edit($id)
  {
    $db = new Database;
    $category = $db->select('SELECT * FROM categories WHERE id=?', [$id])->fetch();
    require_once((BASE_PATH) . '/template/admin/category/edit.php');
  }
  function update($request, $id)
  {
    
    $db = new Database;
    $db->update('categories', $id, array_keys($request), array_values($request));
    $this->redirect('admin/category');
  }
  function delete($id){
   $db = new Database;
   $db->delete('categories', $id);
   $this->redirect('admin/category');
  }
}