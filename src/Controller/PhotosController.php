<?php
/**
 * Photos controller.
 *
 * @link http://wierzba.wzks.uj.edu.pl/~12_sipel/KLA/web/
 * @author Wanda Sipel
 * @copyright EPI 2015
 */

namespace Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

use Model\PhotosModel;
// use Model\AdsModel;
// use Model\UsersModel;
use Form\FilesForm;

class PhotosController implements ControllerProviderInterface
{
    /**
     * Routing settings.
     *
     * @access public
     * @param Application $app Silex application
     * @return PhotosController Result
     */
    public function connect(Application $app)
    {
        $photosController = $app['controllers_factory'];
        $photosController->match('/', array($this, 'indexAction'))
            ->bind('/galeria/');
        // $photosController->match('/upload', array($this, 'upload'))
            // ->bind('/galeria/upload');
        // $photosController->match('/delete/{id}', array($this, 'delete'))
            // ->bind('/galeria/delete');
        return $photosController;
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
        $photosModel = new PhotosModel($app);
        $this->view['photos'] = $photosModel->getAll();
        // var_dump($this->view['photos']);
        
        return $app['twig']->render('gallery.twig', $this->view);
    }
    
    
    /**
     * Upload action.
     *
     * @access public
     * @param Application $app Silex application
     * @param Request $request Request object
     * @return string Output
     */
    public function upload(Application $app, Request $request)
    {
        $adId =(int)$request->get('id', 0);

        $adsModel = new AdsModel($app);
        $ad = $adsModel->getAd($adId);

        $usersModel = new UsersModel($app);
        $idLoggedUser = $usersModel->getIdCurrentUser($app);

        $flag = false;

        if ($flag == false) {
        // if (!$app['security']->isGranted('ROLE_ADMIN')) {
            // if ((int)$ad['user_id'] !== (int)$idLoggedUser) {
                // $app['session']->getFlashBag()->add(
                    // 'message',
                    // array(
                        // 'type' => 'danger',
                        // 'content' => 'This is not your ad - you can not adddd photo to it.'
                    // )
                // );
                // return $app['twig']->render(
                    // 'errors/403.twig'
                // );
            // }
        // }
        }

        $form = $app['form.factory']
            ->createBuilder(new FilesForm(), array('ad_id'=>$adId))->getForm();

        if ($request->isMethod('post')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                try {
                    $data = $form->getData();
                    $files = $request->files->get($form->getName());
                    $path = dirname(dirname(dirname(__FILE__))).'/web/media';

                    $photosModel = new PhotosModel($app);

                    $originalFilename = $files['image']->getClientOriginalName();

                    $newFilename = $photosModel->createName($originalFilename);
                    $files['image']->move($path, $newFilename);

                    $adId = $data['ad_id'];
                    $photo = $photosModel->getPhoto($adId);
                    
                    if ($photo == null) {
                        $photosModel->saveFile($newFilename, $adId);
                    } else {
                        $photosModel->updateFile($newFilename, $data);
                    }

                    $app['session']->getFlashBag()->add(
                        'message',
                        array(
                            'type' => 'success',
                            'content' => 'File successfully uploaded.'
                        )
                    );
                    return $app->redirect(
                        $app['url_generator']->generate(
                            '/ads/view',
                            array('id' => $data['ad_id'])
                        ),
                        301
                    );
                    $flag= true;

                } catch (Exception $e) {
                     $app['session']->getFlashBag()->add(
                         'message',
                         array(
                             'type' => 'error',
                             'content' => 'Can not upload file.'
                         )
                     );
                }

            } else {
                var_dump($form);
                $app['session']->getFlashBag()->add(
                    'message',
                    array(
                        'type' => 'error',
                        'content' => 'Form contains invalid data.'
                    )
                );
            }
        }

        return $app['twig']->render(
            'photos/upload.twig',
            array(
                'form' => $form->createView(),
                'id' => $adId
            )
        );
    }
    
    
    /**
     * Delete action.
     *
     * @access public
     * @param  Silex\Application $app Silex application
     * @param  Symfony\Component\HttpFoundation\Request $request Request object
     * @return string Output
     */
    public function delete(Application $app, Request $request)
    {
        try {
            $usersModel = new UsersModel($app);
            $idLoggedUser = $usersModel->getIdCurrentUser($app);

            $id = (int) $request -> get('id', 0);
            $user = (int) $request -> get('user', 0);

            if (!$app['security']->isGranted('ROLE_ADMIN')) {
                if ((int)$user !== (int)$idLoggedUser) {
                    $app['session']->getFlashBag()->add(
                        'message',
                        array(
                            'type' => 'danger',
                            'content' => 'This is not your ad - you can not delete it\'s photo.'
                        )
                    );
                    return $app['twig']->render(
                        'errors/403.twig'
                    );
                }
            }
        } catch (\Exception $e) {
            $errors[] = 'Something went wrong in getting user';

            $app['session']->getFlashBag()->add(
                'message',
                array(
                    'type' => 'danger',
                    'content' => 'Something went wrong in getting user'
                )
            );
            return $app['twig']->render(
                'errors/404.twig'
            );
        }


        try {
            $data = array();
            $form = $app['form.factory']
                ->createBuilder(new DeleteForm(), $ad)->getForm();
            $form->handleRequest($request);
        } catch (\Exception $e) {
            $errors[] = 'Something went wrong in creating form';

            $app['session']->getFlashBag()->add(
                'message',
                array(
                    'type' => 'danger',
                    'content' => 'Something went wrong in creating form'
                )
            );
            return $app['twig']->render(
                'errors/404.twig'
            );
        }
        
        if ($form->isValid()) {
            if ($form->get('No')->isClicked()) {
                return $app->redirect(
                    $app['url_generator']->generate(
                        '/'
                    ),
                    301
                );
            } else {
                try {
                    $photosModel = new PhotosModel($app);
                    $photo = $photosModel -> getPhoto($id);
                    $adId = $photo['ad_id'];
                    $photosModel -> deletePhoto($id);
                    $app['session']->getFlashBag()->add(
                        'message',
                        array(
                            'type' => 'success',
                            'content' => 'Photo has been deleted.'
                        )
                    );
                    return $app->redirect(
                        $app['url_generator']->generate(
                            '/ad/view',
                            array(
                                'id' => $adId
                            )
                        ),
                        301
                    );
                } catch (\Exception $e) {
                    $app['session']->getFlashBag()->add(
                        'message',
                        array(
                            'type' => 'danger',
                            'content' => 'Photo not found'
                        )
                    );
                    return $app['twig']->render('404.twig');
                }
            }
        }
        return $app['twig']->render(
            '/ads/delete.twig',
            array(
                'form' => $form->createView(),
                $data
            )
        );

    }
}
