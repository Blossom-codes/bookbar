<?php

class Library extends Controller
{
    public function display($name = "", $otherName = "")
    {
        // $user = $this->model('User');
        // $user->name = $name;
        $this->nav("navbar");
        $this->view("library/library_list");
    }
    
}
