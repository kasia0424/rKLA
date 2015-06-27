<?php
/**
 * Worth controller.
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


class WorthController implements ControllerProviderInterface
{
    /**
     * Routing settings.
     *
     * @access public
     * @param Silex\Application $app Silex application
     */
    public function connect(Application $app)
    {
        $worthController = $app['controllers_factory'];
        $worthController->get('/warto', array($this, 'indexAction'))
            ->bind('/warto/');
        // $worthController->match('/add', array($this, 'addAction'))
            // ->bind('/categories/add');
        // $worthController->match('/edit/{id}', array($this, 'editAction'))
            // ->bind('/categories/edit');
        // $worthController->match('/delete/{id}', array($this, 'deleteAction'))
            // ->bind('/categories/delete');
        // $worthController->get('/view/{id}', array($this, 'viewAction'))
            // ->bind('/categories/view');
        return $worthController;
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
        return $app['twig']->render('worth.twig');
    }
    
    
    
    
    
    
}