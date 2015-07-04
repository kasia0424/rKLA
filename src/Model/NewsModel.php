<?php
/**
 * News model.
 *
 * @author Wanda Sipel <katarzyna.sipel@uj.edu.pl>
 * @link http://wierzba.wzks.uj.edu.pl/~12_sipel/KLA/web/
 * @copyright 2015 EPI
 */

namespace Model;

use Silex\Application;

/**
 * Class NewsModel.
 *
 * @category Epi
 * @package Model
 * @use Silex\Application
 */
class NewsModel
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
        $this->db = $app['db'];
    }

    /**
     * Gets all news
     *
     * @access public
     * @return array Result
     */
    public function getAll()
    {
        $query = 'SELECT * FROM kla_posts';
        $result = $this->db->fetchAll($query);
        return !$result ? array() : $result;
    }
    
    /**
     * Gets last news
     *
     * @access public
     * @return array Result
     */
    public function getLast()
    {
        $query = 'SELECT distinct(kla_posts.id), title, content, date, author, name as photo, post_id, description
            FROM kla_posts 
            LEFT JOIN kla_photos ON kla_posts.id = kla_photos.post_id
            ORDER BY id DESC LIMIT 2';
        $result = $this->db->fetchAll($query);
        return !$result ? array() : $result;
    }


    /**
     * Gets news
     *
     * @access public
     * @return array Result
     */
    public function getPost($id)
    {
        $query = 'SELECT kla_posts.id, title, content, date, author, name as photo, post_id, description
            FROM kla_posts 
            LEFT JOIN kla_photos ON kla_posts.id = kla_photos.post_id
            WHERE kla_posts.id = ?';
        $result = $this->db->fetchAssoc($query, array((int) $id));
        return !$result ? array() : $result;
    }
    
}