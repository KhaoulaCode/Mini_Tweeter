<?php

/* pour le chargement automatique des classes d'Eloquent (dans le répertoire vendor) */
require_once 'vendor/autoload.php';

use iutnc\tweeterapp as TweeterApp;
use iutnc\tweeterapp\auth\TweeterAuthentification;

/* Connexion à la BDD  */
$db = new Illuminate\Database\Capsule\Manager();
$db->addConnection(parse_ini_file('conf/db_house.ini'));   /* configuration avec nos paramètres */
$db->setAsGlobal();            /* rendre la connexion visible dans tout le projet */
$db->bootEloquent();           /* établir la connexion */


/* Ajout de feuille de style */
TweeterApp\view\TweeterView::TweeterView('html/style.css');
// Bootstrap Icon inclu par AbstractView.php => makePage()

/* Création du router */
$router = new \iutnc\mf\router\Router();

/* Ajout des routes de l'application */
$router->addRoute('home', 'list_tweets',      '\iutnc\tweeterapp\control\HomeController');
$router->addRoute('view', 'view_tweet',       '\iutnc\tweeterapp\control\TweetController');
$router->addRoute('user', 'view_user_tweets', '\iutnc\tweeterapp\control\UserController');
$router->addRoute('signup', 'signup',       '\iutnc\tweeterapp\control\SignupController');
$router->addRoute('login', 'login',           '\iutnc\tweeterapp\control\LoginController');

$router->addRoute('following', 'view_following', '\iutnc\tweeterapp\control\FollowingController', TweeterAuthentification::ACCESS_LEVEL_USER);
$router->addRoute('post', 'post_tweet', '\iutnc\tweeterapp\control\PostController', TweeterAuthentification::ACCESS_LEVEL_USER);
$router->addRoute('logout', 'logout',         '\iutnc\tweeterapp\control\LogoutController', TweeterAuthentification::ACCESS_LEVEL_USER);

/* Route par défaut */
$router->setDefaultRoute('list_tweets');

$router->run();