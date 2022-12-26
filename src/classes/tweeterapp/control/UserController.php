<?php

namespace iutnc\tweeterapp\control;

use iutnc\mf\control\AbstractController as AbstractController;
use iutnc\tweeterapp\view as View;

use iutnc\tweeterapp\model\User as User;

class UserController extends AbstractController{
    public function execute() : void {
        View\TweeterView::setAppTitle("Profil - Mini Tweeter");
        
        if (isset($this->request->get['id'])){
            $authorId = (int)$this->request->get['id'];
            $author = User::select()->where('id', '=', $authorId)->first();
            if ($author){
                $data['author'] = $author;
                $vue = new View\UserView($data);
                $vue->makePage();
            } else {
                $data['error'] = "Unknow User";
                $vue = new View\ErrorView($data);
                $vue->makePage();
            }
        } else {
            $data['error'] = "Unknow User";
            $vue = new View\ErrorView($data);
            $vue->makePage();
        }
    }  
}