<?php
/**
 * Join controller.
 *
 * @link http://wierzba.wzks.uj.edu.pl/~12_sipel/KLA/web/
 * @author Wanda Sipel
 * @copyright EPI 2015
 */

namespace Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\Validator\Constraints as Assert;

// use Model\CategoriesModel;


class NewsController implements ControllerProviderInterface
{
    /**
     * Routing settings.
     *
     * @access public
     * @param Silex\Application $app Silex application
     */
    public function connect(Application $app)
    {
        $newsController = $app['controllers_factory'];
        $newsController->get('/', array($this, 'indexAction'))
            ->bind('/home/');
        // $newsController->match('/add', array($this, 'addAction'))
            // ->bind('/categories/add');
        // $newsController->match('/edit/{id}', array($this, 'editAction'))
            // ->bind('/categories/edit');
        // $newsController->match('/delete/{id}', array($this, 'deleteAction'))
            // ->bind('/categories/delete');
        // $newsController->get('/view/{id}', array($this, 'viewAction'))
            // ->bind('/categories/view');
        return $newsController;
    }
   

    /**
     * Index action.
     *
     * @access public
     * @param Silex\Application $app Silex application
     * @param Symfony\Component\HttpFoundation\Request $request Request object
     * @return string Output
     */
    public function indexAction(Application $app, Request $request)
    {
        return $app['twig']->render('home.twig');
    }
    
    
    
    
    
    
}