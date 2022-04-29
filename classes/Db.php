<?php
class DB
{
    protected $_mysqli;
    const DB_HOST = 'localhost';
    const DB_USER = 'root';
    const DB_PASSWORD = '';
    const DB = 'db';
    public function __construct()
    {
        $this->_mysqli = new mysqli(static::DB_HOST, static::DB_USER, static::DB_PASSWORD, static::DB);
    }
   
}
?>