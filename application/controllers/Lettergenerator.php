<?php

use Dompdf\Dompdf;

class Lettergenerator extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Lettergenerator_model');
		$this->load->model('Internship_model');
		$this->load->model('Teacher_model');
	}

	/*
	 * Listing of generators
	 */
	function index() {
		$data['letters'] = $this->Lettergenerator_model->get_all_letters();
		$data["all_programs"] = $this->Teacher_model->get_all_teacher_programs();
		if (is_teacher()) {
			$data["all_programs"] = $this->Teacher_model->get_teacher_programs($this->session->userdata("userid"));
		}

		$data['_view'] = 'lettergenerator/index';
		$this->load->view('layouts/main', $data);
	}

	/*
	 * Adding a new letter
	 */
	function add($progId = 0) {
		if (isset($_POST) && count($_POST) > 0) {
			$params = array(
				'NAME' => $this->input->post('NAME'),
				'DESC' => $this->input->post('DESC'),
				'PROGRAM_ID' => $this->input->post('PROGRAM_ID'),
			);

			$letterid = $this->Lettergenerator_model->add_letter($params);

			if ($this->input->post('LETTER_ID') != 0) {
				$this->Lettergenerator_model->copy_letter($this->input->post('LETTER_ID'), $letterid);
			}

			redirect('lettergenerator/edit/' . $letterid);
		} else {
			if (is_teacher()) {
				$data["all_programs"] = $this->Teacher_model->get_teacher_programs($this->session->userdata("userid"));
			}
			if (is_admin()) {
				$data["all_programs"] = $this->Teacher_model->get_all_teacher_programs();
			}
			$data["progId"] = $progId;
			$data['all_letters'] = $this->Lettergenerator_model->get_all_letters_copy();
			$data['_view'] = 'lettergenerator/add';
			$this->load->view('layouts/main', $data);
		}
	}

	/*
	 *
	 */

	function rewritePDF() {
		//die(var_dump($this->input->post()));

		$this->load->model('Internship_model');
		$this->load->model('Teacher_model');
		$this->load->model('Student_model');
		$this->load->model('Program_model');
		$this->load->model('Employer_model');
		$this->load->model('Block_model');
		$this->load->model('Obligation_model');
		$this->load->model('Document_model');

		$obligation_id = $this->input->post('OBLIGATION_ID');
		$document_id = $this->input->post('DOCUMENT_ID');
		$internship_id = $this->input->post('INTERNSHIP_ID');

		if ($this->input->post()) {
			//UPDATE OBLIGATION
			$params = array('SIGNATURE' => $this->input->post('SIGNATURE_VALUE'), 'STATUS' => 2);
			$this->Obligation_model->update_obligation($obligation_id, $params);

			//GET DOCUMENT
			$document = $this->Document_model->get_document($document_id);

			//GET LETTER
			$letter_name = strtok($document["NAME"], ' -');
			//$letter = $this->Lettergenerator_model->get_letter_by_name($letter_name);
			$letter = $this->Lettergenerator_model->get_letter($document["letter_id"]);

			$width_in_mm = 8.5 * 25.4;
			$height_in_mm = 11 * 25.4;
			//$html2pdf = new htmltopdf('P', 'letter');
			$html2pdf = new DOMPDF();
			$html2pdf->setPaper("Letter", "portrait");

			$content = $letter["CONTENT"];
			$content = str_replace("../../resources/img/centre_prof_alma.jpg", base_url() . "resources/img/logo_gestage.png", $content);
			$content = str_replace("<body", "<page", $content);
			$content = str_replace("</body>", "</page>", $content);
			$stage = $this->Internship_model->get_internship($internship_id);
			$program = $this->Program_model->get_program($stage['PROGRAM_ID']);
			$teacher = $this->Teacher_model->get_teacher($stage['TEACHER_ID']);
			$student = $this->Student_model->get_student($stage['STUDENT_ID']);
			$employeur = $this->Employer_model->get_employer($stage['EMPLOYER_ID']);
			$blocks = $this->Block_model->get_block_letter($internship_id);
			$block = $this->Block_model->get_block($document["BLOCK_ID"]);
			$blocks_count = count($blocks);

			/*
			if( $blocks_count > 0){
				$bloc1       = $blocks[0];
			}
			else { $bloc1["DATE_DEBUT"] = "";$bloc1["DATE_FIN"] = "";$bloc1["HORAIRE"] = ""; }

			if( $blocks_count > 1){
				$bloc2       = $blocks[1];
			}
			else { $bloc2["DATE_DEBUT"] = "";$bloc2["DATE_FIN"] = "";$bloc2["HORAIRE"] = ""; }

			if( $blocks_count > 2){
				$bloc3       = $blocks[2];
			}
			else { $bloc3["DATE_DEBUT"] = "";$bloc3["DATE_FIN"] = "";$bloc3["HORAIRE"] = ""; }

			if( $blocks_count > 3){
				$bloc4       = $blocks[3];
			}
			else { $bloc4["DATE_DEBUT"] = "";$bloc4["DATE_FIN"] = "";$bloc4["HORAIRE"] = ""; }
			*/

			switch ($program["PAVILION"]) {
				case "AUGER":
					$pavilion_address = "1550, boul. Auger Ouest";
					$pavilion_postal_code = "G8C 1H8";
					break;

				case "BEGIN":
					$pavilion_address = "850, av. Bégin Sud";
					$pavilion_postal_code = "G8B 5W2";
					break;

				case "SANTE":
					$pavilion_address = "685, rue Gauthier Ouest";
					$pavilion_postal_code = "G8B 2H9";
					break;

				case "TANGUAY":
					$pavilion_address = "855, rue Tanguay";
					$pavilion_postal_code = "G8B 5Y2";
					break;

				default:
					$pavilion_address = "";
					$pavilion_postal_code = "";
					break;
			}

			preg_match_all('/{(.*?)}/', $content, $matches);

			foreach ($matches[0] as $tag) {
				$fixtag = str_replace("{", "", $tag);
				$fixtag = str_replace("}", "", $fixtag);
				$fixtag = explode(".", $fixtag);

				switch ($fixtag[0]) {
					case "DATE":
						$content = str_replace($tag, date("Y-m-d"), $content);
						break;
					case "PAVILION_ADDRESS":
						$content = str_replace($tag, $pavilion_address, $content);
						break;
					case "PAVILION_POSTAL_CODE":
						$content = str_replace($tag, $pavilion_postal_code, $content);
						break;
					case "EMPLOYEUR":
						$content = str_replace($tag, $employeur[$fixtag[1]], $content);
						break;
					case "PROGRAMME":
						$content = str_replace($tag, $program[$fixtag[1]], $content);
						break;
					case "ENSEIGNANT":
						$content = str_replace($tag, $teacher[$fixtag[1]], $content);
						break;
					case "ETUDIANT":
						$content = str_replace($tag, $student[$fixtag[1]], $content);
						break;
					case "STAGE":
						if ($fixtag[1] == "SCHEDULE") {
							$schedule = $this->printSchedule($stage["ID"], $document["BLOCK_ID"]);
							$content = str_replace($tag, $schedule, $content);
						}
						if ($fixtag[1] == "DATE_START") {
							$content = str_replace($tag, $block[$fixtag[1]], $content);
						}
						if ($fixtag[1] == "DATE_END") {
							$content = str_replace($tag, $block[$fixtag[1]], $content);
						}
						$content = str_replace($tag, $stage[$fixtag[1]], $content);

						break;
					/*
					case "BLOC1":
						$content = str_replace($tag,$bloc1[$fixtag[1]],$content);
						break;
					case "BLOC2":
						$content = str_replace($tag,$bloc2[$fixtag[1]],$content);
						break;
					case "BLOC3":
						$content = str_replace($tag,$bloc3[$fixtag[1]],$content);
						break;
					case "BLOC4":
						$content = str_replace($tag,$bloc4[$fixtag[1]],$content);
						break;
					*/
					case "LOGO":
						//$content = str_replace($tag, "<img src='" . base_url() . "resources/img/logo_gestage.png' width='130'>", $content);
						$img = base64_encode(file_get_contents("./resources/img/logo_gestage.png"));
						$content = str_replace($tag, "<img src='data:image/png;base64,$img' width='130'>", $content);
						break;
					case "SIGNATURE_ELEVE":
						$signature_value_eleve = $this->Obligation_model->get_obligation_signature_by_document_student($document_id);
						if ($signature_value_eleve != "") {
							$content = str_replace($tag, "<img width='200' height='15' src='$signature_value_eleve'>", $content);
						} else {
							$content = str_replace($tag, "", $content);
						}
						break;
					case "SIGNATURE_ENSEIGNANT":
						$signature_value_enseignant = $this->Obligation_model->get_obligation_signature_by_document_teacher($document_id);
						if ($signature_value_enseignant != "") {
							$content = str_replace($tag, "<img width='200' height='15' src='$signature_value_enseignant'>", $content);
						} else {
							$content = str_replace($tag, "", $content);
						}
						break;
					case "SIGNATURE_EMPLOYEUR":
						$signature_value_employeur = $this->Obligation_model->get_obligation_signature_by_document_employer($document_id);
						if ($signature_value_employeur != "") {
							$content = str_replace($tag, "<img width='200' height='15' src='$signature_value_employeur'>", $content);
						} else {
							$content = str_replace($tag, "", $content);
						}
						break;
				}
			}

			/*$html2pdf->writeHTML($content);
			$pdf_content = $html2pdf->output('', 'S');*/
			$html2pdf->loadHtml($content);
			$html2pdf->render();
			$pdf_content = $html2pdf->output();
			if (!is_dir('resources/uploads/' . $internship_id)) {
				mkdir('resources/uploads/' . $internship_id);
			}

			$path_and_file_name = "resources/uploads/" . $internship_id . "/" . $document['FILENAME'];
			file_put_contents($path_and_file_name, $pdf_content);
			echo "ADDED";
		}
	}

	function generate($ID) {
		$this->load->model('Internship_model');
		$this->load->model('Teacher_model');
		$this->load->model('Student_model');
		$this->load->model('Program_model');
		$this->load->model('Employer_model');
		$this->load->model('Block_model');

		if (isset($_POST) && count($_POST) > 1) {
			// die(var_dump($this->input->post()));
			$stages = $this->input->post("BLOCK_ID");
			$img64_blank = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMgAAABkCAQAAABpj7eAAAAAo0lEQVR42u3RQQ0AAAjEMM6/Yl5gg5BOwprp0qECBIiAABEQIAICRECACIiAABEQIAICRECACIiAABEQIAICRECACIiAABEQIAICRECACIiAABEQIAICRECACIiAABEQIAICRECACIiAABEQIAICRECACIiAABEQIAICRECACIiAABEQIAICRECACIiAABEQIAICRECACAgQE4AICBABASIg31twg8VFyIKmogAAAABJRU5ErkJggg==";

            if ($stages != null) {
    			foreach ($stages as $stageid) {
    				$data['letter'] = $this->Lettergenerator_model->get_letter($ID);

    				$stage_id = $this->Block_model->get_block_internship_id($stageid);

    				$width_in_mm = 8.5 * 25.4;
    				$height_in_mm = 11 * 25.4;
    				//$html2pdf = new htmltopdf('P', 'letter');
					$html2pdf = new DOMPDF();
					$html2pdf->setPaper("Letter", "portrait");

    				$content = $data['letter']["CONTENT"];
    				$original_content = $content;
    				$content = str_replace("<body", "<page", $content);
    				$content = str_replace("</body>", "</page>", $content);
    				// die($content);

    				$stage = $this->Internship_model->get_internship($stage_id);
    				$program = $this->Program_model->get_program($stage['PROGRAM_ID']);
    				$teacher = $this->Teacher_model->get_teacher($stage['TEACHER_ID']);
    				$student = $this->Student_model->get_student($stage['STUDENT_ID']);
    				$employeur = $this->Employer_model->get_employer($stage['EMPLOYER_ID']);
    				$contact = $this->Employer_model->get_employer_contact($stage["EMPLOYER_CONTACT_ID"]);

    				$employeur["CONTACT_NAME"] = $contact["CONTACT_NAME"];
    				$employeur["PHONE"] = $contact["CONTACT_PHONE"];
    				$employeur["EMAIL"] = $contact["CONTACT_EMAIL"];

    				$blocks = $this->Block_model->get_block_letter($stage_id);
    				$block = $this->Block_model->get_block($stageid);
    				//die(var_dump($blocks));
    				$blocks_count = count($blocks);

    				/*
    				if( $blocks_count > 0){
    					$bloc1       = $blocks[0];
    				}
    				else { $bloc1["DATE_DEBUT"] = "";$bloc1["DATE_FIN"] = "";$bloc1["HORAIRE"] = ""; }

    				if( $blocks_count > 1){
    					$bloc2       = $blocks[1];
    				}
    				else { $bloc2["DATE_DEBUT"] = "";$bloc2["DATE_FIN"] = "";$bloc2["HORAIRE"] = ""; }

    				if( $blocks_count > 2){
    					$bloc3       = $blocks[2];
    				}
    				else { $bloc3["DATE_DEBUT"] = "";$bloc3["DATE_FIN"] = "";$bloc3["HORAIRE"] = ""; }

    				if( $blocks_count > 3){
    					$bloc4       = $blocks[3];
    				}
    				else { $bloc4["DATE_DEBUT"] = "";$bloc4["DATE_FIN"] = "";$bloc4["HORAIRE"] = ""; }
    				*/

    				/* SET PAVILION VARIABLE */
    				switch ($program["PAVILION"]) {
    					case "AUGER":
    						$pavilion_address = "1550, boul. Auger Ouest";
    						$pavilion_postal_code = "G8C 1H8";
    						break;

    					case "BEGIN":
    						$pavilion_address = "850, av. Bégin Sud";
    						$pavilion_postal_code = "G8B 5W2";
    						break;

    					case "SANTE":
    						$pavilion_address = "685, rue Gauthier Ouest";
    						$pavilion_postal_code = "G8B 2H9";
    						break;

    					case "TANGUAY":
    						$pavilion_address = "855, rue Tanguay";
    						$pavilion_postal_code = "G8B 5Y2";
    						break;

    					default:
    						$pavilion_address = "";
    						$pavilion_postal_code = "";
    						break;
    				}

    				/*
    					echo $pavilion_address;
    					echo "<br>";
    					echo $pavilion_postal_code;
    					echo "<br>";
    					die(var_dump($program));
    				*/
    				preg_match_all('/{(.*?)}/', $content, $matches);

    				foreach ($matches[0] as $tag) {
    					$fixtag = str_replace("{", "", $tag);
    					$fixtag = str_replace("}", "", $fixtag);
    					$fixtag = explode(".", $fixtag);
    					switch ($fixtag[0]) {
    						case "DATE":
    							$content = str_replace($tag, date("Y-m-d"), $content);
    							break;
    						case "PAVILION_ADDRESS":
    							$content = str_replace($tag, $pavilion_address, $content);
    							break;
    						case "PAVILION_POSTAL_CODE":
    							$content = str_replace($tag, $pavilion_postal_code, $content);
    							break;
    						case "EMPLOYEUR":
    							$content = str_replace($tag, $employeur[$fixtag[1]], $content);
    							break;
    						case "PROGRAMME":
    							$content = str_replace($tag, $program[$fixtag[1]], $content);
    							break;
    						case "ENSEIGNANT":
    							$content = str_replace($tag, $teacher[$fixtag[1]], $content);
    							break;
    						case "ETUDIANT":

    							$content = str_replace($tag, $student[$fixtag[1]], $content);
    							break;
    						case "STAGE":
    							if ($fixtag[1] == "SCHEDULE") {
    								$schedule = $this->printSchedule($stage["ID"], $stageid);
    								$content = str_replace($tag, $schedule, $content);
    							}
    							if ($fixtag[1] == "DATE_START") {
    								$content = str_replace($tag, $block[$fixtag[1]], $content);
    							}
    							if ($fixtag[1] == "DATE_END") {
    								$content = str_replace($tag, $block[$fixtag[1]], $content);
    							}
    							$content = str_replace($tag, $stage[$fixtag[1]], $content);

    							break;
    						/*
    						case "BLOC1":
    							$content = str_replace($tag,$bloc1[$fixtag[1]],$content);
    							break;
    						case "BLOC2":
    							$content = str_replace($tag,$bloc2[$fixtag[1]],$content);
    							break;
    						case "BLOC3":
    							$content = str_replace($tag,$bloc3[$fixtag[1]],$content);
    							break;
    						case "BLOC4":
    							$content = str_replace($tag,$bloc4[$fixtag[1]],$content);
    							break;
    						*/
    						case "LOGO":
    							//$content = str_replace($tag, "<img src='" . base_url() . "resources/img/logo_gestage.png' width='130'>", $content);
								$img = base64_encode(file_get_contents("./resources/img/logo_gestage.png"));
								$content = str_replace($tag, "<img src='data:image/png;base64,$img' width='130'>", $content);
    							break;
    						case "SIGNATURE_ELEVE":
    							$content = str_replace($tag, "", $content);
    							break;
    						case "SIGNATURE_ENSEIGNANT":
    							$content = str_replace($tag, "", $content);
    							break;

    						case "SIGNATURE_EMPLOYEUR":
    							$content = str_replace($tag, "", $content);
    							break;
    					}
    				}
    				//$data['content'] = $content;

    				/*$html2pdf->writeHTML($content);

    				$pdf_content = $html2pdf->output('', 'S');*/
					$html2pdf->loadHtml($content);
					$html2pdf->render();
					$pdf_content = $html2pdf->output();

    				$path_and_file_name = "resources/tmp/$stage_id - {$data['letter']['NAME']} - {$block["ID"]} - " . date("Y-m-d") . ".pdf";
    				file_put_contents($path_and_file_name, $pdf_content);

    				echo "<script type='text/javascript'>";
    				echo "window.open(\"/$path_and_file_name\");";
    				echo "</script>";

    				// DEPOT DE DOCUMENT
    				if ($this->input->post("depot")) {
    					$block_data = $this->Block_model->get_block_where(array('ID' => $stageid));
    					$real_stageid = $block_data->INTERNSHIP_ID;

    					if (!is_dir('resources/uploads/' . $real_stageid)) {
    						mkdir('resources/uploads/' . $real_stageid);
    					}

    					$path_and_file_name = "resources/uploads/" . $real_stageid . "/" . $data['letter']['NAME'] . " - " . $block["ID"] . " - " . date("Y-m-d H-i-s") . ".pdf";

    					file_put_contents($path_and_file_name, $pdf_content);

    					/* DOCUMENT PERMISSIONS AND ADD SECTION */
    					if ($this->input->post("ck_CANSEE_EMPLOYERS") == 'on') {
    						$can_see_employer = 1;
    					} else {
    						$can_see_employer = 0;
    					}

    					if ($this->input->post("ck_CANSEE_STUDENTS") == 'on') {
    						$can_see_student = 1;
    					} else {
    						$can_see_student = 0;
    					}

    					$can_see_teacher = 1;

    					$documentid = insert_upload_entry($real_stageid, $path_and_file_name, $can_see_student, $can_see_teacher, $can_see_employer, $block["ID"], 0, $ID);

    					/* END DOCUMENT PERMISSIONS AND ADD SECTION */

    					/* OBLIGATION ADD SECTION */
    					$add_obligation_signature_employer = 0;
    					$add_obligation_signature_student = 0;
    					$add_obligation_signature_teacher = 0;

    					if ($this->input->post("ck_OBLIGATION_EMPLOYERS") == 'on') {
    						$add_obligation_employer = 1;
    						if (strpos($original_content, 'SIGNATURE_EMPLOYEUR') !== false) {
    							$add_obligation_signature_employer = 1;
    						} else {
    							$add_obligation_signature_employer = 0;
    						}
    					}

    					if ($this->input->post("ck_OBLIGATION_EMPLOYERS") != 'on') {
    						$add_obligation_employer = 0;
    					}

    					if ($this->input->post("ck_OBLIGATION_STUDENTS") == 'on') {
    						$add_obligation_student = 1;

    						if (strpos($original_content, 'SIGNATURE_ELEVE') !== false) {
    							$add_obligation_signature_student = 1;
    						} else {
    							$add_obligation_signature_student = 0;
    						}
    					}

    					if ($this->input->post("ck_OBLIGATION_STUDENTS") != 'on') {
    						$add_obligation_student = 0;
    					}

    					if ($this->input->post("ck_OBLIGATION_TEACHERS") == 'on') {
    						$add_obligation_teacher = 1;

    						if (strpos($original_content, 'SIGNATURE_ENSEIGNANT') !== false) {
    							$add_obligation_signature_teacher = 1;
    						} else {
    							$add_obligation_signature_teacher = 0;
    						}
    					}

    					if ($this->input->post("ck_OBLIGATION_TEACHERS") != 'on') {
    						$add_obligation_teacher = 0;
    					}

    					if ($add_obligation_employer == 1 || $add_obligation_student == 1 || $add_obligation_teacher == 1) {
    						insert_obligations_entry($real_stageid, $documentid, $add_obligation_student, $add_obligation_teacher, $add_obligation_employer, $add_obligation_signature_student, $add_obligation_signature_teacher, $add_obligation_signature_employer);
    					}
    					/* END OBLIGATION ADD SECTION */
    				}

    				unset($pdf);
    			}
            }

			//   /* SI ON DEMANDE DE DÉPOSER UNE COPIE DANS LES DOCUMENTS DU STAGE */
			//   if ($this->input->post("depot")) {
			//       $this->pdf->render();
			//       $output = $this->pdf->stream($data['letter']["NAME"]);
			//       $output_file = $this->pdf->output();
			//       $path_and_file_name = "resources/uploads/". $stageid . "/" . $data['letter']['NAME'] . ".pdf";

			//       file_put_contents($path_and_file_name, $output_file);

			//       insert_upload_entry($stageid, $path_and_file_name, 1, 1, 1);
			//   } else {
			//       $this->pdf->render();
			//   	    $this->pdf->stream($data['letter']["NAME"]);
			//   }
		}

		$data['stages'] = $this->Internship_model->get_letters_generator_internships($this->session->userdata['userid']);
		$data['letter'] = $this->Lettergenerator_model->get_letter($ID);
		$data['_view'] = 'lettergenerator/generate';
		$this->load->view('layouts/main', $data);
	}

	function printSchedule($internship_id, $block_id) {
		$schedule_content = "";

		$schedules = $this->Block_model->get_all_block_schedules_where(array("INTERNSHIP_ID" => $internship_id, "BLOCK_ID" => $block_id));
		$block = $this->Block_model->get_block($block_id);

		$block_schedule_total_hours = 0;
		$block_schedule_total_absences = 0;
		$block_schedules = $this->Block_model->get_block_schedules($block["ID"]);
		foreach ($block_schedules as $block_schedule) {
			$block_schedule_value = json_decode($block_schedule["VALUE"]);
			if (is_numeric($block_schedule_value->TOTAL)) {
				$block_schedule_total_hours += $block_schedule_value->TOTAL;
			}
			if ((!isset($block_schedule_value->PRESENT)) && (!isset($block_schedule_value->CLOSED))) {
				$block_schedule_total_hours += $block_schedule_value->TOTAL;
				$block_schedule_total_absences += 1;
			}
		}
		$block["SCHEDULE_TOTAL_HOURS"] = sprintf("%.2f", $block_schedule_total_hours);

		$schedule_content .= "<h5 style='text-align:center;'><br>" . mb_strtoupper(date_in_french($block["DATE_START"]));
		$schedule_content .= " - " . mb_strtoupper(date_in_french($block["DATE_END"]));
		$schedule_content .= "<br><br> NOMBRE D'HEURES À FAIRE : " . $block["SCHEDULE_TOTAL_HOURS"];
		$schedule_content .= "<br> NOMBRE D'HEURES ATTRIBUÉES AU STAGE : " . $block["TOTAL_HOURS"];
		$schedule_content .= " <br><br> STAGE #" . $internship_id . " | " . mb_strtoupper($block["NAME"]) . "</h5>";

		ob_start();
		var_dump($schedules);
		$result = ob_get_clean();
		$night = 0;
		if (strpos($result, 'FROM_EV') !== false) {
			$night = 1;
		}

		if ($night == 0) {
			$schedule_content .= '<table style="margin-left:30px;" class="mce-item-table" border="1">
				<thead style="background-color:black;border:unset !important;">
				<tr>
				<th style="text-align:center;width:100px;border:unset !important;background-color:black;background-color:black;color:white;"></th>
				<th style="text-align:center;width:100px;border:unset !important;background-color:black;color:white;">DE</th>
				<th style="text-align:center;width:100px;border:unset !important;background-color:black;color:white;">À</th>
				<th style="text-align:center;width:100px;border:unset !important;background-color:black;color:white;">DE</th>
				<th style="text-align:center;width:100px;border:unset !important;background-color:black;color:white;">À</th>
				<th style="text-align:center;width:100px;border:unset !important;background-color:black;color:white;">TOTAL</th> </tr>
				</thead><tbody>';

			foreach ($schedules as $schedule) {
				$schedule["VALUE"] = json_decode($schedule["VALUE"]);
				if (!isset($schedule["VALUE"]->CLOSED)) {
					$schedule_content .= '<tr>
						<td style="text-align:center;width:100px;">' . $schedule["VALUE"]->DATE . '</td>
						<td style="text-align:center;width:100px;">' . $schedule["VALUE"]->FROM_AM . '</td>
						<td style="text-align:center;width:100px;">' . $schedule["VALUE"]->TO_AM . '</td>
						<td style="text-align:center;width:100px;">' . $schedule["VALUE"]->FROM_PM . '</td>
						<td style="text-align:center;width:100px;">' . $schedule["VALUE"]->TO_PM . '</td>
						<td style="text-align:center;width:100px;">' . $schedule["VALUE"]->TOTAL . '</td>
						</tr>';
				} else {
					$schedule_content .= '<tr>
						<td style="text-align:center;width:100px;">' . $schedule["VALUE"]->DATE . '</td>
						<td style="text-align:center;width:100px;background-color:gray;"></td>
						<td style="text-align:center;width:100px;background-color:gray;"></td>
						<td style="text-align:center;width:100px;background-color:gray;"></td>
						<td style="text-align:center;width:100px;background-color:gray;"></td>
						<td style="text-align:center;width:100px;background-color:gray;"></td>
						</tr>';
				}
			}

			$schedule_content .= '</tbody></table>';
			return $schedule_content;
		} else {
			$schedule_content .= '<table style="margin-left:30px;" class="mce-item-table" border=1>
				<thead style="background-color:black;border:unset !important;">
				<tr>
				<th style="text-align:center;width:75px;border:unset !important;background-color:black;background-color:black;color:white;"></th>
				<th style="text-align:center;width:75px;border:unset !important;background-color:black;color:white;">DE</th>
				<th style="text-align:center;width:75px;border:unset !important;background-color:black;color:white;">À</th>
				<th style="text-align:center;width:75px;border:unset !important;background-color:black;color:white;">DE</th>
				<th style="text-align:center;width:75px;border:unset !important;background-color:black;color:white;">À</th>
				<th style="text-align:center;width:75px;border:unset !important;background-color:black;color:white;">DE</th>
				<th style="text-align:center;width:75px;border:unset !important;background-color:black;color:white;">À</th>
				<th style="text-align:center;width:75px;border:unset !important;background-color:black;color:white;">TOTAL</th> </tr>
				</thead><tbody>';

			foreach ($schedules as $schedule) {
				$schedule["VALUE"] = json_decode($schedule["VALUE"]);
				if (!isset($schedule["VALUE"]->CLOSED)) {
					$schedule_content .= '<tr>
						<td style="text-align:center;width:75px;">' . $schedule["VALUE"]->DATE . '</td>
						<td style="text-align:center;width:75px;">' . $schedule["VALUE"]->FROM_AM . '</td>
						<td style="text-align:center;width:75px;">' . $schedule["VALUE"]->TO_AM . '</td>
						<td style="text-align:center;width:75px;">' . $schedule["VALUE"]->FROM_PM . '</td>
						<td style="text-align:center;width:75px;">' . $schedule["VALUE"]->TO_PM . '</td>
						<td style="text-align:center;width:75px;">' . @$schedule["VALUE"]->FROM_EV . '</td>
						<td style="text-align:center;width:75px;">' . @$schedule["VALUE"]->TO_EV . '</td>
						<td style="text-align:center;width:75px;">' . $schedule["VALUE"]->TOTAL . '</td>
						</tr>';
				} else {
					$schedule_content .= '<tr>
						<td style="text-align:center;width:75px;">' . $schedule["VALUE"]->DATE . '</td>
						<td style="text-align:center;width:75px;background-color:gray;"></td>
						<td style="text-align:center;width:75px;background-color:gray;"></td>
						<td style="text-align:center;width:75px;background-color:gray;"></td>
						<td style="text-align:center;width:75px;background-color:gray;"></td>
						<td style="text-align:center;width:75px;background-color:gray;"></td>
						<td style="text-align:center;width:75px;background-color:gray;"></td>
						<td style="text-align:center;width:75px;background-color:gray;"></td>
						</tr>';
				}
			}

			$schedule_content .= '</tbody></table>';
			return $schedule_content;
		}

		return "";
	}

	function edit($ID) {
		//die(var_dump($this->session->userdata()));
		// check if the internship exists before trying to edit it
		$data['lettergenerator'] = $this->Lettergenerator_model->get_letter($ID);

		if (isset($data['lettergenerator']['ID'])) {
			if (isset($_POST) && count($_POST) > 0) {
				$params = array(
					'NAME' => $this->input->post('NAME'),
					'DESC' => $this->input->post('DESC'),
					'CONTENT' => $this->input->post('CONTENT'),
					'PROGRAM_ID' => $this->input->post('PROGRAM_ID'),
				);

				$this->Lettergenerator_model->update_letter($ID, $params);
				redirect('lettergenerator/index');
			} else {
				$data['program_fields'] = $this->db->list_fields('PROGRAMS');
				$data['eleve_fields'] = $this->db->list_fields('STUDENTS');
				$data['stage_fields'] = $this->db->list_fields('INTERNSHIPS');
				$data['employeur_fields'] = $this->db->list_fields('EMPLOYERS');
				$data['teacher_fields'] = $this->db->list_fields('TEACHERS');

				$data['block_fields'] = array("BLOC1.DATE_DEBUT", "BLOC2.DATE_DEBUT", "BLOC3.DATE_DEBUT", "BLOC4.DATE_DEBUT", "BLOC1.DATE_FIN", "BLOC2.DATE_FIN", "BLOC3.DATE_FIN", "BLOC4.DATE_FIN", "BLOC1.HORAIRE", "BLOC2.HORAIRE", "BLOC3.HORAIRE", "BLOC4.HORAIRE");
				$data["all_programs"] = $this->Teacher_model->get_all_teacher_programs();
				$data['_view'] = 'lettergenerator/edit';
				$this->load->view('layouts/main', $data);
			}
		} else {
			show_error('The internship you are trying to edit does not exist.');
		}
	}

	function remove($ID) {
		$letter = $this->Lettergenerator_model->get_letter($ID);

		// check if the document exists before trying to delete it
		if (isset($letter['ID'])) {
			$this->Lettergenerator_model->delete_letter($ID);
			redirect('lettergenerator/index');
		} else {
			show_error('');
		}
	}
}
