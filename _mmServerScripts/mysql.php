<?php
// If this file is not included from the MMHTTPDB possible hacking problem.
if (!function_exists('create_error')){
	die();
}

define('MYSQL_NOT_EXISTS', create_error("Your PHP server doesn't have the mysql module loaded or you can't use the mysql_(p)connect functions."));
define('CONN_NOT_OPEN_GET_TABLES', create_error('The Connection is not opened when trying to retrieve the tables. Please refer to www.interaktonline.com for more information.'));
define('CONN_NOT_OPEN_GET_DB_LIST', create_error('The Connection is not opened when trying to retrieve the database list. Please refer to www.interaktonline.com for more information.'));
			 
if (!function_exists('mysqli_connect') || !function_exists('mysqli_connect') || !extension_loaded('mysql')){
	echo MYSQL_NOT_EXISTS;
	die();
}

// Now let's handle the crashes or any other PHP errors that we can catch
function KT_ErrorHandler($errno, $errstr, $errfile, $errline) { 
	global $f, $already_sent;
	$errortype = array ( 
		1   =>  "Error", 
		2   =>  "Warning", 
		4   =>  "Parsing Error", 
		8   =>  "Notice", 
		16  =>  "Core Error", 
		32  =>  "Core Warning", 
		64  =>  "Compile Error", 
		128 =>  "Compile Warning", 
		256 =>  "User Error", 
		512 =>  "User Warning", 
		1024=>  "User Notice",
		2048=>  "E_ALL",
		2049=>  "PHP5 E_STRICT"
	
	);
	$str = sprintf("[%s]\n%s:\t%s\nFile:\t\t'%s'\nLine:\t\t%s\n\n", date('d-m-Y H:i:s'),(isset($errortype[@$errno])?$errortype[@$errno]:('Unknown '.$errno)),@$errstr,@$errfile,@$errline);
	if (error_reporting() != 0) {
			@fwrite($f, $str);
			if (@$errno == 2 && isset($already_sent) && !$already_sent==true){
				$error = '<ERRORS>'."\n";
				$error .= '<ERROR><DESCRIPTION>An Warning Type error appeared. The error is logged into the log file.</DESCRIPTION></ERROR>'."\n";
				$error .= '</ERRORS>'."\n";
				$already_sent = true;
				echo $error;
			}
	}
}
if ($debug_to_file){
		$old_error_handler = set_error_handler("KT_ErrorHandler");
}

class MySqlConnection
{
/*
 // The 'var' keyword is deprecated in PHP5 ... we will define these variables at runtime.
  var $isOpen;
	var $hostname;
	var $database;
	var $username;
	var $password;
	var $timeout;
	var $connectionId;
	var $error;
*/
	function MySqlConnection($ConnectionString, $Timeout, $Host, $DB, $UID, $Pwd)
	{
		$this->isOpen = false;
		$this->timeout = $Timeout;
		$this->error = '';

		if( $Host ) { 
			$this->hostname = $Host;
		}
		elseif( ereg("host=([^;]+);", $ConnectionString, $ret) )  {
			$this->hostname = $ret[1];
		}
		
		if( $DB ) {
			$this->database = $DB;
		}
		elseif( ereg("db=([^;]+);",   $ConnectionString, $ret) ) {
			$this->database = $ret[1];
		}
		
		if( $UID ) {
			$this->username = $UID;
		}
		elseif( ereg("uid=([^;]+);",  $ConnectionString, $ret) ) {
			$this->username = $ret[1];
		}
		
		if( $Pwd ) {
			$this->password = $Pwd;
		}
		elseif( ereg("pwd=([^;]+);",  $ConnectionString, $ret) ) {
			$this->password = $ret[1];
		}
	}

