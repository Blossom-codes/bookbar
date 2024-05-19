<?php

class Home extends Controller
{
    public function index($name = "", $otherName = "")
    {
        $user = $this->model('User');
        $user->name = $name;

        $this->nav("navbar");
        $this->view("home/index", ["name" => $user->name]);
    }
   
    public function Login()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['login'])) {
            $email = $_POST['login_email'];
            $password = $_POST['login_password'];
            
            if (!empty($email) && !empty($password)) {
                
                $user = $this->model("Signin");
                if ($user->getReader("$email", "$password")) {
                    $this->save_pop_up_success("Success", "Welcome", "success", "Thank you");
                    
                } else {
                    $this->save_pop_up_error("Error", "Couldn't login now", "error", "Try Again");
                }
            }
        }

        $this->nav("navbar");
        $this->view("home/index");
    }
    public function Logout($user_id = "")
    {

        $user = $this->model("Signin");
        if ($user->sign_out($user_id)) {
            $this->save_pop_up_success("Logged Out!", "We hope to see you soon!", "success", "Thank you");
        } else {
            // $this->save_pop_up_error("Error", "Couldn't logout now", "error", "Try Again");
        }
         $this->nav("navbar");
        $this->view("home/index");
    }
}
