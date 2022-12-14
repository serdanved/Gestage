<?php
/* BLITZ MEDIA FRAMEWORK CONTROLER

FUNCTION LISTING

FUNCTION                RETURN                      DESCRIPTION                                     DATA        EXAMPLE
/blitz/updatedb/        Updated row ID              Ajax calls for easy database field update       GET         ?dbtable=USERS?dbsearchvalue=1?dbsearchfield=ID&dbupdrowfield=EMAIL&dbupdrowvalue=NOUVEAU@EMAIL.COM
*/

class Blitz extends MY_Controller {
	function __construct() {
		parent::__construct();
	}

	function updatedb() {
		$dbtable = $_GET['dbtable'];
		$dbsearchvalue = $_GET['dbsearchvalue'];
		$dbsearchfield = $_GET['dbsearchfield'];
		$dbupdrowfield = $_GET['dbupdrowfield'];
		$dbupdrowvalue = $_GET['dbupdrowvalue'];
		$this->db->set($dbupdrowfield, $dbupdrowvalue);
		if ($_GET['wherenoteq'] !== 'false') {
			$this->db->where($dbsearchfield . ' !=', $dbsearchvalue);
		} else {
			$this->db->where($dbsearchfield, $dbsearchvalue);
		}

		$this->db->update($dbtable);
		//echo $this->db->last_query();
		return $this->db->affected_rows();
	}

	function BlitzFrameworkInitiateJS() { ?>
		function blitz_js_db_update(dbtable,dbsearchvalue,dbsearchfield,dbupdrowfield,dbupdrowvalue,result=false,refresh=false,wherenoteq=false){

		var get = "?wherenoteq="+wherenoteq+"&dbtable="+dbtable+"&dbsearchvalue="+dbsearchvalue+"&dbsearchfield="+dbsearchfield+"&dbupdrowfield="+dbupdrowfield+"&dbupdrowvalue="+dbupdrowvalue;
		$.ajax({type: "GET",url: '/index.php/blitz/updatedb'+get,success: function(result) {
		if (refresh == true) { location.reload(); }
		if (result == true) { return result; }
		}});
		}
		<?php
	}
}
