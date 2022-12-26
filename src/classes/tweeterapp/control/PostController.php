<?php

namespace iutnc\tweeterapp\control;

use iutnc\mf\control\AbstractController;
use iutnc\tweeterapp\view as View;

use iutnc\tweeterapp\model\Tweet;
use iutnc\mf\router\Router;

class PostController extends AbstractController{
    public function execute() : void {
        View\TweeterView::setAppTitle("Post - Mini Tweeter");

        if($this->request->method === 'POST'){
            $post = $this->request->post;
            if (isset($post['text'])) {
                $tweet = new Tweet();
                $tweet->text = $post['text'];
                $tweet->author = 10; // A changé plus tard
                $tweet->score = 0;
                $tweet->save();
                
                Router::executeRoute('home');
            } else {
                echo 'false';
                $vue = new View\PostView();
                $vue->makePage();
            }
        } elseif ($this->request->method === 'GET') {
            $vue = new View\PostView();
            $vue->makePage();
        }
    }  
}