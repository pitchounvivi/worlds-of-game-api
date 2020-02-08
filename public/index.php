<?php

/////////pour utilisation class
use Wog\Http\Request;
use Wog\Http\Response;

$uri1 = "users/0"; //false
$uri2 = "users/33333"; //true
$uri3 = "users/33333333333333333"; //false

//var_dump(
//    preg_match(
//        "/^users\/[1-9]{1}[0-9]{0,4}$/",
//        $uri1
//    )
//);
//
//
//exit();


require "./../vendor/autoload.php";

/////////////////////////////////////////////////////////////////////////////////////

$json = file_get_contents("../config/routes.json");
$routes = json_decode($json);
//var_dump($routes);


try {
    $request = new Request();
    $response = new Response();

//utiliser les routes pour rétablir nos fonctionnalités

//si la méthode de la requete est option
// on veux 200 ok
    if ("options" === $request->getMethod()) {
        $response->setStatus(200, "OPTIONS OK");

    } else {

//sinon
//tant que j'ai des routes
        foreach ($routes as $routePrincipale) {

            //on vérifie que l'uri ressemble au pattern qui correspond à
            ///users/00000   ->on test la route /users/chiffre
            if (!preg_match(
                "#^$routePrincipale->path$#",
                $request->getUri(),
                $match
            )) {
                // le paramètre match permet de vérifier que le chemin correspond exactement à ce qu'on a dans routes.json
                // !!!!! ATTENTION !!!!! pour utiliser le paramètre $match,
                // la partie qui doit être comparée dans le routes.json doit être entre () , Très important !!!!!!!
                continue;
            }

//            var_dump($match); //
//            exit();
            // grâce au paramètre match
            // on arrive à récupérer le chemin mais sous forme de tableau
            // en indice 0, le chemin en entier : /users/45
            // en indice 1, la partie chiffre uniquement : 45

            //avec array_schift, on récupère que le chiffre après users/
            array_shift($match);



            //on boucle dans le routes.json
            foreach ($routes as $routeSecondaire) {
                //on return le controleur qui correspond
                if ($routePrincipale->path === $routeSecondaire->path
                    && $request->getMethod() === $routeSecondaire->method) {
                    $response = (new $routeSecondaire->controller($request, $response))
                        ->{$routeSecondaire->action}(...$match);
                    throw new OutOfRangeException();
                }
            }
            $response->setStatus(405, "Method not allowed ");
            $response->setError("The method " . $request->getMethod() . " is not allowed for the " . $request->getUri());
            throw new OutOfRangeException();
        }
    }
    $response->setStatus(404, "Not found");
    $response->setError("The URI " . $request->getUri() . " is not Found");

} catch (OutOfRangeException $e) {

} catch (\Throwable $e) {
    $response->setStatus(500, "Internal Server Error");
    $response->setError(utf8_encode($e->getMessage()) . "(" . $e->getFile() . ")" . " line [ " . $e->getLine() . " ].");
}
$response->send();



