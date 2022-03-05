<?php

namespace Source\Controllers;

class Web extends Controller
{
    public function __construct($router)
    {
        parent::__construct($router);

        if(!empty($_SESSION["user"])){
            $this->router->redirect("app.home");
        }
    }

    public function home(): void
    {
        echo $this->view->render("home", [
            "title" => SITENAME . " - Sistema de cotações online",
            "router"=> $this->router
        ]);
    }

    public function login(): void
    {
        echo $this->view->render("login", [
            "title" => "Login | " . SITENAME,
            "router"=> $this->router
        ]);
    }

    public function register(): void
    {
        echo $this->view->render("register", [
            "title" => "Registrar-se | " . SITENAME,
            "router"=> $this->router
        ]);
    }

    public function error(array $data): void
    {
        echo "error {$data["errcode"]}";
    }
}