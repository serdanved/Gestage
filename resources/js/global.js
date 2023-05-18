/* global $ */
/* global tinymce */

// $(document).ajaxStart(function() { Pace.restart(); });

function scrollToAnchor(aid) {
	var aTag = $("a[name='" + aid + "']");
	$('html,body').animate({scrollTop: aTag.offset().top - 110}, 'slow');
}

function set_select_program_teacher_data(program_id) {
	$.ajax({
		type: 'POST',
		url: '/teacher/get_teachers_from_program/',
		data: {program_id: program_id},
		datatype: 'json',
		success: function (data) {
			if (data != "") {
				var returnedData = JSON.parse(data);
				$("#TEACHER_ID").empty();
				for (var i = 0; i < returnedData.length; i++) {
					$("#TEACHER_ID").append("<option value='" + returnedData[i].ID + "'>" + returnedData[i].NAME + "</option>");
				}
			} else {
				$("#TEACHER_ID").empty();
			}
		}
	});
}

function set_select_program_employer_data(program_id) {
	$.ajax({
		type: 'POST',
		url: '/employer/get_employers_from_program/',
		data: {program_id: program_id},
		datatype: 'json',
		success: function (data) {
			if (data != "") {
				var returnedData = JSON.parse(data);
				$("#EMPLOYER_ID").empty();
				for (var i = 0; i < returnedData.length; i++) {
					$("#EMPLOYER_ID").append("<option value='" + returnedData[i].ID + "'>" + returnedData[i].NAME + "</option>");
				}
				$("#EMPLOYER_ID").trigger('change');
			} else {
				$("#EMPLOYER_ID").empty();
			}
		}
	});
}

$.urlParam = function (name) {
	var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
	if (results == null) {
		return null;
	} else {
		return decodeURI(results[1]) || 0;
	}
}

$(function () {
	// This code will attach `fileselect` event to all file inputs on the page
	$(document).on('change', ':file', function () {
		var input = $(this),
			numFiles = input.get(0).files ? input.get(0).files.length : 1,
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [numFiles, label]);
	});

	$(document).ready(function () {
		//below code executes on file input change and append name in text control
		$(':file').on('fileselect', function (event, numFiles, label) {

			var input = $(this).parents('.input-group').find('.filename'),
				log = numFiles > 1 ? numFiles + ' files selected' : label;

			if (input.length) {
				input.val(log);
			} else {
				if (log) alert(log);
			}
		});
	});
});

