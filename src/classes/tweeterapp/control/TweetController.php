<?php

namespace iutnc\tweeterapp\control;

use iutnc\mf\control\AbstractController as AbstractController;
use iutnc\tweeterapp\view as View;

use iutnc\tweeterapp\model\Tweet as Tweet;

class TweetController extends AbstractController{
    public function execute() : void {
        View\TweeterView::setAppTitle("Tweet - Mini Tweeter");

        if (isset($this->request->get['id'])){
            $tweetId = (int)$this->request->get['id'];
            $tweet = Tweet::select()->where('id', '=', $tweetId)->first();

            if ($tweet){
                $data['tweet'] = $tweet;
                $vue = new View\TweetView($data);
                $vue->makePage();
            } else {
                $data['error'] = "Unknow Tweet";
                $vue = new View\ErrorView($data);
                $vue->makePage();
            }
        } else {
            $data['error'] = "Unknow Tweet";
            $vue = new View\ErrorView($data);
            $vue->makePage();
        }
    }
      
}