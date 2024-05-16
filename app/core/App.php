<?php

class App
{
    protected $controller = "home";
    protected $method = "index";
    protected $params = [];

    public function __construct()
    {
        // this will check the first key of the url array then load it's controller page if it exists 
        // else it'll load home controller as default
        $url = $this->parseUrl();
        // print_r($url);
        
        if (file_exists('../app/controllers/'.$url[0].'.php')) {
            
            $this->controller = $url[0];
            unset($url[0]);
            
        }
        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        #wanna check if the method exists
        // If the method exists it'll then load the method in that controller
        if (method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }


        // checking params
        $this->params = $url ? array_values($url) : [];
        // call controller, method and params now
        call_user_func_array([$this->controller, $this->method], $this->params);
    }
    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            // echo $_GET['url'];
            return $url = explode("/", filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}