$(document).ready(function () {
	$.fn.serializeObject = function () {
		var o = {};
		var a = this.serializeArray();
		$.each(a, function () {
			if (o[this.name]) {
				if (!o[this.name].push) {
					o[this.name] = [o[this.name]];
				}
				o[this.name].push(this.value || '');
			} else {
				o[this.name] = this.value || '';
			}
		});
		return o;
	};

	if ($(window).innerWidth() <= 800) {
		$('table').wrap('<div class="table-responsive"></div>');
	}

	console.log($.urlParam('browsercheck'));
	console.log(navigator.userAgent.search("Firefox"));
	if ((navigator.userAgent.search("Firefox") <= 0) && (navigator.userAgent.search("Chrome") <= 0)) {
		if ($.urlParam('browsercheck') != null) {
			$("#browsercheck").attr("style", "display:flex;justify-content: center; align-items: center; margin-bottom: 15px;");
		}
	}

	$("#submit_employer_contact_form").on("click", function (e) {
		e.preventDefault();
		var employer_id = $("#EmployerContactModal input[name='EMPLOYER_ID']").val();
		var contact_name = $("#EmployerContactModal input[name='CONTACT_NAME']").val();
		var contact_phone = $("#EmployerContactModal input[name='CONTACT_PHONE']").val();
		var contact_email = $("#EmployerContactModal input[name='CONTACT_EMAIL']").val();

		$.ajax({
			url: '/employer/add_employer_contact_ajax/',
			method: 'POST',
			data: {
				"EMPLOYER_ID": employer_id,
				"CONTACT_NAME": contact_name,
				"CONTACT_PHONE": contact_phone,
				"CONTACT_EMAIL": contact_email
			},
			success: function (response) {
				if (response == "ADDED") {
					location.reload(true);
				} else {
					$(".employer_contact_errors").text("TOUS LES CHAMPS SONT NÉCESSAIRES");
				}
			}
		});
	});

	$("#submit_horaire_stage").click(function (e) {
		var evening = 0;
		e.preventDefault();
		if ($("#CK_HORAIRE_EVENING").prop("checked") == true) {
			evening = 1;

		} else {
			$(".panel-horaire .th-evening").remove();
			$(".panel-horaire .td-evening").remove();
		}
		var horaire_stage = "[" + JSON.stringify($('#horaireform .horaireform_0').serializeObject()) + "," + JSON.stringify($('#horaireform .horaireform_1').serializeObject()) + "," + JSON.stringify($('#horaireform .horaireform_2').serializeObject()) + "," + JSON.stringify($('#horaireform .horaireform_3').serializeObject()) + "," + JSON.stringify($('#horaireform .horaireform_4').serializeObject()) + "," + JSON.stringify($('#horaireform .horaireform_5').serializeObject()) + "," + JSON.stringify($('#horaireform .horaireform_6').serializeObject()) + "]";
		var internship_id = $(this).val();

		$.ajax({
			type: 'POST',
			url: '/internship/update_schedule/',

			data: {horaire_stage: horaire_stage, internship_id: internship_id, evening: evening},

			success: function (data) {
				if (data == "UPDATE") {
					window.location.reload();
				} else {
					console.log(data);
					$(".horaire_stage_validation_error").html(data);
				}
			}
		});
	});

	$(".submit_generate_schedule").click(function (e) {
		e.preventDefault();
		var confirmation = confirm("DÉSIREZ-VOUS VRAIMENT GÉNÉRER LES JOURS DE TRAVAIL DE CE BLOC SELON LA GRILLE HORAIRE DÉFINIE?");
		if (confirmation == false) {
			$('html, body').animate({scrollTop: ($('#horairestage').offset().top)}, 500);
			if ($('.btn_horaire_stage_collapse').attr('aria-expanded') === "false") {
				$(".btn_horaire_stage_collapse").click();
			}

		} else {
			var block_id = $(this).data("blockId");
			var internship_id = $(this).data("internshipId");
			$.ajax({
				type: 'POST',
				url: '/internship/generate_schedule/',

				data: {block_id: block_id, internship_id: internship_id},

				success: function (data) {
					if (data == "GENERATE") {
						window.location.reload();
					} else {
						console.log(data);
					}
				}
			});
		}
	});

	const sig_canvas = document.getElementById("SIGNATURE");
	let sig = null;
	if (sig_canvas) {
		sig = new SignaturePad(sig_canvas);

		sig.addEventListener("afterUpdateStroke", () => {
			$("input[name='SIGNATURE_VALUE']").val(sig.toDataURL());
		});
	}

	$('#signatureModal').on('show.bs.modal', function (event) {
		var obligation_id = $(event.relatedTarget).data("obligation-id");
		var document_id = $(event.relatedTarget).data("document-id");
		var form_id = $(event.relatedTarget).data("form-id");
		$("input[name='OBLIGATION_ID']").val(obligation_id);
		$("input[name='DOCUMENT_ID']").val(document_id);
		$("input[name='FORM_ID']").val(form_id);
	});

//SIGNATUREMODAL
	$("#submit_signature").click(function (e) {
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: '/lettergenerator/rewritePDF/',

			data: $('#signatureform').serialize(),

			success: function (data) {
				if (data == "ADDED") {
					//alert("OK");
					window.location.reload();
				} else {
					console.log(data);
					$(".signature_validation_errors").html(data);
				}
			}
		});
	});1

	$("#reset_signature").click(function (e) {
		$("input[name='SIGNATURE_VALUE']").val("");
		if (sig) {
			sig.clear();
		}
	});

	//FOR LETTER GENERATOR
	$("#draggable li").on("click", function (e) {
		tinymce.activeEditor.execCommand('mceInsertContent', false, $(this).text());
	});

	//INTERNSHIP/ADD
	$(".program_select_change").on('change', function () {
		var program_id = $(this).val();
		set_select_program_teacher_data(program_id);
		set_select_program_employer_data(program_id);
	});

	$(".employer_select_change").on('change', function () {
		var employer_id = $(this).val();
		set_select_employer_contact_data(employer_id);
	});

	$('#CK_HORAIRE_EVENING').change(function () {
		if ($(this).is(':checked')) {
			$(".panel-horaire .th-evening").show();
			$(".panel-horaire .td-evening").show();
		} else {
			$(".panel-horaire .th-evening").hide();
			$(".panel-horaire .td-evening").hide();
		}
	});

	//DELETE DOCUMENT
	$(".document-delete").on('click', function (e) {
		e.preventDefault();
		var document_id = $(this).data("documentid");

		var confirmation = confirm("Êtes-vous certain de vouloir supprimer ce document?");
		if (confirmation == true) {
			$.ajax({
				type: "POST",
				url: "/document/remove_document",
				data: {document_id: document_id},
				success: function (data) {
					if (data == "DONE") {
						window.location.reload();
					} else {
						console.log(data);
					}
				}
			});
		}
	});

	//SEND EMPLOYER INFO
	$(".employer_send_info").on('click', function (e) {

		e.preventDefault();
		var employer_id = $(this).data("employerid");
		var my_button = $(this);

		var confirmation = confirm("Êtes-vous sur de vouloir envoyer les informations de connexion à cet employeur?");
		if (confirmation == true) {
			$.ajax({
				type: "POST",
				url: "/employer/sendinfo",
				data: {employer_id: employer_id},
				success: function (data) {
					if (data == "DONE") {
						my_button.removeClass("btn-warning");
						my_button.addClass("btn-success");
					} else {
						console.log(data);
					}
				}
			});
		}
	});

	//ADD EMPLOYER IN PROGRAM
	$(".EMPLOYER_ADD_PROGRAM").on('change', function () {
		var program_id = $(this).val();
		var employer_id = $(this).data("employerId");

		var confirmation = confirm("Êtes-vous sur de vouloir ajouter cet employeur?");
		if (confirmation == true) {
			$.ajax({
				type: "POST",
				url: "/employer/add_program",
				data: {program_id: program_id, employer_id: employer_id},

				success: function (data) {
					if (data == "DONE") {
						window.location.reload();
					} else {
						console.log(data);
					}
				}
			});
		}
	});

	$('#NoteModal').on('shown.bs.modal', function () {
		$("input[name='DESCRIPTION']").focus();
	});

	function set_select_employer_contact_data(employer_id) {
		$.ajax({
			type: 'POST',
			url: '/employer/get_employer_contacts/',
			data: {employer_id: employer_id},
			datatype: 'json',
			success: function (data) {
				if (data != "") {
					var returnedData = JSON.parse(data);
					$("#EMPLOYER_CONTACT_ID").empty();
					for (var i = 0; i < returnedData.length; i++) {
						console.log(returnedData[i]);
						$("#EMPLOYER_CONTACT_ID").append("<option value='" + returnedData[i].ID + "'>" + returnedData[i].CONTACT_NAME + " | " + returnedData[i].CONTACT_PHONE + " | " + returnedData[i].CONTACT_EMAIL + "</option>");
					}
				} else {
					$("#EMPLOYER_CONTACT_ID").empty();
				}
			}
		});
	}

	if ($('.assign-student-list').length) {
		$('.assign-student-list').DataTable({
			paging: true,

			"language": {
				"decimal": "",
				"emptyTable": "Aucun élève",
				"info": "_TOTAL_ élèves",
				"infoEmpty": "",
				"infoFiltered": "(filtré de _MAX_ total élève)",
				"infoPostFix": "",
				"thousands": ",",
				"lengthMenu": "&nbsp;&nbsp;&nbsp;&nbsp;Afficher _MENU_ élèves",
				"loadingRecords": "Chargement...",
				"processing": "En traitement...",
				"search": "Rechercher:",
				"zeroRecords": "Aucun enregistrements correspondants trouvés",
				"paginate": {
					"first": "Première",
					"last": "Dernière",
					"next": "Suivant",
					"previous": "Précédent"
				}
			}
		});
	}

	if ($('.internship-table-actives').length) {
		$('.internship-table-actives').DataTable({
			paging: false,

			"columnDefs": [
				{
					"type": "date",
					"targets": 4
				},
				{
					"type": "date",
					"targets": 5
				}
			],
			"order": [[4, "asc"]],

			"language": {
				"decimal": "",
				"emptyTable": "Aucun stage",
				"info": "_TOTAL_ stages",
				"infoEmpty": "",
				"infoFiltered": "(filtré de _MAX_ total stage)",
				"infoPostFix": "",
				"thousands": ",",
				"lengthMenu": "&nbsp;&nbsp;&nbsp;&nbsp;Afficher _MENU_ stages",
				"loadingRecords": "Chargement...",
				"processing": "En traitement...",
				"search": "Rechercher:",
				"zeroRecords": "Aucun enregistrements correspondants trouvés",
				"paginate": {
					"first": "Première",
					"last": "Dernière",
					"next": "Suivant",
					"previous": "Précédent"
				}
			}
		});
	}

	//FOR INTERNSHIP TABLES {INTERNSHIP/INDEX}
	if ($('.internship-table').length) {
		$('.internship-table').DataTable({
			"responsive": true,
			"columnDefs": [
				{
					"type": "date",
					"targets": 4
				}, {
					"type": "date",
					"targets": 5
				}
			],
			"order": [[4, "asc"]],

			"language": {
				"decimal": "",
				"emptyTable": "Aucun stage",
				"info": "&nbsp;&nbsp;&nbsp; _START_ / _END_ de _TOTAL_ stages",
				"infoEmpty": "",
				"infoFiltered": "(filtré de _MAX_ total stage)",
				"infoPostFix": "",
				"thousands": ",",
				"lengthMenu": "&nbsp;&nbsp;&nbsp;&nbsp;Afficher _MENU_ stages",
				"loadingRecords": "Chargement...",
				"processing": "En traitement...",
				"search": "Rechercher:",
				"zeroRecords": "Aucun enregistrements correspondants trouvés",
				"paginate": {
					"first": "Première",
					"last": "Dernière",
					"next": "Suivant",
					"previous": "Précédent"
				},
			}
		});
	}

	//FOR EMPLOYERS TABLES {EMPLOYERS/INDEX}
	if ($('.cat-table').length) {
		$('.cat-table').DataTable({
			"responsive": true,
			"pageLength": 25,
			"language": {
				"decimal": "",
				"emptyTable": "Aucune catégorie",
				"info": "&nbsp;&nbsp;&nbsp; _START_ / _END_ de _TOTAL_ categories",
				"infoEmpty": "",
				"infoFiltered": "(filtré de _MAX_ total categories)",
				"infoPostFix": "",
				"thousands": ",",
				"lengthMenu": "&nbsp;&nbsp;&nbsp;&nbsp;Afficher _MENU_ catégories",
				"loadingRecords": "Chargement...",
				"processing": "En traitement...",
				"search": "Rechercher:",
				"zeroRecords": "Aucun enregistrements correspondants trouvés",
				"paginate": {
					"first": "Première",
					"last": "Dernière",
					"next": "Suivant",
					"previous": "Précédent"
				},
			}
		});
	}

	//FOR EMPLOYERS TABLES {EMPLOYERS/INDEX}
	if ($('.employer-table').length) {
		$('.employer-table').DataTable({
			"responsive": true,
			"pageLength": 25,
			"language": {
				"decimal": "",
				"emptyTable": "Aucun employeur",
				"info": "&nbsp;&nbsp;&nbsp; _START_ / _END_ de _TOTAL_ employeurs",
				"infoEmpty": "",
				"infoFiltered": "(filtré de _MAX_ total employeur)",
				"infoPostFix": "",
				"thousands": ",",
				"lengthMenu": "&nbsp;&nbsp;&nbsp;&nbsp;Afficher _MENU_ employeurs",
				"loadingRecords": "Chargement...",
				"processing": "En traitement...",
				"search": "Rechercher:",
				"zeroRecords": "Aucun enregistrements correspondants trouvés",
				"paginate": {
					"first": "Première",
					"last": "Dernière",
					"next": "Suivant",
					"previous": "Précédent"
				},
			}
		});
	}

	//FOR TEACHERS TABLES {TEACHERS/INDEX}
	if ($('.teachers-datatable').length) {
		$('.teachers-datatable').DataTable({
			"responsive": true,

			"language": {
				"decimal": "",
				"emptyTable": "Aucun enseignant",
				"info": "&nbsp;&nbsp;&nbsp; _START_ / _END_ de _TOTAL_ enseignants",
				"infoEmpty": "",
				"infoFiltered": "(filtré de _MAX_ total employeur)",
				"infoPostFix": "",
				"thousands": ",",
				"lengthMenu": "&nbsp;&nbsp;&nbsp;&nbsp;Afficher _MENU_ enseignants",
				"loadingRecords": "Chargement...",
				"processing": "En traitement...",
				"search": "Rechercher:",
				"zeroRecords": "Aucun enregistrements correspondants trouvés",
				"paginate": {
					"first": "Première",
					"last": "Dernière",
					"next": "Suivant",
					"previous": "Précédent"
				},
			}
		});
	}

	$.fn.dataTableExt.afnFiltering.push(function (oSettings, aData, iDataIndex) {
		// alert(aData[0]);
		var checkbool = true;

		if ($('.presence-table').length) {
			if ($('#BLOCK_SCHEDULE_ID_SELECT').val()) {
				if ($('#BLOCK_SCHEDULE_ID_SELECT').val() != aData[0]) {
					checkbool = false;
				}
			}
		}

		if ($('.absences-datatable').length) {
			var row_date = new Date(aData[4]);
			var select_date_start = new Date($('#START_DATE_SELECT').val());
			var select_date_end = new Date($('#END_DATE_SELECT').val());
			select_date_start.setDate(select_date_start.getDate() - 1);
			select_date_end.setDate(select_date_end.getDate() + 1);

			if (($('#STUDENT_ID_SELECT').val() == "") && ($('#START_DATE_SELECT').val() == "") && ($('#END_DATE_SELECT').val() == "")) {
				return false;
			}

			if ($('#STUDENT_ID_SELECT').length) {
				if ($('#STUDENT_ID_SELECT').val()) {
					if ($('#STUDENT_ID_SELECT').val() != aData[0]) {
						checkbool = false;
					}
				}
			}

			if ($('#START_DATE_SELECT').length) {
				if ($('#START_DATE_SELECT').val()) {
					if (select_date_start >= row_date) {
						checkbool = false;
					}
				}
			}

			if ($('#END_DATE_SELECT').length) {
				if ($('#END_DATE_SELECT').val()) {
					if (select_date_end <= row_date) {
						checkbool = false;
					}
				}
			}
		}

		return checkbool;
	});

	//FOR EMPLOYERS TABLES {EMPLOYERS/INDEX}
	if ($('.presence-table').length) {
		var presences_datatable = $('.presence-table').DataTable({
			"responsive": true,
			"columnDefs": [
				{
					"targets": [0],
					"visible": false,
					"searchable": true
				}
			],
			"paging": false,
			"language": {
				"decimal": "",
				"emptyTable": "Aucune présence",
				"info": "&nbsp;&nbsp;&nbsp; _START_ / _END_ de _TOTAL_ présences",
				"infoEmpty": "",
				"infoFiltered": "(filtré de _MAX_ total présences)",
				"infoPostFix": "",
				"thousands": ",",
				"lengthMenu": "&nbsp;&nbsp;&nbsp;&nbsp;Afficher _MENU_ présences",
				"loadingRecords": "Chargement...",
				"processing": "En traitement...",
				"search": "Rechercher:",
				"zeroRecords": "Aucun enregistrements correspondants trouvés",
				"paginate": {
					"first": "Première",
					"last": "Dernière",
					"next": "Suivant",
					"previous": "Précédent"
				},
			},
		});
	}

	$('#BLOCK_SCHEDULE_ID_SELECT').on('change', function (e) {
		$('.presence-table').dataTable().fnDraw();
	});

	$("#submit_presences").click(function (e) {
		e.preventDefault();
		var json_data = "";
		var postData = [];

		$('.presence-table > tbody  > tr').each(function () {
			var schedule_reason = $(this).data("scheduleReason");

			var data = {
				DAY: $(this).data("scheduleDay"),
				FROM_AM: $("input[name=FROM_AM]", this).val(),
				TO_AM: $("input[name=TO_AM]", this).val(),
				FROM_PM: $("input[name=FROM_PM]", this).val(),
				TO_PM: $("input[name=TO_PM]", this).val(),
				FROM_EV: $("input[name=FROM_EV]", this).val(),
				TO_EV: $("input[name=TO_EV]", this).val(),
				DATE: $(this).data("scheduleDate"),
			};

			if ($("input[name=PRESENT]", this).is(':checked')) {
				data.PRESENT = "on";
				schedule_reason = "";
			}
			if ($("input[name=CLOSED]", this).is(':checked')) {
				data.CLOSED = "on";
			}

			postData.push({
				schedule_id: $(this).data("scheduleId"),
				schedule_reason: schedule_reason,
				data: data,
			});
		});

		fetch("/internship/update_presence/", {
			method: "POST",
			body: JSON.stringify(postData),
		}).then(async response => {
			let text = await response.text();
			if (text === "UPDATE") {
				window.location.reload();
			} else {
				console.log(text);
			}
		}).catch(console.error);
	});

	$("body").on("click", ".presence-table input[name=PRESENT]", function () {
		if (!$(this).is(":checked")) {
			var schedule_id = $(this).parents("TR").data("scheduleId");
			$('#AbsenceModal').data("scheduleId", schedule_id);
			$('#AbsenceModal').modal('show');
		} else {
			$(this).prop('checked', true);
		}
	});

	$('#AbsenceModal').on('show.bs.modal', function (e) {
		var schedule_id = $(e.currentTarget).data("scheduleId");
		$(".absence_validation_errors").text("");
		$(e.currentTarget).find("#REASON").val("");

		$('#AbsenceModal').off('click').on('click', '#submit_absence', function (t) {
			var reason = $(e.currentTarget).find("#REASON").val();

			if (reason != "") {
				$('.schedule-row-' + schedule_id).data("scheduleReason", reason);
				$('#AbsenceModal').modal('hide');
				$('.schedule-row-' + schedule_id + ' input[name=PRESENT]').prop('checked', false);
				$('.schedule-row-' + schedule_id + ' input[name=PRESENT]').attr('title', reason).tooltip('fixTitle').tooltip('show');
			} else {
				$(".absence_validation_errors").text("LE CHAMPS 'RAISON' NE PEUT PAS ÊTRE VIDE");
			}
		});
	});

	$('#AbsenceModal').on('hide.bs.modal', function (e) {
		console.log(e.relatedTarget);
		var schedule_id = $(e.currentTarget).data("scheduleId");
		$('.schedule-row-' + schedule_id + ' input[name=PRESENT]').prop('checked', true);
	});

	//FOR TEACHERS TABLES {TEACHERS/INDEX}
	if ($('.absences-datatable').length) {
		var absences_datatable = $('.absences-datatable').DataTable({
			"responsive": true,

			"columnDefs": [
				{
					"targets": [0],
					"visible": false,
					"searchable": true
				}],

			"language": {
				"decimal": "",
				"emptyTable": "Aucune absence",
				"info": "&nbsp;&nbsp;&nbsp; _START_ / _END_ de _TOTAL_ absences",
				"infoEmpty": "",
				"infoFiltered": "(filtré de _MAX_ total absence)",
				"infoPostFix": "",
				"thousands": ",",
				"lengthMenu": "&nbsp;&nbsp;&nbsp;&nbsp;Afficher _MENU_ absences",
				"loadingRecords": "Chargement...",
				"processing": "En traitement...",
				"search": "Rechercher:",
				"zeroRecords": "Aucun enregistrements correspondants trouvés",
				"paginate": {
					"first": "Première",
					"last": "Dernière",
					"next": "Suivant",
					"previous": "Précédent"
				},
			}
		});

		$('#btn-absence-filter').on('click', function (e) {
			$('.absences-datatable').dataTable().fnDraw();
		});

		$('#btn-absence-print').on('click', function (e) {
			var student_id = "null";
			var start_date = "null";
			var end_date = "null";

			if ($('#STUDENT_ID_SELECT').val()) {
				var student_id = $('#STUDENT_ID_SELECT').val();
			}

			if ($('#START_DATE_SELECT').val()) {
				var start_date = $('#START_DATE_SELECT').val();
			}

			if ($('#END_DATE_SELECT').val()) {
				var end_date = $('#END_DATE_SELECT').val();
			}

			window.open("/absence/printabsences/" + student_id + "/" + start_date + "/" + end_date);
		});
	}

	if ($('.btn_collapsed').length) {
		$(".btn_collapsed").click(function () {
			$(this).find('i').toggleClass('fa-plus fa-minus');
		});
	}

	if ($('.has-datetimepicker').length) {
		$('.has-datetimepicker').datetimepicker();
	}

	if ($('.has-datepicker').length) {
		$('.has-datepicker').datetimepicker({format: 'DD/MM/YYYY'});
	}

	if ($("select").length) {
		$("select").not(".force-normal").select2();
	}

	if ($("#unselector").length) {
		$("#unselector").click(function () {
			console.log("test");
		});
	}

	if ($(".fa .fa-trash").length) {
		$(".fa .fa-trash").click(function (e) {
			var confirmation = confirm("Êtes-vous sur de vouloir supprimer cet élément?");

			if (confirmation == false) {
				e.preventDefault();
			}
		});
	}

	if ($("#fb-render").length) {
		let formDataJson = $('#fb-render').data("builderJson");
		let fbRender = document.getElementById('fb-render'), formData = formDataJson;
		let dataType = 'xml';
		console.log(formData);

		let templates = {
			signature: function (fieldData) {
				return {
					field: '<img style="height:40px" src="' + fieldData.img + '"><div style="width:220px;border-top:1px solid black;text-align:center;" id="' + fieldData.name + '">Signature',
					onRender: function () {
						return "";
					}
				};
			},
		};

		var formRenderInstance = $(fbRender).formRender({formData, dataType, templates});

		if ($(".disabled-form ").length) {
			$("input").prop("disabled", true);
			$("select").prop("disabled", true);
		}

		$('#formrender-submit').on('click', function (e) {
			var formData = JSON.stringify(formRenderInstance.userData);
			var formId = $('#FORM_ID').val();
			var InternshipId = $('#INTERNSHIP_ID').val();
			var formObligation = $('#FORM_OBLIGATION').val();

			$.ajax({
				type: "POST",
				url: "/form/submit_ajax",
				data: {formId: formId, formObligation: formObligation, formData: formData, InternshipId: InternshipId},

				success: function (data) {
					if (data == "DONE") {
						window.location.replace("/internship/edit/" + InternshipId + "#vosobligations");
					} else {
						console.log(data);
					}
				}
			});
		});
	}

	if ($("#build-wrap-edit").length) {
		var fbEditor = document.getElementById('build-wrap-edit');
		var fbEditorData = $('#build-wrap-edit').data("builderJson");

		let fields = [{
			label: 'Signature',
			attrs: {
				type: 'signature'
			},
			icon: '🌟'
		}];
		let templates = {
			signature: function (fieldData) {
				return {
					field: '<div style="width:220px;border-bottom:1px solid black;" id="' + fieldData.name + '">',
					onRender: function () {
						return "-------------";
					}
				};
			},
		};

		let showActionButtons = false;
		let formData = fbEditorData;
		let dataType = 'json';
		let disabledFieldButtons = {
			signature: ['edit'] // disables the edit button for select fields
		};

		var formBuilder = $(fbEditor).formBuilder({
			showActionButtons,
			disabledFieldButtons,
			fields,
			templates,
			formData,
			dataType
		});

		$('#formbuilder-submit-edit').on('click', function (e) {
			var formId = $('#FORM_ID').val();
			var formBuilderName = $('#NAME').val();
			var formBuilderProgramId = $('#PROGRAM_ID').val();
			var formBuilderData = formBuilder.actions.getData('json', true);

			$.ajax({
				type: "POST",
				url: "/form/edit_ajax",
				data: {
					formId: formId,
					formBuilderName: formBuilderName,
					formBuilderProgramId: formBuilderProgramId,
					formBuilderData: formBuilderData
				},

				success: function (data) {
					if (data == "DONE") {
						window.location.replace("/form/index");
					} else {
						console.log(data);
						$(".validation-error").text(data);
					}
				}
			});
		});
	}

	if ($("#build-wrap").length) {
		var fbEditor = document.getElementById('build-wrap');

		let fields = [{
			label: 'Signature',
			attrs: {
				type: 'signature'
			},
			icon: '🌟'
		}];
		let templates = {
			signature: function (fieldData) {
				return {
					field: '<div style="width:220px;border-bottom:1px solid black;" id="' + fieldData.name + '">',
					onRender: function () {
						return "-------------";
					}
				};
			},
		};

		let showActionButtons = false;
		let disabledFieldButtons = {
			signature: ['edit'] // disables the edit button for select fields
		};
		let i18n = {
			locale: ['fr-FR'], // disables the remove butotn for text fields
		};

		var formBuilder = $(fbEditor).formBuilder({showActionButtons, disabledFieldButtons, fields, templates, i18n});

		$('#formbuilder-submit').on('click', function (e) {

			var formBuilderName = $('#NAME').val();
			var formBuilderProgramId = $('#PROGRAM_ID').val();
			var formBuilderData = formBuilder.actions.getData('json', true);

			$.ajax({
				type: "POST",
				url: "/form/add_ajax",
				data: {
					formBuilderName: formBuilderName,
					formBuilderProgramId: formBuilderProgramId,
					formBuilderData: formBuilderData
				},

				success: function (data) {
					if (data == "DONE") {
						window.location.replace("/form/index");
					} else {
						$(".validation-error").text(data);
					}
				}
			});
		});
	}

    $(".letter-generator-perms").fadeIn();
	$("#depot").change(function () {
		if (this.checked) {
			console.log("CHECKED");
			$(".letter-generator-perms").fadeIn();
		} else {
			console.log("UNCHECKED");
			$(".letter-generator-perms").fadeOut();
		}
	});

	//TRIGGER FOR FINE UPLOADER
	$('#fine-uploader-manual-trigger').fineUploader({
		template: 'qq-template-manual-trigger',
		request: {
			endpoint: '/upload/file_upload'
		},
		success: {
			endpoint: "/upload/file_upload"
		},
		debug: false,
		validation: {
			sizeLimit: 5000000 // 50 kB = 50 * 1024 bytes
		},
		thumbnails: {
			placeholders: {
				waitingPath: '/resources/fine-uploader/placeholders/waiting-generic.png',
				notAvailablePath: '/resources/fine-uploader/placeholders/not_available-generic.png'
			}
		},
		callbacks: {
			onUpload: function (id, fileName) {
				var newParams = {
					ck_cansee_employers: 0,
					ck_cansee_students: 0,
					ck_cansee_teachers: 0,
					ck_obligation_teachers: 0,
					ck_obligation_students: 0,
					ck_obligation_employers: 0,
					internship_id: 0
				};

				if ($('input[name="ck_CANSEE_EMPLOYERS"]').is(':checked')) {
					newParams.ck_cansee_employers = 1;
				}
				if ($('input[name="ck_CANSEE_TEACHERS"]').is(':checked')) {
					newParams.ck_cansee_teachers = 1;
				}
				if ($('input[name="ck_CANSEE_STUDENTS"]').is(':checked')) {
					newParams.ck_cansee_students = 1;
				}

				if ($('input[name="ck_OBLIGATION_STUDENTS"]').is(':checked')) {
					newParams.ck_obligation_students = 1;
				}
				if ($('input[name="ck_OBLIGATION_TEACHERS"]').is(':checked')) {
					newParams.ck_obligation_teachers = 1;
				}
				if ($('input[name="ck_OBLIGATION_EMPLOYERS"]').is(':checked')) {
					newParams.ck_obligation_employers = 1;
				}

				if ($('input[name="internship_id"]').length > 0) {
					newParams.internship_id = $('input[name="internship_id"]').val();
				}
				this.setParams(newParams);
			},
			onAllComplete: function (id, fileName) {
				location.reload();
			}
		},

		messages: {
			emptyError: "{file} EST VIDE",
			noFilesError: "AUCUN FICHIER À TÉLÉCHARGER",
			maxHeightImageError: "L'IMAGE EST TROP GRANDE",
			maxWidthImageError: "L'IMAGE EST TROP LARGE",
			onLeave: "LES FICHIERS SONT EN COURS DE TÉLÉCHARGEMENTS, SI VOUS PARTEZ MAINTENANT LE TÉLÉCHARGEMENT SERA ANNULÉ",
			sizeError: "{file} EST TROP GRAND, TAILLE DE FICHIER MAXIMALE EST DE {sizeLimit}",
			typeError: "{file} A UNE EXTENSION INVALIDE, EXTENSION(S) VALIDE(S): {extensions}",
		},
		autoUpload: false
	});

	$('#trigger-upload').click(function () {
		$('#fine-uploader-manual-trigger').fineUploader('uploadStoredFiles');
	});

	//FOR FILE UPLOADER BUTTONS MODAL {INTERNSHIP/EDIT}
	$.fn.SelectFiles = function () {
		$("input[name='qqfile']").click();
	};

	$.fn.UploadFiles = function () {
		$('#trigger-upload').click();
	};

	/* SECTION FOR ALL MODAL SUBMIT REQUESTS */

	//BLOCKMODAL
	$("#submit_block").click(function (e) {
		e.preventDefault();

		$.ajax({
			type: 'POST',
			url: '/internship/add_block/',

			data: $('#blocksform').serialize(),

			success: function (data) {
				if (data == "ADDED") {
					window.location.reload();
				} else {

					$(".block_validation_errors").html(data);
				}
			}
		});
	});

	//NOTEMODAL
	$("#submit_note").click(function (e) {
		e.preventDefault();

		$.ajax({
			type: 'POST',
			url: '/note/add/',

			data: $('#noteform').serialize(),

			success: function (data) {
				if (data == "ADDED") {
					window.location.reload();
				} else {
					console.log(data);
					$(".note_validation_errors").html(data);
				}
			}
		});
	});

	//PRIVATENOTEMODAL
	$("#submit_private_note").click(function (e) {
		e.preventDefault();

		$.ajax({
			type: 'POST',
			url: '/note/add/',

			data: $('#privatenoteform').serialize(),

			success: function (data) {
				if (data == "ADDED") {
					window.location.reload();
				} else {
					$(".private_note_validation_errors").html(data);
				}
			}
		});
	});
	/* END OF SECTION FOR ALL MODAL SUBMIT */

	/* BUTTON FOR MASS STUDENTS ASSIGNING */
	$("#mass_assign_button").click(function () {
		var selected = [];

		$("#unassigned_students_table input:checked").each(function () {
			selected.push($(this).val());
		});

		$.ajax({
			type: "POST",
			url: "/teacher/mass_assign_students",
			data: {selected: selected},

			success: function (data) {
				if (data == "DONE") {
					window.location.reload();
				}
			}
		});
	});

	/* BUTTON FOR MASS STUDENTS ARCHIVING */
	$("#mass_archive_button").click(function () {
		var selected = [];

		$("#unassigned_students_table input:checked").each(function () {
			selected.push($(this).val());
		});

		console.log(selected);

		$.ajax({
			type: "POST",
			url: "/teacher/mass_archive_students",
			data: {selected: selected},

			success: function (data) {
				if (data == "DONE") {
					console.log(data);
					window.location.reload();
				} else {
					console.log(data);
				}
			}
		});
	});

	$(function () {
		$('.popover-general').popover({
			container: 'body'
		})
	})
});