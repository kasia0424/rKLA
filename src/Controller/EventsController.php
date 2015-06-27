<?php
/**
 * Events controller.
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

use Model\EventsModel;


class EventsController implements ControllerProviderInterface
{
    /**
     * Routing settings.
     *
     * @access public
     * @param Silex\Application $app Silex application
     */
    public function connect(Application $app)
    {
        $eventsController = $app['controllers_factory'];
        $eventsController->get('/', array($this, 'indexAction'))
            ->bind('/wydarzenia/');
        // $eventsController->match('/add', array($this, 'addAction'))
            // ->bind('/categories/add');
        // $eventsController->match('/edit/{id}', array($this, 'editAction'))
            // ->bind('/categories/edit');
        // $eventsController->match('/delete/{id}', array($this, 'deleteAction'))
            // ->bind('/categories/delete');
        // $eventsController->get('/view/{id}', array($this, 'viewAction'))
            // ->bind('/categories/view');
        return $eventsController;
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
        $eventsModel = new EventsModel($app);
        $this->view['events'] = $eventsModel->getAll();
        var_dump($this->view['events']);
        return $app['twig']->render('events.twig', $this->view);
    }

}