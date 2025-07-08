<?php
//mysql
$DB_gogess = NewADOConnection('mysql');
$DB_gogess->Connect("127.0.0.1", "root", "Dibeal2015", "dibealdb");

 


//sqlserver
//$DB_gogess =& ADONewConnection('odbc_mssql');
//$dsn = "Driver={SQL Server};Server=HP\SQLEXPRESS;Database=fakturasdb;";
//$DB_gogess->Connect($dsn,'sa','fa2013')or die("Unable to connect to server");
//$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;	
?>