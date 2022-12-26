<?php

namespace iutnc\tweeterapp\view;

class UserView extends TweeterView {
    public function render() : string{
        
        $author = $this->data['author'];
        $nbrFollower = $author->followedBy()->count();
        $listTweet = $author->tweets()->orderBy('created_at', 'desc')->take(5)->get();
        
        $html = <<<EOT
        <h2>Tweets from {$author->username}</h2>
        <h3>{$nbrFollower} follower</h3>
        EOT;

        foreach ($listTweet as $t){
            $urlTweet = $this->router->urlFor('view', [['id', $t->id]]);
            $date = new \DateTime($t->created_at);
            
            $html .= <<<EOT
            <div class="tweet">
                <a class="tweet-text" href="{$urlTweet}">{$t->text}</a>
                <div class="tweet-footer">
                    <span class="tweet-timestamp">{$date->format('H:i:s | d-m-Y')}</span>
                    <span class="tweet-author">{$author->fullname}</span>
                </div>
            </div>
            EOT;
        }

        return $html;
    }
}