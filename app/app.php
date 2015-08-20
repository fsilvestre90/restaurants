<?php

    // DEPENDENCIES
        require_once __DIR__."/../vendor/autoload.php"; // frameworks
        require_once __DIR__."/../src/Restaurant.php";
        require_once __DIR__."/../src/Cuisine.php";
        require_once __DIR__."/../src/Review.php";

    // INITIALIZE COOKIE SESSION

    // INITIALIZE APPLICATION
        $app = new Silex\Application();
        $app['debug'] = true;

        $server = 'mysql:host=localhost;dbname=restaurant';
        $username = 'root';
        $password = 'root';
        $DB = new PDO($server, $username, $password);

        //Twig Path
        $app->register(new Silex\Provider\TwigServiceProvider(), array(
            'twig.path' => __DIR__."/../views"
        ));

    // ROUTES

        // display index webpage
        $app->get('/', function() use ($app) {

            return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
        });

        $app->post("/cuisines", function() use ($app) {
            $new_cuisine = $_POST['cuisine'];
            $cuisine = new Cuisine($new_cuisine);

            $cuisine->save();

            return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
        });


        $app->post("/cuisines/{id}", function() use ($app) {
            $cuisine = Cuisine::find($_POST['id']);

            return $app['twig']->render('cuisines.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
        });


    return $app;

?>
