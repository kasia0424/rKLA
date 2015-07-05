<?php
require_once __DIR__.'/../vendor/autoload.php';
$app = new Silex\Application();
$app['debug'] = true;


$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
        'locale_fallbacks' => array('en'),
));
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../src/views',
));


$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver'    => 'pdo_mysql',
        'host'      => 'localhost',
        'dbname'    => '12_sipel',
        'user'      => '12_sipel',
        'password'  => 'N1i4m0q9a3',
        'charset'   => 'utf8',
    ),
));

$app->get(
    '/', function() use ($app) {
        return $app->redirect(
            $app["url_generator"]->generate(
                "/home/"
            )
        );
    }
)->bind('/');


//firewall
$app->register(
   new Silex\Provider\SecurityServiceProvider(), array(
       'security.firewalls' => array(
           'unsecured' => array(
               'anonymous' => true,
           ),
       ),
   )
);


//obs³uga b³êdów
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\FatalErrorException;

// $app->error(
    // function (\Exception $e, $code) use ($app) {
        // if ($code == 404) {
            // return new Response(
                // $app['twig']->render('errors/404.twig'), 404
            // );
        // }
    // }
// );

// $app->error(
    // function (\Exception $e, $code) use ($app) {
        // if ($code == 403) {
            // return new Response(
                // $app['twig']->render('errors/403.twig'), 403
            // );
        // }
    // }
// );
// $app->error(
    // function (\Exception $e, $code) use ($app) {
        // if ($code == 500) {
            // return new Response(
                // $app['twig']->render('errors/500.twig'), 500
            // );
        // }
    // } 
// );
$app->error(
    function (
        \Exception $e, $code
    ) use ($app) {

        if ($e instanceof Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            $code = (string)$e->getStatusCode();
        }
        // if ($e instanceof Symfony\Component\Security\Core\Exception\AuthenticationCredentialsNotFoundException) {
            // $code = (string)$e->getStatusCode();
            // return $app['twig']->render(
                // 'errors/404.twig'
            // );
        // }
        
        // if ($e instanceof Symfony\Component\HttpKernel\Exception\FatalErrorException) {
            // return $app['twig']->render(
                // 'errors/default.twig'
            // );
        // }

        if ($app['debug']) {
            return;
        }

        // 404.html, or 40x.html, or 4xx.html, or error.html
        $templates = array(
            'errors/'.$code.'.twig',
            'errors/'.substr($code, 0, 2).'x.twig',
            'errors/'.substr($code, 0, 1).'xx.twig',
            'errors/default.twig',
        );

        return new Response(
            $app['twig']->resolveTemplate($templates)->render(
                array('code' => $code)
            ),
            $code
        );

    }
);


$app->mount('/home/', new Controller\NewsController());
$app->get('/warto', function ()  use($app) {
    return $app['twig']->render('worth.twig');
})->bind('/warto/');
$app->get('/dolacz', function ()  use($app) {
    return $app['twig']->render('join.twig');
})->bind('/dolacz/');
$app->get('/dzialalnosc', function ()  use($app) {
    return $app['twig']->render('activity.twig');
})->bind('/dzialalnosc/');
$app->mount('/wydarzenia/', new Controller\EventsController());
$app->get('/zalozyciele', function ()  use($app) {
    return $app['twig']->render('creators.twig');
})->bind('/zalozyciele/');
$app->get('/historia', function ()  use($app) {
    return $app['twig']->render('history.twig');
})->bind('/historia/');
$app->get('/quiz/', function ()  use($app) {
    return $app['twig']->render('quiz.twig');
})->bind('/quiz/');
$app->get('/o-serwisie/', function ()  use($app) {
    return $app['twig']->render('o_serwisie.twig');
})->bind('/o-serwisie/');

//$app->mount('/galeria/', new Controller\PhotosController());



$app->run();
