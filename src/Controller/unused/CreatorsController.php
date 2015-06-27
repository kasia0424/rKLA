<?php
/**
 * Creators controller.
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


class CreatorsController implements ControllerProviderInterface
{
    /**
     * Routing settings.
     *
     * @access public
     * @param Silex\Application $app Silex application
     */
    public function connect(Application $app)
    {
        $creatorsController = $app['controllers_factory'];
        $creatorsController->get('/zalozyciele', array($this, 'indexAction'))
            ->bind('/zalozyciele/');
        // $creatorsController->match('/add', array($this, 'addAction'))
            // ->bind('/categories/add');
        // $creatorsController->match('/edit/{id}', array($this, 'editAction'))
            // ->bind('/categories/edit');
        // $creatorsController->match('/delete/{id}', array($this, 'deleteAction'))
            // ->bind('/categories/delete');
        // $creatorsController->get('/view/{id}', array($this, 'viewAction'))
            // ->bind('/categories/view');
        return $creatorsController;
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
        return $app['twig']->render('creators.twig');
    }
    
    
    
    
    
    
}