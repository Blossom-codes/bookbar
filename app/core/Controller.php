<?php

class Controller
{
    public function model($model)
    {
        // add file check
        if (file_exists("../app/models/$model.php")) {
            require_once "../app/models/$model.php";
            return new $model();
        } else {
            #model or file does not exists
            return false;
        }
    }
    public function view($view, $data = [])
    {
        if (file_exists("../app/views/$view.php")) {
            require_once "../app/views/$view.php";
        } else {
            return false;
        }
    }
    public function save_pop_up_error($title, $error_msg, $icon, $button)
    {
        return  $_SESSION['error'] = [
            "title" => $title,
            "msg" => $error_msg,
            "icon" => $icon,
            "button" => $button,
        ];
    }
    public function save_pop_up_success($title, $success_msg, $icon, $button)
    {
        return  $_SESSION['success'] = [
            "title" => $title,
            "msg" => $success_msg,
            "icon" => $icon,
            "button" => $button,
        ];
    }
}
