<?php
namespace ActiveRecord;

abstract class ReplicationModel extends ActiveRecord\Model {

    // Specify the default connection for this model
    static $connection = 'read';
    protected $master_db = 'write';

    /**
    * Changes the model's active database connection.
    *
    * An instance of the ActiveRecord ConnectionManager class
    * singleton is used to ensure we don't open wasteful new
    * connections all over the place.
    *
    * The function returns the name of the connection being
    * replaced.
    *
    * @param string $name New connection name
    * @return string Old connection name
    * @throws ActiveRecord\DatabaseException on invalid connection name
    */
    public function switch_connection($name) {
        $cfg = ActiveRecord\Config::instance();
        $valid = $cfg->get_connections();
        if ( ! isset($valid[$name])) {
            throw new ActiveRecord\DatabaseException('Invalid connection specified');
        }
        // Get the name of the current connection
        $old = self::$connection;
        $cm = ActiveRecord\ConnectionManager::instance();
        $conn = $cm::get_connection($name);
        static::table()->conn = $conn;
        return $old;
    }

    /**
    * Routes save operations to "write" connection then
    * switches back to the "read" db connection.
    *
    * We add the $validate parameter because the parent
    * save method specifies its inclusion.
    */

    public function save($validate=TRUE) {
        $slave_db = $this->switch_connection($this->master_db);
        parent::save($validate);
        $this->switch_connection($slave_db);
    }

    /**
    * Routes delete operations to "write" connection then
    * switches back to the "read" db connection.
    */
    public function delete() {
        $slave_db = $this->switch_connection($this->master_db);
        parent::delete();
        $this->switch_connection($slave_db);
    }

}

 ?>
