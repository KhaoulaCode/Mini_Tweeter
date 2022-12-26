<?php

namespace iutnc\tweeterapp\view;

class TweetView extends TweeterView {
    public function render() : string{
        $tweet = $this->data['tweet'];
        
        $author = $tweet->author()->first();
        $date = new \DateTime($tweet->created_at);

        $urlAuthor = $this->router->urlFor('user', [['id', $author->id]]);
        

        return <<<EOT
        <div class="tweet">
            <div>{$tweet->text}</div>
            <div class="tweet-footer">
                <span class="tweet-timestamp">{$date->format('H:i:s | d-m-Y')}</span>
                <span class="tweet-author">
                    <a href="{$urlAuthor}">{$author->username}</a>
                </span>
            </div>
            <div class="tweet-footer">
                <hr>
                <span class="tweet-score tweet-control">{$tweet->score}</span>
            </div>
        </div>
        EOT;
    }
}