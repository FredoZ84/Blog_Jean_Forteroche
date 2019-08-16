<?php
namespace Blog\Jean_Forteroche\Model;
/**
 * 
 */
class Manager 
{
	protected function dbConnect()
    {    	
    	$version ='db5000126631.hosting-data.io';
    	$dbname = 'dbs121169';
    	$charset ='utf8';
    	$dsn = 'mysql:host='.$version.';dbname='.$dbname.';charset='.$charset;
    	$username =  'dbu244824';
    	$password = 'Poc4&bjf2019';

    	$db = new \PDO( $dsn, $username , $password );

    	return $db;
	}
}