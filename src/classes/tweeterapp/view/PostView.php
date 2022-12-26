<?php

namespace iutnc\tweeterapp\view;

class PostView extends TweeterView {
    public function render() : string{
        $value = "";
        if (!empty($this->data)){
            $value = htmlspecialchars($value);
        }
        return <<<EOT
            <form action="" method="post">
                <textarea id="tweet-form" name="text" placeholder="Enter your tweet..." ,="" maxlength="140" spellcheck="false" value="{$value}"></textarea>
                <div><input id="send_button" type="submit" name="send" value="Send"></div>
            </form>  
        EOT;
    }
}