	function Open()
	{
	  $this->connectionId = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->hostname,  $this->username,  $this->password));
		if (isset($this->connectionId) && $this->connectionId && is_resource($this->connectionId))
		{
			$this->isOpen = ($this->database == "") ? true : mysqli_select_db( $this->connectionId, $this->database);
		}
		else
		{
			$this->isOpen = false;
		}	
	}

	function TestOpen()
	{
		return ($this->isOpen) ? '<TEST status=true></TEST>' : $this->HandleException();
	}

	function Close()
	{
		if (is_resource($this->connectionId) && $this->isOpen)
		{
			if (((is_null($___mysqli_res = mysqli_close($this->connectionId))) ? false : $___mysqli_res))
			{
				$this->isOpen = false;
				unset($this->connectionId);
			}
		}
	}

	function GetTables($table_name = '')
	{
		$xmlOutput = "";
		if ($this->isOpen && isset($this->connectionId) && is_resource($this->connectionId)){
			// 1. mysql_list_tables and mysql_tablename are deprecated in PHP5
			// 2. For backward compatibility GetTables don't have any parameters
			if ($table_name === ''){
					$table_name = @$_POST['Database'];
			}
			$sql = ' SHOW TABLES FROM ' . $table_name;
			$results = mysqli_query( $this->connectionId, $sql) or $this->HandleException();

			$xmlOutput = "<RESULTSET><FIELDS>";

			// Columns are referenced by index, so Schema and
			// Catalog must be specified even though they are not supported

			$xmlOutput .= '<FIELD><NAME>TABLE_CATALOG</NAME></FIELD>';		// column 0 (zero-based)
			$xmlOutput .= '<FIELD><NAME>TABLE_SCHEMA</NAME></FIELD>';		// column 1
			$xmlOutput .= '<FIELD><NAME>TABLE_NAME</NAME></FIELD>';		// column 2

			$xmlOutput .= "</FIELDS><ROWS>";

			if (is_resource($results) && mysqli_num_rows($results) > 0){
					while ($row = mysqli_fetch_array($results)){
							$xmlOutput .= '<ROW><VALUE/><VALUE/><VALUE>' . $row[0]. '</VALUE></ROW>';	
					}
			}
			$xmlOutput .= "</ROWS></RESULTSET>";

    }
		return $xmlOutput;
	}

	function GetViews()
	{
		// not supported
		return "<RESULTSET><FIELDS></FIELDS><ROWS></ROWS></RESULTSET>";
	}

	function GetProcedures()
	{
		// not supported
		return "<RESULTSET><FIELDS></FIELDS><ROWS></ROWS></RESULTSET>";
	}

	function GetColumnsOfTable($TableName)
	{
		$xmlOutput = "";
		$query  = "DESCRIBE $TableName";
		$result = mysqli_query($GLOBALS["___mysqli_ston"], $query) or $this->HandleException();

		if ($result)
		{
			$xmlOutput = "<RESULTSET><FIELDS>";

			// Columns are referenced by index, so Schema and
			// Catalog must be specified even though they are not supported
			$xmlOutput .= "<FIELD><NAME>TABLE_CATALOG</NAME></FIELD>";		// column 0 (zero-based)
			$xmlOutput .= "<FIELD><NAME>TABLE_SCHEMA</NAME></FIELD>";		// column 1
			$xmlOutput .= "<FIELD><NAME>TABLE_NAME</NAME></FIELD>";			// column 2
			$xmlOutput .= "<FIELD><NAME>COLUMN_NAME</NAME></FIELD>";
			$xmlOutput .= "<FIELD><NAME>DATA_TYPE</NAME></FIELD>";
			$xmlOutput .= "<FIELD><NAME>IS_NULLABLE</NAME></FIELD>";
			$xmlOutput .= "<FIELD><NAME>COLUMN_SIZE</NAME></FIELD>";

			$xmlOutput .= "</FIELDS><ROWS>";

			// The fields returned from DESCRIBE are: Field, Type, Null, Key, Default, Extra
			while ($row = mysqli_fetch_array($result,  MYSQLI_ASSOC))
			{
				$xmlOutput .= "<ROW><VALUE/><VALUE/><VALUE/>";

				// Separate type from size. Format is: type(size)
				if (ereg("(.*)\\((.*)\\)", $row["Type"], $ret))
				{
					$type = $ret[1];
					$size = $ret[2];
				}
				else
				{
					$type = $row["Type"];
					$size = "";
				}

				// mysql sets nullable to "YES" or "", so we need to set "NO"
				$null = $row["Null"];
				if ($null == "")
					$null = "NO";

				$xmlOutput .= "<VALUE>" . $row["Field"] . "</VALUE>";
				$xmlOutput .= "<VALUE>" . $type         . "</VALUE>";
				$xmlOutput .= "<VALUE>" . $null         . "</VALUE>";
				$xmlOutput .= "<VALUE>" . $size         . "</VALUE></ROW>";
			}
			((mysqli_free_result($result) || (is_object($result) && (get_class($result) == "mysqli_result"))) ? true : false);

			$xmlOutput .= "</ROWS></RESULTSET>";
		}

		return $xmlOutput;
	}

	function GetParametersOfProcedure($ProcedureName, $SchemaName, $CatalogName)
	{
		// not supported on mysql
		return '<RESULTSET><FIELDS></FIELDS><ROWS></ROWS></RESULTSET>';
	}

	function ExecuteSQL($aStatement, $MaxRows)
	{
		if ( get_magic_quotes_gpc() )
		{
				$aStatement = stripslashes( $aStatement ) ;
		}
				
		$xmlOutput = "";

		$result = mysqli_query($GLOBALS["___mysqli_ston"], $aStatement) or $this->HandleException();
		
		if (isset($result) && is_resource($result))
		{
			$xmlOutput = "<RESULTSET><FIELDS>";

			$fieldCount = (($___mysqli_tmp = mysqli_num_fields($result)) ? $___mysqli_tmp : false);
			for ($i=0; $i < $fieldCount; $i++)
			{
				$meta = (((($___mysqli_tmp = mysqli_fetch_field_direct($result, mysqli_field_tell($result))) && is_object($___mysqli_tmp)) ? ( (!is_null($___mysqli_tmp->primary_key = ($___mysqli_tmp->flags & MYSQLI_PRI_KEY_FLAG) ? 1 : 0)) && (!is_null($___mysqli_tmp->multiple_key = ($___mysqli_tmp->flags & MYSQLI_MULTIPLE_KEY_FLAG) ? 1 : 0)) && (!is_null($___mysqli_tmp->unique_key = ($___mysqli_tmp->flags & MYSQLI_UNIQUE_KEY_FLAG) ? 1 : 0)) && (!is_null($___mysqli_tmp->numeric = (int)(($___mysqli_tmp->type <= MYSQLI_TYPE_INT24) || ($___mysqli_tmp->type == MYSQLI_TYPE_YEAR) || ((defined("MYSQLI_TYPE_NEWDECIMAL")) ? ($___mysqli_tmp->type == MYSQLI_TYPE_NEWDECIMAL) : 0)))) && (!is_null($___mysqli_tmp->blob = (int)in_array($___mysqli_tmp->type, array(MYSQLI_TYPE_TINY_BLOB, MYSQLI_TYPE_BLOB, MYSQLI_TYPE_MEDIUM_BLOB, MYSQLI_TYPE_LONG_BLOB)))) && (!is_null($___mysqli_tmp->unsigned = ($___mysqli_tmp->flags & MYSQLI_UNSIGNED_FLAG) ? 1 : 0)) && (!is_null($___mysqli_tmp->zerofill = ($___mysqli_tmp->flags & MYSQLI_ZEROFILL_FLAG) ? 1 : 0)) && (!is_null($___mysqli_type = $___mysqli_tmp->type)) && (!is_null($___mysqli_tmp->type = (($___mysqli_type == MYSQLI_TYPE_STRING) || ($___mysqli_type == MYSQLI_TYPE_VAR_STRING)) ? "type" : "")) &&(!is_null($___mysqli_tmp->type = ("" == $___mysqli_tmp->type && in_array($___mysqli_type, array(MYSQLI_TYPE_TINY, MYSQLI_TYPE_SHORT, MYSQLI_TYPE_LONG, MYSQLI_TYPE_LONGLONG, MYSQLI_TYPE_INT24))) ? "int" : $___mysqli_tmp->type)) &&(!is_null($___mysqli_tmp->type = ("" == $___mysqli_tmp->type && in_array($___mysqli_type, array(MYSQLI_TYPE_FLOAT, MYSQLI_TYPE_DOUBLE, MYSQLI_TYPE_DECIMAL, ((defined("MYSQLI_TYPE_NEWDECIMAL")) ? constant("MYSQLI_TYPE_NEWDECIMAL") : -1)))) ? "real" : $___mysqli_tmp->type)) && (!is_null($___mysqli_tmp->type = ("" == $___mysqli_tmp->type && $___mysqli_type == MYSQLI_TYPE_TIMESTAMP) ? "timestamp" : $___mysqli_tmp->type)) && (!is_null($___mysqli_tmp->type = ("" == $___mysqli_tmp->type && $___mysqli_type == MYSQLI_TYPE_YEAR) ? "year" : $___mysqli_tmp->type)) && (!is_null($___mysqli_tmp->type = ("" == $___mysqli_tmp->type && (($___mysqli_type == MYSQLI_TYPE_DATE) || ($___mysqli_type == MYSQLI_TYPE_NEWDATE))) ? "date " : $___mysqli_tmp->type)) && (!is_null($___mysqli_tmp->type = ("" == $___mysqli_tmp->type && $___mysqli_type == MYSQLI_TYPE_TIME) ? "time" : $___mysqli_tmp->type)) && (!is_null($___mysqli_tmp->type = ("" == $___mysqli_tmp->type && $___mysqli_type == MYSQLI_TYPE_SET) ? "set" : $___mysqli_tmp->type)) &&(!is_null($___mysqli_tmp->type = ("" == $___mysqli_tmp->type && $___mysqli_type == MYSQLI_TYPE_ENUM) ? "enum" : $___mysqli_tmp->type)) && (!is_null($___mysqli_tmp->type = ("" == $___mysqli_tmp->type && $___mysqli_type == MYSQLI_TYPE_GEOMETRY) ? "geometry" : $___mysqli_tmp->type)) && (!is_null($___mysqli_tmp->type = ("" == $___mysqli_tmp->type && $___mysqli_type == MYSQLI_TYPE_DATETIME) ? "datetime" : $___mysqli_tmp->type)) && (!is_null($___mysqli_tmp->type = ("" == $___mysqli_tmp->type && (in_array($___mysqli_type, array(MYSQLI_TYPE_TINY_BLOB, MYSQLI_TYPE_BLOB, MYSQLI_TYPE_MEDIUM_BLOB, MYSQLI_TYPE_LONG_BLOB)))) ? "blob" : $___mysqli_tmp->type)) && (!is_null($___mysqli_tmp->type = ("" == $___mysqli_tmp->type && $___mysqli_type == MYSQLI_TYPE_NULL) ? "null" : $___mysqli_tmp->type)) && (!is_null($___mysqli_tmp->type = ("" == $___mysqli_tmp->type) ? "unknown" : $___mysqli_tmp->type)) && (!is_null($___mysqli_tmp->not_null = ($___mysqli_tmp->flags & MYSQLI_NOT_NULL_FLAG) ? 1 : 0)) ) : false ) ? $___mysqli_tmp : false);
				if ($meta)
				{
					$xmlOutput .= '<FIELD';
					$xmlOutput .= ' type="'			    . $meta->type;
					$xmlOutput .= '" max_length="'	. $meta->max_length;
					$xmlOutput .= '" table="'			  . $meta->table;
					$xmlOutput .= '" not_null="'		. $meta->not_null;
					$xmlOutput .= '" numeric="'		  . $meta->numeric;
					$xmlOutput .= '" unsigned="'		. $meta->unsigned;
					$xmlOutput .= '" zerofill="'		. $meta->zerofill;
					$xmlOutput .= '" primary_key="'	. $meta->primary_key;
					$xmlOutput .= '" multiple_key="'. $meta->multiple_key;
					$xmlOutput .= '" unique_key="'	. $meta->unique_key;
					$xmlOutput .= '"><NAME>'			  . $meta->name;
					$xmlOutput .= '</NAME></FIELD>';
				}
			}

			$xmlOutput .= "</FIELDS><ROWS>";
			$row = mysqli_fetch_assoc($result);

			for ($i=0; $row && ($i < $MaxRows); $i++)
			{
				$xmlOutput .= "<ROW>";

				foreach ($row as $key => $value)
				{
					$xmlOutput .= "<VALUE>";
					$xmlOutput .= htmlspecialchars($value);
					$xmlOutput .= "</VALUE>";
				}

 				$xmlOutput .= "</ROW>";
				$row = mysqli_fetch_assoc($result);
			}

			((mysqli_free_result($result) || (is_object($result) && (get_class($result) == "mysqli_result"))) ? true : false);

			$xmlOutput .= "</ROWS></RESULTSET>";
		}
				
		return $xmlOutput;
	}

	function GetProviderTypes()
	{
		return '<RESULTSET><FIELDS></FIELDS><ROWS></ROWS></RESULTSET>';
	}

	function ExecuteSP($aProcStatement, $TimeOut, $Parameters)
	{
		return '<RESULTSET><FIELDS></FIELDS><ROWS></ROWS></RESULTSET>';
	}

	function ReturnsResultSet($ProcedureName)
	{
		return '<RETURNSRESULTSET status=false></RETURNSRESULTSET>';
	}

	function SupportsProcedure()
	{	
		return '<SUPPORTSPROCEDURE status=false></SUPPORTSPROCEDURE>';
	}

	/*
	*  HandleException added by InterAKT for ease in database translation answer
	*/
	function HandleException()
	{
		global $debug_to_file, $f;
		$this->error = create_error(' mysql Error#: '. ((int)mysqli_errno($GLOBALS["___mysqli_ston"])) . "\n\n".mysqli_error($GLOBALS["___mysqli_ston"]));
		log_messages($this->error);
		die($this->error.'</HTML>');
	}

	function GetDatabaseList()
	{
		$xmlOutput = '<RESULTSET><FIELDS><FIELD><NAME>NAME</NAME></FIELD></FIELDS><ROWS>';

		if (isset($this->connectionId) && is_resource($this->connectionId)){
				$dbList = (($___mysqli_tmp = mysqli_query($this->connectionId, "SHOW DATABASES")) ? $___mysqli_tmp : false);
				
				while ($row = mysqli_fetch_object($dbList))
				{
					$xmlOutput .= '<ROW><VALUE>' . $row->Database . '</VALUE></ROW>';
				}
    }else{
				$this->error = CONN_NOT_OPEN_GET_DB_LIST;
				return $this->error;
		}
		$xmlOutput .= '</ROWS></RESULTSET>';

		return $xmlOutput;
	}

	function GetPrimaryKeysOfTable($TableName)
	{
		$xmlOutput = '';
		$query  = "DESCRIBE $TableName";
		$result = mysqli_query($GLOBALS["___mysqli_ston"], $query) or $this->HandleException();
		
		
		if ($result)
		{
			$xmlOutput = '<RESULTSET><FIELDS>';

			// Columns are referenced by index, so Schema and
			// Catalog must be specified even though they are not supported
			$xmlOutput .= '<FIELD><NAME>TABLE_CATALOG</NAME></FIELD>';		// column 0 (zero-based)
			$xmlOutput .= '<FIELD><NAME>TABLE_SCHEMA</NAME></FIELD>';		// column 1
			$xmlOutput .= '<FIELD><NAME>TABLE_NAME</NAME></FIELD>';			// column 2
			$xmlOutput .= '<FIELD><NAME>COLUMN_NAME</NAME></FIELD>';
			$xmlOutput .= '<FIELD><NAME>DATA_TYPE</NAME></FIELD>';
			$xmlOutput .= '<FIELD><NAME>IS_NULLABLE</NAME></FIELD>';
			$xmlOutput .= '<FIELD><NAME>COLUMN_SIZE</NAME></FIELD>';

			$xmlOutput .= '</FIELDS><ROWS>';

			// The fields returned from DESCRIBE are: Field, Type, Null, Key, Default, Extra
			while ($row = mysqli_fetch_array($result,  MYSQLI_ASSOC))
			{
			  if (strtoupper($row['Key']) == 'PRI'){
  				$xmlOutput .= '<ROW><VALUE/><VALUE/><VALUE/>';
  
  				// Separate type from size. Format is: type(size)
  				if (ereg("(.*)\\((.*)\\)", $row['Type'], $ret))
  				{
  					$type = $ret[1];
  					$size = $ret[2];
  				}
  				else
  				{
  					$type = $row['Type'];
  					$size = '';
  				}
  
  				// mysql sets nullable to "YES" or "", so we need to set "NO"
  				$null = $row['Null'];
  				if ($null == '')
  					$null = 'NO';
  
  				$xmlOutput .= '<VALUE>' . $row['Field'] . '</VALUE>';
  				$xmlOutput .= '<VALUE>' . $type         . '</VALUE>';
  				$xmlOutput .= '<VALUE>' . $null         . '</VALUE>';
  				$xmlOutput .= '<VALUE>' . $size         . '</VALUE></ROW>';
  			}
			}
			((mysqli_free_result($result) || (is_object($result) && (get_class($result) == "mysqli_result"))) ? true : false);

			$xmlOutput .= '</ROWS></RESULTSET>';
		}
		return $xmlOutput;
	}

}	// class MySqlConnection
?>
