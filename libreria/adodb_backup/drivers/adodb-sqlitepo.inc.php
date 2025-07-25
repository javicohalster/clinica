<?php
/*
v4.991 16 Oct 2008  (c) 2000-2008 John Lim (jlim#natsoft.com). All rights reserved.
  Released under both BSD license and Lesser GPL library license.
  Whenever there is any discrepancy between the two licenses,
  the BSD license will take precedence.

  Portable version of sqlite driver, to make it more similar to other database drivers.
  The main differences are

   1. When selecting (joining) multiple tables, in assoc mode the table
   	  names are included in the assoc keys in the "sqlite" driver.
	  
	  In "sqlitepo" driver, the table names are stripped from the returned column names. 
	  When this results in a conflict,  the first field get preference.

	Contributed by Herman Kuiper  herman#ozuzo.net  
*/

if (!defined('ADODB_DIR')) die();

include_once(ADODB_DIR.'/drivers/adodb-sqlite.inc.php');

class ADODB_sqlitepo extends ADODB_sqlite {
   var $databaseType = 'sqlitepo';

   function ADODB_sqlitepo()
   {
      $this->ADODB_sqlite();
   }
}

/*--------------------------------------------------------------------------------------
       Class Name: Recordset
--------------------------------------------------------------------------------------*/

class ADORecordset_sqlitepo extends ADORecordset_sqlite {

   var $databaseType = 'sqlitepo';

   function ADORecordset_sqlitepo($queryID,$mode=false)
   {
      $this->ADORecordset_sqlite($queryID,$mode);
   }
   
   // Modified to strip table names from returned fields
   function _fetch($ignore_fields=false)
   {
      $this->fields = array();
      $fields = @sqlite_fetch_array($this->_queryID,$this->fetchMode);
      if(is_array($fields))
         foreach($fields as $n => $v)
         {
            if(($p = strpos($n, ".")) !== false)
               $n = substr($n, $p+1);
            $this->fields[$n] = $v;
         }

      return !empty($this->fields);
   }
}
?>