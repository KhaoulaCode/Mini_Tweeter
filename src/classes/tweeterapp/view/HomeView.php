<?php

namespace iutnc\tweeterapp\view;

class HomeView extends TweeterView {
    public function render() : string{
        $html = "<h2>Latest Tweets</h2>";

        $list_tweet = $this->data['list-tweet'];
        
        foreach ($list_tweet as $t){
            $author = $t->author()->first();
            $date = new \DateTime($t->created_at);
            $dateFormat = $date->format('H:i:s | d-m-Y');

            $text = $t->text;
            $authorUser = $author->username;
            
            $urlTweet = $this->router->urlFor('view', [['id', $t->id]]);
            $urlAuthor = $this->router->urlFor('user', [['id', $author->id]]);


            $html .= <<<EOT
                <div class="tweet">
                    <a class="tweet-text" href="{$urlTweet}">${text}</a>
                    <div class="tweet-footer">
                        <span class="tweet-timestamp">${dateFormat}</span>
                        <span class="tweet-author"> 
                            <a href="{$urlAuthor}">${authorUser}</a>
                        </span>
                    </div>
                </div>
            EOT;
        }

        return $html;
    }
}