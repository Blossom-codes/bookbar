<?php

class Home extends Controller
{
    public function index($name = "", $otherName = "")
    {
        $user = $this->model('User');
        $user->name = $name;

        $this->view("home/index", ["name" => $user->name]);
    }
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
                    $this->view("home/index", ["errmsg" => "User Exists"]);
                } else {

                    $user->setReader("$email", password_hash($password, PASSWORD_DEFAULT));
                    $this->save_pop_up_success("Success", "Registration was successful", "success", "Welcome");
                    $this->view("home/index", ["name" => $email, "msg" => "Sign up was successful"]);
                }
            } else {
                $this->view("home/index", ["errmsg" => "Registration Error"]);
            }
        }
    }
}
