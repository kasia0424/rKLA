<?php
/**
 * History controller.
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


class HistoryController implements ControllerProviderInterface
{
    /**
     * Routing settings.
     *
     * @access public
     * @param Silex\Application $app Silex application
     */
    public function connect(Application $app)
    {
        $historyController = $app['controllers_factory'];
        $historyController->get('/historia', array($this, 'indexAction'))
            ->bind('/historia/');
        // $historyController->match('/add', array($this, 'addAction'))
            // ->bind('/categories/add');
        // $historyController->match('/edit/{id}', array($this, 'editAction'))
            // ->bind('/categories/edit');
        // $historyController->match('/delete/{id}', array($this, 'deleteAction'))
            // ->bind('/categories/delete');
        // $historyController->get('/view/{id}', array($this, 'viewAction'))
            // ->bind('/categories/view');
        return $historyController;
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
        return $app['twig']->render('history.twig');
    }
    
    
    
    
    
    
}