<?php
/**
 * News controller.
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

use Model\NewsModel;
use Model\PhotosModel;


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
        $newsController->get('/post/{id}', array($this, 'viewAction'))
            ->bind('/home/post');
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
        //gets pohots to aside
        $photosModel = new PhotosModel($app);
        $this->view['lasts'] = $photosModel->getLast();

        $newsModel = new NewsModel($app);
        $this->view['posts'] = $newsModel->getLast();
        // var_dump($this->view['posts']);

        return $app['twig']->render('home.twig', $this->view);
    }
    
    
    /**
     * View action.
     *
     * @access public
     * @param  Silex\Application $app Silex application
     * @param  Symfony\Component\HttpFoundation\Request $request Request object
     *
     * @return string Output
     */
    public function viewAction(Application $app, Request $request)
    {
        $id = (int)$request->get('id', null);

        $newsModel = new NewsModel($app);
        $this->view['posts'] = $newsModel->getPost($id);

        $photosModel = new PhotosModel($app);
        $this->view['photos'] = $photosModel->getPhotos($id);

        return $app['twig']->render('post.twig', $this->view);

        // try {
            // $adsModel = new AdsModel($app);
            // $ad = $adsModel->getAd($id);
            // $number = $usersModel-> getPhone($ad['user_id']);

            // if (!$ad) {
                // $app['session']->getFlashBag()->add(
                    // 'message',
                    // array(
                        // 'type' => 'danger',
                        // 'content' => 'Ad not found'
                    // )
                // );
                // return $app['twig']->render(
                    // 'errors/404.twig'
                // );
            // }

            // $photosModel = new PhotosModel($app);
            // $photoTab= $photosModel->getPhoto($ad['id']);
            // $photo = $photoTab['name'];

        // } catch (\Exception $e) {
            // $errors[] = 'Something went wrong';

            // return $app['twig']->render(
                // 'errors/404.twig'
            // );
        // }

        // return $app['twig']->render(
            // 'ads/view.twig',
            // array(
                // 'ad' => $ad,
                // 'photo' => $photo,
                // 'loggedUser' => $idLoggedUser,
                // 'number' => $number['phone_number'],
            // )
        // );
    }
    
    
    
    
}