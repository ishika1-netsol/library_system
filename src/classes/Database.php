<?php
class Database
{
    protected $_mysqli;
    const DB_HOST = 'db';
    const DB_USER = 'root';
    const DB_PASSWORD = 'example';
    const DB = 'mysql';
    public function __construct()
    {
        $this->_mysqli = new mysqli(static::DB_HOST, static::DB_USER, static::DB_PASSWORD, static::DB);
    }

}
?>