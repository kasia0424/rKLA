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
        $eventsController->get('/', array($this, 'indexAction'));
        $eventsController->get('/{id}', array($this, 'indexAction'))
            ->value('id', null)->bind('/wydarzenia/');
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
        $id = (int)$request->get('id', null);

        if($id == null){
            $eventsModel = new EventsModel($app);
            $this->view['events'] = $eventsModel->getAll();
            // var_dump($this->view['events']);
            return $app['twig']->render('events.twig', $this->view);
        } else{
            $eventsModel = new EventsModel($app);
            $this->view['event'] = $eventsModel->getEvent($id);

            return $app['twig']->render('event.twig', $this->view);
        }
    }
}
