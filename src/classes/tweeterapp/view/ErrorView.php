<?php

namespace iutnc\tweeterapp\view;

class ErrorView extends TweeterView {
    public function render() : string{
        $message = $this->data['error'];
        return <<<EOT
            <h3>$message</h3>
        EOT;
    }
}