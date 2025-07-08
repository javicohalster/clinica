<?php
//Mysql
//$dsn = "postgres://postgres:123456@localhost/sigepdb";
 //$DB_gogess->debug = true;

//$DB_gogess = &ADONewConnection($dsn);
$host="localhost";
$user='drodriguez';
$pass='79Drodri$';
$dbname='pichinchahumana_original';

$DB_gogess = NewADOConnection('mysqli');
$DB_gogess->Connect($host,$user,$pass, $dbname);
//$DB_gogess->debug=true;
//Path editor
$ptaeditor="/lospinos/director/";

?>

