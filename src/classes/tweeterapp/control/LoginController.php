<?php

namespace iutnc\tweeterapp\control;

use iutnc\mf\control\AbstractController;
use iutnc\tweeterapp\view as View;

use iutnc\mf\router\Router;

use iutnc\tweeterapp\auth\TweeterAuthentification;

class LoginController extends AbstractController{
    public function execute() : void {
        View\TweeterView::setAppTitle("Connexion - Mini Tweeter");

        $router = new Router();

        if ($this->request->method === 'POST') {
            $username = filter_input(INPUT_POST, "username");
            $username = strtolower($username);
            $password = filter_input(INPUT_POST, "password");

            TweeterAuthentification::login($username, $password);
            header("Location: ".$router->urlFor("home"));
        } else {
            $vue = new View\LoginView();
            $vue->makePage();
        }

        
    }  
}