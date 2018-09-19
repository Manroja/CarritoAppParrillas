<?php
class Dbconfig {
    protected $serverName;
    protected $userName;
    protected $passCode;
    protected $dbName;

    function Dbconfig() {
        $this -> serverName = '127.0.0.1';
        $this -> userName = 'root';
        $this -> passCode = '123456';
        $this -> dbName = 'parrillas_db';
    }
}
?>
