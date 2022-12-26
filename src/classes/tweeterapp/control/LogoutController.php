<?php

namespace iutnc\tweeterapp\control;

use iutnc\mf\control\AbstractController;
use iutnc\tweeterapp\view as View;

use iutnc\mf\router\Router;

use iutnc\tweeterapp\auth\TweeterAuthentification;

class LogoutController extends AbstractController{
    public function execute() : void {
        View\TweeterView::setAppTitle("Déconnexion - Mini Tweeter");
        $router = new Router();

        TweeterAuthentification::logout();
        header("Location: ".$router->urlFor("home"));
    }  
}