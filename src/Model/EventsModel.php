<?php
/**
 * Events model.
 *
 * @author Wanda Sipel <katarzyna.sipel@uj.edu.pl>
 * @link http://wierzba.wzks.uj.edu.pl/~12_sipel/KLA/web/
 * @copyright 2015 EPI
 */

namespace Model;

use Silex\Application;

/**
 * Class EventsModel.
 *
 * @category Epi
 * @package Model
 * @use Silex\Application
 */
class EventsModel
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
     * Gets all events
     *
     * @access public
     * @return array Result
     */
    public function getAll()
    {
        $query = 'SELECT kla_events.id, kla_events.name, kla_events.date, kla_events.price, kla_events.info,
            kla_places.name as place, kla_places.name as meeting,
            kla_types.name as type
            FROM kla_events
            LEFT JOIN kla_places ON kla_places.id = kla_events.place OR kla_places.id = kla_events.meeting
            JOIN kla_types ON kla_types.id = kla_events.type_id
            ORDER BY kla_events.id;';
        $result = $this->db->fetchAll($query);
        return !$result ? array() : $result;
    }


    /**
     * Gets event
     *
     * @access public
     * @return array Result
     */
    public function getEvent($id)
    {
        $query = 'SELECT kla_events.id, kla_events.name, info, date, kla_types.name as type, kla_places.name as place
            FROM kla_events 
            LEFT JOIN kla_types ON kla_events.type_id = kla_types.id
            LEFT JOIN kla_places On kla_events.place = kla_places.id
            WHERE kla_events.id = ?';
        $result = $this->db->fetchAssoc($query, array((int) $id));
        return !$result ? array() : $result;
    }
    
}