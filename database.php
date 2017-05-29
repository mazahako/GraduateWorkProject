<?php
class database
{
    private static $_instance;
    private $pg_con;
    private $host = 'localhost';
    private $port = '5432';
    private $user = 'postgres';
    private $password = 'admin';
    private $db = 'test';

    function __construct()
    {
        $this->pg_con = pg_connect("host=$this->host port=$this->port dbname=$this->db user=$this->user password=$this->password") or die("Connection failed");
    }

    public static function get_instance() {
        if(!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    public function get_connection () {
        return $this->pg_con;
    }

    public function data_delete ($table_name) {
        pg_query($this->pg_con, 'DELETE FROM '.$table_name);
    }

}
