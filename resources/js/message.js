$(document).ready(function() {

    if( $('.messages-datatable').length ){

		 var messagetable = $('.messages-datatable').DataTable({
			"responsive": true,
			"ordering": false,
			"searching": false,
			"paging" : false,

			"language": {
			    "decimal":        "",
			    "emptyTable":     "Aucun messages",
			    "info":           "&nbsp;&nbsp;&nbsp; _START_ / _END_ de _TOTAL_ messages",
			    "infoEmpty":      "",
			    "infoFiltered":   "(filtré de _MAX_ total messages)",
			    "infoPostFix":    "",
			    "thousands":      ",",
			    "lengthMenu":     "&nbsp;&nbsp;&nbsp;&nbsp;Afficher _MENU_ messages",
			    "loadingRecords": "Chargement...",
			    "processing":     "En traitement...",
			    "search":         "Rechercher:",
			    "zeroRecords":    "Aucun enregistrements correspondants trouvés",
			    "paginate": {
			        "first":      "Première",
			        "last":       "Dernière",
			        "next":       "Suivant",
			        "previous":   "Précédent"
			    },

        	}
		});

		$('#inbox-refresh').on('click', function(t)
    	{

           messagetable.clear();

           $.ajax({
			type:'POST',
			url:'/internship/getmessages/',
			success:function(data) {
				if (data!="") {

				    $.each(JSON.parse(data), function(i, val) {

                       var row = [];
                       var from_category = "";

                        if (val['FROM_TYPE']==1) { from_category = "[ÉLÈVE]"; }
                        if (val['FROM_TYPE']==2) { from_category = "[ENSEIGNANT]"; }
                        if (val['FROM_TYPE']==3) { from_category = "[EMPLOYEUR]"; }


                       row[0] = '<input type="checkbox" data-from-date="' + val["DATE"] + '" data-from-content="'+val["DESCRIPTION"] + '" data-from-type="'+ val["FROM_TYPE"] + '" data-from-id="' + val["FROM_ID"] +'" data-from-subject="' +val["TITLE"] +'" data-from-name="' +val["FROM_NAME"] +'">';
                       row[1] = '<a href="" data-current-name="' + val["FROM_NAME"] + '" data-toggle="modal" data-action-type="read" data-from-message-td="mailbox-subject-' + val["ID"] +'" data-from-message-id="' + val["ID"] + '" data-from-content="' + val["DESCRIPTION"] + '" data-from-subject="' + val["TITLE"] + '" data-from-type="' + val["FROM_TYPE"] + '"data-from-id="' + val["FROM_ID"] + '" data-from-name="' + val["FROM_NAME"] + '" data-target="#MessageSendModal">' + val["FROM_NAME"] + ' <b>' + from_category + '</b></a>';
                       row[2] = val["TITLE"] + '- ' + val["DESCRIPTION"];
                       row[3] = val["DATE"];
                       messagetable.row.add(row);
                       messagetable.draw();
                    });
				}
			}});


    	});





    	$('#inbox-delete').on('click', function(t)
    	{

            $("#message_list_form input:checkbox:checked").each(function()
    		{
    			var messageid = $(this).attr("data-message-id");


    			$.ajax({
			    type:'POST',
			    url:'/internship/deletemessage/',
			    data:{messageid : messageid},
			    success:function(data) {
				    if (data=="true") {

				        $('#inbox-refresh').click();
				    }
			}});

			});


    	});

	}

	//FOR FILTER

    /*
    $.fn.dataTableExt.afnFiltering.push(function(oSettings, aData, iDataIndex) {
        if( $('.messages-datatable').length ){
            alert("good");
            return false;
        }
    return true;

    });
    */


     /*
        $('#message-filter-select').on('change', function (e) {
    	    alert("in");
            $('.messages-datatable').dataTable().fnDraw();
        });

        */



    function resetModal()
    {

        tinymce.remove();
        tinymce.init({selector: "textarea",language: 'fr_FR',plugins: "link image table paste preview code",toolbar: 'fontselect | fontsizeselect | formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',font_formats: 'Arial=arial,helvetica=helvetica,sans-serif;Courier New=courier new,courier,monospace;AkrutiKndPadmini=Akpdmi-n',height: 200,});
        $('input[name="FROM_MESSAGE"]').val("");
        $("#TO_MESSAGE").val([""]).trigger("change");
    	$('#SUBJECT_MESSAGE').val("");
    	$("#SUBMIT_MESSAGE").hide();
    	$("#REPLY_MESSAGE").hide();
    	$(".TO_MESSAGE_ROW").show();
    	tinymce.get('CONTENT_MESSAGE').setContent("");



    }

    function setModal_title($this,$value)
    {
        $($this.currentTarget).find('#TITLE_MESSAGE').text($value);
    }

    function setModal_from($this,$value)
    {
        $($this.currentTarget).find('input[name="FROM_MESSAGE"]').val($value);
    }



    function setModal_subject_re($this,$value)
    {
        $($this.currentTarget).find('#SUBJECT_MESSAGE').val($($this.currentTarget).find('#SUBJECT_MESSAGE').val() +"RE: " + $value +" ");
    }

    function setModal_subject_tr($this,$value)
    {
        $($this.currentTarget).find('#SUBJECT_MESSAGE').val($($this.currentTarget).find('#SUBJECT_MESSAGE').val() +"TR: " + $value +" ");
    }

    function setModal_subject($this,$value)
    {
        $($this.currentTarget).find('#SUBJECT_MESSAGE').val($value);
    }

    function setModal_to($this,$value1,$value2)
    {
        var selectvalue = [];
        if($($this.currentTarget).find("#TO_MESSAGE").val() != null){

    			selectvalue = $($this.currentTarget).find("#TO_MESSAGE").val();
    			selectvalue.push("{'USER_ID':'"+$value1+"','USER_TYPE':'"+$value2+"'}");
    			$($this.currentTarget).find("#TO_MESSAGE").val(selectvalue);
        }
        else
        {
            $($this.currentTarget).find("#TO_MESSAGE").val(["{'USER_ID':'"+$value1+"','USER_TYPE':'"+$value2+"'}"]);
        }

        $($this.currentTarget).find("#TO_MESSAGE").trigger("change");
    }


    function setModal_to_profile($this,$value1,$value2,$value3)
    {
        $($this.currentTarget).find("#TO_MESSAGE").val(["{'USER_ID':'"+$value1+"','USER_TYPE':'"+$value2+"'}"]);
        var newOption = new Option($value3, "{'USER_ID':'"+$value1+"','USER_TYPE':'"+$value2+"'}", true, true);
        $($this.currentTarget).find("#TO_MESSAGE").append(newOption).trigger("change");
    }

    function setModal_button($this,$value)
    {
        if($value == "submit")
        {
            $($this.currentTarget).find('#SUBMIT_MESSAGE').show();
        }

        if($value == "reply")
        {
            $($this.currentTarget).find('#REPLY_MESSAGE').show();
        }
    }

    function setModal_read($this,$value1,$value2)
    {
        $('#' + $value1).html($('#' + $value1).text());
        blitz_js_db_update('MESSAGES',$value2,'ID','READ','1',false,false,false);
    }

    function setModal_hide($this,$value)
    {
        $($this.currentTarget).find('#' + $value).parents(".form-group").hide();
    }

    function setModal_content($this,$value)
    {
        tinymce.get('CONTENT_MESSAGE').setContent($value);
    }

    function setModal_content_tr($this,$value1,$value2,$value3)
    {
        $html = "<br><br><br><hr><p><strong>Le " +$value2+", "+$value3+" a écrit:</p></strong> <p style=\"text-indent:5%\">" + $value1+ "</p>";
        tinymce.get('CONTENT_MESSAGE').execCommand('mceInsertContent', false, $html);
    }

    function getModal_from()
    {
        $('#MessageSendModal').find('input[name="FROM_MESSAGE"]').val();
    }





     //SET MODAL MESSAGE INPUT FIELD
    $('#MessageSendModal').on('show.bs.modal', function(e) {


    	var action_type = $(e.relatedTarget).data('action-type');
    	resetModal();


    	//CHECK IF WE ARE SENDING A NEW MESSAGE
    	if (action_type == "new")
    	{
            setModal_title(e,"NOUVEAU MESSAGE");
    		setModal_from(e,$(e.relatedTarget).data('from-name'));
    		setModal_button(e,"submit");
    	}

    	//CHECK IF WE ARE REPLYING TO MULTIPLE USERS AND SET FIELDS
    	if (action_type == "reply")
    	{


    		if($("#message_list_form input:checkbox:checked").length > 0)
    		{
 		        setModal_title(e,"RÉPONDRE AU MESSAGE");
        		setModal_from(e,$(e.relatedTarget).data('from-name'));
        		setModal_button(e,"submit");

        		$("#message_list_form input:checkbox:checked").each(function()
        		{
        			setModal_to(e,$(this).attr("data-from-id"),$(this).attr("data-from-type"));
        			setModal_subject_re(e,$(this).attr("data-from-subject"));
        			setModal_content_tr(e,$(this).attr("data-from-content"),$(this).attr("data-from-date"),$(this).attr("data-from-name"));

    			});
    		}
    		else{e.preventDefault();}
    	}

    	//CHECK IF WE ARE REPLYING TO SOMEONE AND SET FIELDS
    	if (action_type == "read")
    	{
    		tinymce.remove();
    		tinymce.init({selector: "textarea",language: 'fr_FR',readonly: '0',plugins: "link image table paste preview code",toolbar: 'fontselect | fontsizeselect | formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',font_formats: 'Arial=arial,helvetica=helvetica,sans-serif;Courier New=courier new,courier,monospace;AkrutiKndPadmini=Akpdmi-n',height: 200,});
    		setModal_read(e,$(e.relatedTarget).data("from-message-td"),$(e.relatedTarget).data("from-message-id"));
    		setModal_title(e,"LECTURE DU MESSAGE");
    		setModal_from(e,$(e.relatedTarget).data('from-name'));
    		setModal_hide(e,"TO_MESSAGE");
    		setModal_subject(e,$(e.relatedTarget).data('from-subject'));
            setModal_content(e,$(e.relatedTarget).data('from-content'));
            setModal_button(e,"reply");



    	}

    	//CHECK IF WE ARE FORWARDING MESSAGE(S)
    	if (action_type == "forward")
    	{
    	    if($("#message_list_form input:checkbox:checked").length > 0)
    		{
                setModal_title(e,"TRANSFERT MESSAGE");
        		setModal_from(e,$(e.relatedTarget).data('from-name'));
        		setModal_button(e,"submit");

        		$("#message_list_form input:checkbox:checked").each(function()
        		{
        			setModal_subject_tr(e,$(this).attr("data-from-subject"));
        			setModal_content_tr(e,$(this).attr("data-from-content"),$(this).attr("data-from-date"),$(this).attr("data-from-name"));
    			});
    		}
    		else{e.preventDefault();}
    	}

    	//IF REPLY BUTTON IS PRESSED
    	$('#MessageSendModal').off('click').on('click', '#REPLY_MESSAGE', function(t)
    	{
            resetModal();
            setModal_title(e,"RÉPONDRE AU MESSAGE");
            setModal_from(e,($(e.relatedTarget).data('current-name')));

            /* PROFILE EXCEPTION */
             if( $('.TO_MESSAGE_PROFILE').length ){
                setModal_to_profile(e,($(e.relatedTarget).data('from-id')),($(e.relatedTarget).data('from-type')),($(e.relatedTarget).data('from-name')));
             }
            else{
               setModal_to(e,($(e.relatedTarget).data('from-id')),($(e.relatedTarget).data('from-type')));
            }


            setModal_subject_re(e,($(e.relatedTarget).data('from-subject')));
            setModal_content_tr(e,$(e.relatedTarget).data('from-content'),$(e.relatedTarget).data('from-date'),$(e.relatedTarget).data('from-name'));
            setModal_button(e,"submit");

    	});

    	//IF SUBMIT BUTTON IS PRESSED
    	$('#MessageSendModal').on('click', '#SUBMIT_MESSAGE', function(t)
    	{
            var message_to = $(e.currentTarget).find("#TO_MESSAGE").val();
            var message_from = ($(e.relatedTarget).data('current-value'));
            var message_subject = $(e.currentTarget).find("#SUBJECT_MESSAGE").val();
            var message_content = tinymce.activeEditor.getContent({format: 'html'});
            var internship_id = ($(t.currentTarget)).val();

            if(internship_id == ""){
               internship_id = ($(e.relatedTarget).data('from-internship-id'));
            }


            $.ajax({
			type:'POST',
			url:'/internship/sendmessages/',
			data: {internship_id:internship_id,message_to:message_to,message_from:message_from,message_subject:message_subject,message_content:message_content},
			success:function(data) {
				if (data=="ADDED") {

				    $(".message_validation_errors").html("<p style='color:green;'>Message envoyé!</p>");
				    setTimeout(function() { $('#MessageSendModal .close').click();}, 2000);

				}
				else{
				    $(".message_validation_errors").html(data);
				}


			}});


    	});



	});






});





