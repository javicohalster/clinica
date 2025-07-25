<?php

/*

  v4.991 16 Oct 2008  (c) 2000-2008 John Lim (jlim#natsoft.com). All rights reserved.

  Released under both BSD license and Lesser GPL library license. 

  Whenever there is any discrepancy between the two licenses, 

  the BSD license will take precedence.

  

  Set tabs to 4.

  

  Declares the ADODB Base Class for PHP5 "ADODB_BASE_RS", and supports iteration with 

  the ADODB_Iterator class.

  

  		$rs = $db->Execute("select * from adoxyz");

		foreach($rs as $k => $v) {

			echo $k; print_r($v); echo "<br>";

		}

		

		

	Iterator code based on http://cvs.php.net/cvs.php/php-src/ext/spl/examples/cachingiterator.inc?login=2

 */

class ADODB_Iterator implements Iterator {

    private $rs;

    function __construct($rs) 
	{
        $this->rs = $rs;
    }

    #[\ReturnTypeWillChange]
    function rewind() 
	{
        $this->rs->MoveFirst();
    }

    #[\ReturnTypeWillChange]
	function valid() 
	{
        return !$this->rs->EOF;
    }

    #[\ReturnTypeWillChange]
    function key() 
	{
        return $this->rs->_currentRow;
    }

    #[\ReturnTypeWillChange]
    function current() 
	{
        return $this->rs->fields;
    }

    #[\ReturnTypeWillChange]
    function next() 
	{
        $this->rs->MoveNext();
    }

	function __call($func, $params)
	{
		return call_user_func_array(array($this->rs, $func), $params);
	}

	function hasMore()
	{
		return !$this->rs->EOF;
	}
}

class ADODB_BASE_RS implements IteratorAggregate {

    #[\ReturnTypeWillChange]
    function getIterator() {
        return new ADODB_Iterator($this);
    }

	/* this is experimental - i don't really know what to return... */
	function __toString()
	{
		include_once(ADODB_DIR.'/toexport.inc.php');
		return _adodb_export($this,',',',',false,true);
	}
} 

?>
