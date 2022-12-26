<?php

namespace iutnc\tweeterapp\view;

class LoginView extends TweeterView {
    public function render() : string{
        return <<<EOT
        <form class="forms" action="main.php?action=login" method=post>
            <input class="forms-text" type=text name=username placeholder="username">
            <input class="forms-text" type=password name=password placeholder="password">
            <button class="forms-button" name=login_button type="submit">Login</button>
        </form>
        EOT;
    }
}