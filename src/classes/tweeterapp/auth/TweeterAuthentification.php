<?php
namespace iutnc\tweeterapp\auth;

use iutnc\mf\auth\AbstractAuthentification;
use iutnc\mf\exceptions as E;

use iutnc\tweeterapp\model\User;

class TweeterAuthentification extends AbstractAuthentification {
    const ACCESS_LEVEL_USER = 100;
    const ACCESS_LEVEL_ADMIN = 200;


    public static function register(string $username, string $password, string $fullname, $level=self::ACCESS_LEVEL_USER): void {
        /* La méthode register
        *
        *    Permet la création d'un nouvel utilisateur de l'application
        *
        * Paramètres :
        *
        *    $username : le nom d'utilisateur choisi
        *    $pass : le mot de passe choisi
        *    $fullname : le nom complet
        *    $level : le niveaux d'accès (par défaut ACCESS_LEVEL_USER)
        *
        * Algorithme :
        *
        *    - Si un utilisateur avec le même nom d'utilisateur existe déjà en BD
        *        - soulever une exception
        *    - Sinon
        *        - créer un nouveau modèle ``User`` avec les valeurs en paramètre
        *           ATTENTION : utiliser self::makePassword (cf. ``AbstractAuthentification``)
        *
        */

        $user = User::where('username', '=', $username)->first();
        if ($user){
            throw new E\AuthentificationException('Nom d\'utilisateur déjà utilisé.');
        } else {
            $hash = self::makePassword($password);

            $userRegister = new User();
            $userRegister->fullname = $fullname;
            $userRegister->username = $username;
            $userRegister->password = $hash;
            $userRegister->level = $level;
            $userRegister->followers = 0;
            $userRegister->save();
        }
    }

    public static function login(string $username, string $password): void {
        /* La méthode login
         *
         *     Permet de connecter un utilisateur qui a fourni son nom d'utilisateur
         *     et son mot de passe (depuis un formulaire de connexion)
         *
         * Paramètres :
         *
         *    $username : le nom d'utilisateur
         *    $password : le mot de passe tapé sur le formulaire
         *
         * Algorithme :
         *
         *    - Récupérer l'utilisateur avec l'identifiant $username depuis la BD
         *    - Si aucun de trouvé
         *         - soulever une exception
         *    - Sinon
         *         - réaliser l'authentification et le chargement du profil
         *            ATTENTION : utiliser self::checkPassword (cf. ``AbstractAuthentification``)
         *
         */
        
        $user = User::where('username', '=', $username);
        if ($user){
            self::checkPassword($password, $user->password, $user->id, $user->level);
        } else {
            throw new E\AuthentificationException('Utilisateur introuvable');
        }

    }
}