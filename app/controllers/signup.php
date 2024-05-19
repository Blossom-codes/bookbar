<?php

class Signup extends Controller
{
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {

            $email = $_POST['register_email'];
            $password = $_POST['register_password'];

            if (!empty($email) && !empty($password)) {

                $user = $this->model("Register");
                if ($user->checkReader("$email")) {
                    #user already exists
                    $this->save_pop_up_error("Error", "Reader with that email already exists", "error", "Try Again");
                } else {

                    $user->setReader("$email", password_hash($password, PASSWORD_DEFAULT));
                    $this->save_pop_up_success("Success", "Registration was successful", "success", "Welcome");
                }
            } 
        }
        $this->nav("navbar");
        $this->view("home/index", ["errmsg" => "Registration Error"]);
    }
}
