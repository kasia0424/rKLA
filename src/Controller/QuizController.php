<?php
/**
 * Quiz controller.
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


class QuizController implements ControllerProviderInterface
{
    /**
     * Routing settings.
     *
     * @access public
     * @param Silex\Application $app Silex application
     */
    public function connect(Application $app)
    {
        $quizController = $app['controllers_factory'];
        $quizController->get('/', array($this, 'indexAction'))
            ->bind('/quiz/');
        // $quizController->match('/add', array($this, 'addAction'))
            // ->bind('/categories/add');
        // $quizController->match('/edit/{id}', array($this, 'editAction'))
            // ->bind('/categories/edit');
        // $quizController->match('/delete/{id}', array($this, 'deleteAction'))
            // ->bind('/categories/delete');
        // $quizController->get('/view/{id}', array($this, 'viewAction'))
            // ->bind('/categories/view');
        return $quizController;
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
        return $app['twig']->render('quiz.twig');
    }
    
    
    
    
    
    
}