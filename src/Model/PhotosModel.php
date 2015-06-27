<?php
/**
 * Photos model.
 *
 * @author Wanda Sipel <katarzyna.sipel@uj.edu.pl>
 * @link http://wierzba.wzks.uj.edu.pl/~12_sipel/serwis/web/photos/
 * @copyright 2015 EPI
 */

namespace Model;

use Doctrine\DBAL\DBALException;
use Silex\Application;

/**
 * Class PhotosModel.
 *
 * @category Epi
 * @package Model
 * @use Silex\Application
 */
class PhotosModel
{
    /**
     * Db object.
     *
     * @access protected
     * @var Silex\Provider\DoctrineServiceProvider $db
     */
    protected $db;


    /**
     * Object constructor.
     *
     * @access public
     * @param Silex\Application $app Silex application
     */
    public function __construct(Application $app)
    {
        $this->_db = $app['db'];
    }

    
    /**
     * Gets all photos
     *
     * @access public
     * @return array Result
     */
    public function getAll()
    {
        $query = 'SELECT id, name, description FROM kla_photos;';
        $result = $this->_db->fetchAll($query);
        return !$result ? array() : $result;
    }
    
    
    /**
     * Gets last photos
     *
     * @access public
     * @return array Result
     */
    public function getLast()
    {
        $query = 'SELECT id, name, description FROM kla_photos ORDER BY id DESC LIMIT 8';
        $result = $this->_db->fetchAll($query);
        return !$result ? array() : $result;
    }
    

    /**
     * Save file.
     *
     * @access public
     * @param array $name File namea
     * @retun mixed Result
     */
    public function saveFile($name, $adId)
    {
        $sql = 'INSERT INTO `kla_photos` (`name`, post_id, description) VALUES (?, ?, ?)';
        $this->_db->executeQuery($sql, array($name, (int)$adId));
    }


    /**
     * Update file.
     *
     * @access public
     * @param array $name File namea
     * @retun mixed Result
     */
    // public function updateFile($name, $data)
    // {
        // $sql = 'UPDATE `kla_photos` SET `name`=? WHERE `post_id` = ?';
        // $this->_db->executeQuery($sql, array($name, $data['post_id']));
    // }


    /**
     * Changes file name
     *
     * @access public
     * @param array $name File name
     * @retun $newName Result
     */
    public function createName($name)
    {
        $newName = '';
        $ext = pathinfo($name, PATHINFO_EXTENSION); //losowy ci¹g z nazwy i rozszerzenia
        $newName = $this->randomString(32) . '.' . $ext;

        while (!$this->isUniqueName($newName)) {
            $newName = $this->randomString(32) . '.' . $ext;
        }

        return $newName;
    }


    /**
     * Creates random string
     *
     * @access protected
     * @param int $length length of string
     * @retun $string Result
     */
    protected function randomString($length) //tworzenie ci¹gu liter i cyfr o zadanej d³
    {
        $string = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));
        for ($i = 0; $i < $length; $i++) {
            $string .= $keys[array_rand($keys)];
        }
        return $string;
    }


    /**
     * Checks if name is unique
     *
     * @access protected
     * @param $name string name
     * @retun boolean Result
     */
    protected function isUniqueName($name) //zwraca true jak ci¹g unikalny
    {
        $sql = 'SELECT COUNT(*) AS files_count FROM so_photos WHERE name = ?';
        $result = $this->_db->fetchAssoc($sql, array($name));
        return !$result['files_count'];
    }


    /**
     * Gets file by id
     *
     * @access public
     * @param integer $id Record Id
     * @return file array Result
     */
    // public function getPhotos($id)
    // {
        // if ($id != '') {
            // $sql = 'SELECT name, post_id, description FROM kla_photos WHERE post_id =?
            // ORDER BY id DESC';
            // $result = $this->_db->fetchAssoc($sql, array((int) $id));
            // return $result;
        // }
    // }

    
    /**
     * Gets photos by post id
     *
     * @access public
     * @param integer $id Record Id
     * @return file array Result
     */
    public function getPhotos($id)
    {
        if ($id != '') {
            $sql = 'SELECT kla_photos.id, name, post_id, description
            FROM kla_photos WHERE post_id =?
            ORDER BY id';
            $result = $this->_db->fetchAll($sql, array((int) $id));
            return $result;
        }
    }
    
    

    /**
     * Counts all ads photos
     *
     * @access public
     * @param integer $id Record Id
     * @return file array Result
     */
    public function getPostPhoto()
    {
        // if ($id != '') {
            // $sql = 'CREATE TEMPORARY TABLE IF NOT EXISTS post_photo
            // SELECT kla_photos.id, name, post_id, description, kla_posts.id as post
            // FROM kla_photos JOIN kla_posts ON kla_posts.id = kla_photos.post_id
            // ORDER BY kla_photos.id DESC';
            // $this->db->executeQuery($sql);
            // $query = 'SELECT * FROM post_photo';
            // $result = $this->db->fetchAll($query);
            // return $result;
        // }
    }



    /**
     * Delete photo
     *
     * @access public
     * @param integer $id Record Id
     * @retun mixed Result
     */
    public function deletePhoto($id)
    {
        $id = $id;
        $sql = 'DELETE FROM kla_photos WHERE id = ?';
        $this->db->executeQuery($sql, array((int) $id));
    }
}
