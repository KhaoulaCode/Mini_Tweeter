<?php

namespace iutnc\tweeterapp\view;

use \iutnc\mf\view\AbstractView;
use iutnc\mf\view\Renderer;

use iutnc\tweeterapp\auth\TweeterAuthentification;

abstract class TweeterView extends AbstractView implements Renderer{

    /* Méthode makeBody 
     * 
     * Retourne le contenu HTML de la balise body autrement dit le
     * contenu du document. 
     *
     * 
     * Note : cette méthode est à définir dans les classes concrètes
     * des vues, elle est appelée depuis la méthode render ci-dessous.
     * 
     * Retourne : 
     *
     * - Le contenu HTML complet entre les balises <body> </body> 
     *
     */
    protected function makeBody(): string {
        $nav = $this->makeNav();
        $article = $this->render();
        if (TweeterAuthentification::checkAccessRight(TweeterAuthentification::ACCESS_LEVEL_USER)) {
            $menuNewTweet = $this->makeNewTweet();
        } else {
            $menuNewTweet = "";
        }
        return <<<EOT
            <header class="theme-backcolor1">
                <h1>MiniTweeTR</h1>
                ${nav}
            </header>


            <section class="theme-backcolor2">
                <article class="theme-backcolor2">
                    ${article}
                </article>

                ${menuNewTweet}
            </section>


            <footer class="theme-backcolor1">La super app créée en Licence Pro 2022</footer>
        EOT;
    }

    protected function makeNav(): string{
        if (TweeterAuthentification::checkAccessRight(TweeterAuthentification::ACCESS_LEVEL_USER)) {
            return <<<EOT
            <nav id="navbar">
                <a class="tweet-control" href="{$this->router->urlFor('home')}"><i class="bi bi-house"></i></a>
                <a class="tweet-control" href="{$this->router->urlFor('following')}"><i class="bi bi-person-fill"></i></a>
                <a class="tweet-control" href="{$this->router->urlFor('logout')}"><i class="bi bi-box-arrow-right"></i></a>
            </nav>
            EOT;
        } else {
            return <<<EOT
            <nav id="navbar">
                <a class="tweet-control" href="{$this->router->urlFor('home')}"><i class="bi bi-house"></i></a>
                <a class="tweet-control" href="{$this->router->urlFor('login')}"><i class="bi bi-box-arrow-in-right"></i></a>
                <a class="tweet-control" href="{$this->router->urlFor('signup')}"><i class="bi bi-plus-lg"></i></a>
            </nav>
            EOT;
        }
    }

    protected function makeNewTweet(): string{
        $urlNewTweet = $this->router->urlFor('post');
        return <<<EOT
        <nav id="menu" class="theme-backcolor1"> 
            <div id="nav-menu">
                <div class="button theme-backcolor2">
                    <a href="{$urlNewTweet}">New</a>
                </div>
            </div>
        </nav>
        EOT;
    }
}