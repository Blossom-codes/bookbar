<?php

class Library extends Controller
{
    public function display($name = "", $otherName = "")
    {
        // $user = $this->model('User');
        // $user->name = $name;

        $this->view("library/library_list");
    }
    
}
