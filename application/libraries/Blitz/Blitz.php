<?php

/* BLITZ MEDIA FRAMEWORK CONTROLER 

FUNCTION LISTING

FUNCTION                RETURN                      DESCRIPTION                                     DATA        EXAMPLE
/blitz/updatedb/        Updated row ID              Ajax calls for easy database field update       GET         ?dbtable=USERS?dbsearchvalue=1?dbsearchfield=ID&dbupdrowfield=EMAIL&dbupdrowvalue=NOUVEAU@EMAIL.COM
*/
 
class Blitz {
    
    function __construct()
    {
        $CI = &get_instance();
    } 
    
    function updatedb($dbtable, $dbsearchvalue, $dbsearchfield, $dbupdrowfield, $dbupdrowvalue) 
    {
        $CI->db->set($dbupdrowfield, $dbupdrowvalue);
        $CI->db->where($dbsearchfield, $dbsearchvalue);
        //$CI->db->update($dbtable);
        
        return $CI->db->affected_rows();
    }

    function BlitzFrameworkInitiateJS()
    {
    
    
    }

    
}
