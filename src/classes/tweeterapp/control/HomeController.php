<?php

namespace iutnc\tweeterapp\control;

use iutnc\mf\control\AbstractController;
use iutnc\tweeterapp\view as View;

use \iutnc\tweeterapp\model\Tweet;

class HomeController extends AbstractController{
    public function execute() : void {
        View\TweeterView::setAppTitle("Accueil - Mini Tweeter");
        
        $list = Tweet::select()->orderBy('created_at', 'desc')->take(5)->get();
        if ($list){
            $data['list-tweet'] = $list;
            $vue = new View\HomeView($data);
            $vue->makePage();
        } else {
            $data['error'] = "No tweets found";
            $vue = new View\ErrorView($data);
            $vue->makePage();
        }
    }
      
}