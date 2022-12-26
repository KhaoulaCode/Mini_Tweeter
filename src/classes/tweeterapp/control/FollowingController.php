<?php

namespace iutnc\tweeterapp\control;

use iutnc\mf\control\AbstractController;
use iutnc\tweeterapp\view as View;

use iutnc\mf\router\Router;

class FollowingController extends AbstractController{
    public function execute() : void {
        View\TweeterView::setAppTitle("Personnes suivis - Mini Tweeter");

    }  
}