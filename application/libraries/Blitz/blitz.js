function blitz_js_db_update(dbtable, dbsearchvalue, dbsearchfield, dbupdrowfield, dbupdrowvalue){

    var get = "?dbtable="+dbtable+"&dbsearchvalue="+dbsearchvalue+"&dbsearchfield="+dbsearchfield+"&dbupdrowfield="+dbupdrowfield+"&dbupdrowvalue="+dbupdrowvalue;
    $.ajax({
        type: "GET",
        data: {get},
        url: '/index.php/blitz/updatedb',
        success: function(result) {
            alert(result);
        }
    });
}