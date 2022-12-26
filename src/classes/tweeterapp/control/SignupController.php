<?php

namespace iutnc\tweeterapp\control;

use iutnc\mf\control\AbstractController;
use iutnc\tweeterapp\view as View;

use iutnc\mf\router\Router;

use iutnc\tweeterapp\auth\TweeterAuthentification;

class SignupController extends AbstractController{
    public function execute() : void {
        View\TweeterView::setAppTitle("Inscription - Mini Tweeter");

        $router = new Router();

        if ($this->request->method === 'POST') {
            $fullname = filter_input(INPUT_POST, "fullname");
            $username = filter_input(INPUT_POST, "username");
            $username = strtolower($username);
            $password = filter_input(INPUT_POST, "password");
            $password_verify = filter_input(INPUT_POST, "password_verify");

            if ($password !== $password_verify) {
                $vue = new View\ErrorView(['error' => "Les mots de passe ne correspondent pas."]);
                $vue->makePage();
                return;
            } else {
                TweeterAuthentification::register($username, $password, $fullname);
                header("Location: ".$router->urlFor("login"));
            }
        } else {
            $vue = new View\SignupView();
            $vue->makePage();
        }
    }  
}