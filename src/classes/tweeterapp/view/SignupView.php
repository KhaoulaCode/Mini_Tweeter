<?php

namespace iutnc\tweeterapp\view;

class SignupView extends TweeterView {
    public function render() : string{
        return <<<EOT
        <form class="forms" action="main.php?action=signup" method=post>
            <input class="forms-text" type=text name=fullname placeholder="full Name">
            <input class="forms-text" type=text name=username placeholder="username">
            <input class="forms-text" type=password name=password placeholder="password">
            <input class="forms-text" type=password name=password_verify placeholder="retype password">

            <button class="forms-button" name=login_button type="submit">Create</button>
        </form>
        EOT;
    }
}