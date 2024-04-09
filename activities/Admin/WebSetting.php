<?php

namespace Admin;

use database\DataBase;

class WebSetting extends Admin
{
    function index()
    {
        $db = new DataBase();
        $webSetting = $db->select('SELECT * FROM settings')->fetch();
        require_once((BASE_PATH) . '/template/admin/web-setting/index.php');
    }
    function edit()
    {
        $db = new DataBase();
        $webSetting = $db->select('SELECT * FROM settings')->fetch();
        require_once((BASE_PATH) . '/template/admin/web-setting/edit.php');
    }
    function update($request)
    {
        $db = new DataBase;
        $setting = $db->select('SELECT * FROM settings')->fetch();
        if($request['logo']['tmp_name'] != '')
        {
                $request['logo'] = $this->saveImage($request['logo'], 'setting', 'logo');
        }
        else{
                unset($request['logo']);
        }
        if($request['icon']['tmp_name'] != '')
        {
                $request['icon'] = $this->saveImage($request['icon'], 'setting', 'icon');
        }
        else{
                unset($request['icon']);
        }
        if(!empty($setting))
        {
                $db->update('settings', $setting['id'], array_keys($request), array_values($request));
        }
        else{
                $db->insert('settings', array_keys($request), array_values($request));
        }
        //dd($setting['id']);
        $this->redirect('admin/web-setting');

    }
}
