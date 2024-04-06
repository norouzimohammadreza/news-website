<?php

namespace Admin;

class Admin
{

    protected function redirect($url)
    {
        header('Location:' . trim(CURRENT_DOMAIN, '/') . '/' . trim($url, '/'));
        exit;
    }
    protected function redirectBack()
    {
        header('Location:' . $_SERVER['HTTP_REFERER']);
        exit;
    }
    protected function saveImage($image, $imagePath, $imageName = null)
    {
        if ($imageName) {
            $format = explode('/', $image['type'])[1];
            $imageName = $imageName . '.' . $format;
        } else {
            $format = explode('/', $image['type'])[1];
            $imageName = date('Y-m-d-H-i-s') . '.' . $format;
        }
        $imageTmp = $image['tmp_name'];
        $imagePath = 'public/' . $imagePath . '/';
        if (is_uploaded_file($imageTmp)) {
            if (move_uploaded_file($imageTmp, $imagePath . $imageName)) {
                return $imagePath . $imageName;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    protected function removeImage($path)
    {
       
        if (file_exists($path)) {
            unlink($path);
        } else {
            dd($path);
        }
    }
}
