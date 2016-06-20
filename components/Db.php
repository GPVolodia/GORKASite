<?php

class Db
{
    public static function connect()
    {
        
		$dblocation = 'localhost';
		$dbuser = 'iDean';         
		$dbpasswd = '';           
		$dbcnx = mysql_connect($dblocation,$dbuser,$dbpasswd);
		$db = 'pgvsite';
		if (!$dbcnx || !mysql_select_db($db, $dbcnx))
		{
			exit(mysql_error());
		}
    }
}