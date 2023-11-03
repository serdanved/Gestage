<?php

class Report extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("Internship_model");
		$this->load->model("Employer_model");
		$this->load->model("Document_model");
	}

	function index() {
		$programs = $this->Teacher_model->get_program_by_teacher_id_select($this->session->userid);
		$program_ids = array();
		$data["programs"] = array(0 => "Tous les programmes");
		foreach ($programs as $P) {
			$program_ids[] = $P["ID"];
			$data["programs"][$P["ID"]] = $P["NAME"];
		}

		$students = $this->Student_model->get_all_students_from_program_ids($program_ids);
		$data["students"] = array(0 => "Tous les élèves");
		foreach ($students as $S) {
			$data["students"][$S["ID"]] = $S["NAME"];
		}

		$employers = $this->Employer_model->get_all_employers();
		$data["employers"] = array(0 => "Tous les employeurs");
		foreach ($employers as $E) {
			$data["employers"][$E["ID"]] = $E["EMPLOYER_NAME"];
		}

		$cities = $this->Employer_model->list_cities();
		$data["cities"] = array(-1 => "Toutes les villes");
		foreach ($cities as $key => $value) {
			$data["cities"][$key] = $value["CITY"];
		}

		$cats = $this->Employer_model->get_all_categories();
		$data["cats"] = array(0 => "Toutes les catégories");
		foreach ($cats as $c) {
			$data["cats"][$c["ID"]] = $c["NAME"];
		}

		$data["_view"] = "report/index";
		$this->load->view("layouts/main", $data);
	}

	public function generateXls() {
		// load excel library
		$this->load->library('excel');

		PHPExcel_Settings::setLocale("fr_ca");

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);

		$objDrawing = new PHPExcel_Worksheet_Drawing();
		$objDrawing->setName('logo');
		$objDrawing->setDescription('logo');
		$objDrawing->setPath(dirname(__FILE__) . "/../../resources/img/logo_gestage.png");
		$objDrawing->setCoordinates('E1');
		//setOffsetX works properly
		$objDrawing->setOffsetX(5);
		$objDrawing->setOffsetY(5);
		//set width, height
		$objDrawing->setWidth(100);
		$objDrawing->setHeight(35);
		$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

		$filename = "";

		if ($this->input->post("REPORT_TYPE") == 1) { //Liste des stages entre 2 dates
			$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Liste des stages en date du ' . date("Y-m-d"));
			$objPHPExcel->getActiveSheet()->mergeCells('A1:B1');

			if ($this->input->post("DATE_DEBUT") != null && $this->input->post("DATE_FIN") != null) {
				$objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Liste des stages entre ' . $this->input->post("DATE_DEBUT") . ' et ' . $this->input->post("DATE_FIN"));
				$objPHPExcel->getActiveSheet()->mergeCells('A2:B2');
			}

			// set Header
			$objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Étudiant');
			$objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Employeur');
			$objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Programme');
			$objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Date Début');
			$objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Date Fin');

			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);

			// set Row
			$rowCount = 5;
			$internships = $this->Internship_model->get_interships_for_report($this->input->post("STUDENTS"), $this->input->post("EMPLOYERS"), $this->input->post("PROGRAMS"), $this->input->post("DATE_DEBUT"), $this->input->post("DATE_FIN"));
			foreach ($internships[0] as $I) {
				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $I["STUDENT_NAME"]);
				$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $I["EMPLOYER_NAME"]);
				$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $I["PROGRAM"]);
				$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $I["DATE_START"]);
				$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $I["DATE_END"]);
				$rowCount++;
			}

			$filename = "stages-" . date("Y-m-d-H-i-s") . ".xlsx";
		}
		if ($this->input->post("REPORT_TYPE") == 2) { //Liste des Employeurs
			$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Liste des employeurs de stage en date du ' . date("Y-m-d"));
			$objPHPExcel->getActiveSheet()->mergeCells('A1:B1');

			if ($this->input->post("DATE_DEBUT") != null && $this->input->post("DATE_FIN") != null) {
				$objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Liste des stages entre ' . $this->input->post("DATE_DEBUT") . ' et ' . $this->input->post("DATE_FIN"));
				$objPHPExcel->getActiveSheet()->mergeCells('A2:B2');
			}

			// set Header
			$objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Employeur');
			$objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Nom Contact');
			$objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Email Contact');
			$objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Date Début');
			$objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Date Fin');

			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);

			// set Row
			$rowCount = 5;
			$internships = $this->Internship_model->get_interships_for_report(
				$this->input->post("STUDENTS"),
				$this->input->post("EMPLOYERS"),
				$this->input->post("PROGRAMS"),
				$this->input->post("DATE_DEBUT"),
				$this->input->post("DATE_FIN"),
				$this->input->post("CITIES"),
				$this->input->post("CATS")
			);
			foreach ($internships[0] as $I) {
				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $I["EMPLOYER_NAME"]);
				$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $I["CONTACT_NAME"]);
				$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $I["CONTACT_EMAIL"]);
				$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $I["DATE_START"]);
				$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $I["DATE_END"]);
				$rowCount++;
			}

			$filename = "employeurs-" . date("Y-m-d-H-i-s") . ".xlsx";
		}
		if ($this->input->post("REPORT_TYPE") == 3) { //Publipostage Employeur
			$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Liste de tous les Employeurs avec leurs Contact(s)');
			$objPHPExcel->getActiveSheet()->mergeCells('A1:B1');

			// set Header
			$objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Employeur');
			$objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Adresse');
			$objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Ville');
			$objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Province');
			$objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Pays');
			$objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Code Postal');
			$objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Courriel');

			$objPHPExcel->getActiveSheet()->SetCellValue('I4', 'Nom Contact');
			$objPHPExcel->getActiveSheet()->SetCellValue('J4', 'Téléphone Contact');
			$objPHPExcel->getActiveSheet()->SetCellValue('K4', 'Courriel Contact');

			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);

			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);

			// set Row
			$rowCount = 5;
			$employers = $this->Employer_model->get_employers_for_report($this->input->post("PROGRAMS"), $this->input->post("REPORT_TYPE") == "3");
			foreach ($employers as $e) {
				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $e["EMPLOYER_NAME"]);
				$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $e["ADDRESS"]);
				$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $e["CITY"]);
				$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $e["PROVINCE"]);
				$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $e["COUNTRY"]);
				$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $e["POSTAL_CODE"]);
				$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $e["EMAIL"]);

				if (is_array($e["CONTACTS"]) && count($e["CONTACTS"]) > 0) {
					foreach ($e["CONTACTS"] as $c) {
						$objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $c["CONTACT_NAME"]);
						$objPHPExcel->getActiveSheet()->getCell('J' . $rowCount)->setValueExplicit($c["CONTACT_PHONE"], PHPExcel_Cell_DataType::TYPE_STRING);
						$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $c["CONTACT_EMAIL"]);
						$rowCount++;
					}
				} else {
					$rowCount++;
				}
			}

			$filename = "employeurs-contacts.xlsx";
		}
		if ($this->input->post("REPORT_TYPE") == 4) { //Liste des Protocoles entre 2 dates
			$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Liste des protocoles en date du ' . date("Y-m-d"));
			$objPHPExcel->getActiveSheet()->mergeCells('A1:B1');

			if ($this->input->post("DATE_DEBUT") != null && $this->input->post("DATE_FIN") != null) {
				$objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Liste des protocoles entre ' . $this->input->post("DATE_DEBUT") . ' et ' . $this->input->post("DATE_FIN"));
				$objPHPExcel->getActiveSheet()->mergeCells('A2:B2');
			}

			// set Header
			$objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Nom Document');
			$objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Date');
			$objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Employeur');
			$objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Élève');

			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);

			// set Row
			$rowCount = 5;
			$documents = $this->Document_model->get_protocoles_for_report($this->input->post("DATE_DEBUT"), $this->input->post("DATE_FIN"), $this->input->post("PROGRAMS"));
			foreach ($documents[0] as $d) {
				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $d["NAME"]);
				$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $d["DATE"]);
				$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $d["EMPLOYER_NAME"]);
				$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $d["STUDENT_NAME"]);
				$rowCount++;
			}

			$filename = "protocoles-" . date("Y-m-d-H-i-s") . ".xlsx";
		}
		if ($this->input->post("REPORT_TYPE") == 5) { //Publipostage Employeur simplifié
			$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Liste simplifié des Employeurs');
			$objPHPExcel->getActiveSheet()->mergeCells('A1:B1');

			// set Header
			$objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Employeur');
			$objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Nom Contact');
			$objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Email Contact');

			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);

			// set Row
			$rowCount = 5;
			$employers = $this->Employer_model->get_employers_for_report($this->input->post("PROGRAMS"), $this->input->post("REPORT_TYPE") == "3");
			foreach ($employers as $e) {
				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $e["EMPLOYER_NAME"]);
				$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $e["CONTACT_NAME"]);
				$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $e["EMAIL"]);
				$rowCount++;
			}

			$filename = "employeurs-simplifie.xlsx";
		}

		header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header("Content-Disposition: attachment;filename=\"{$filename}\"");
		header("Cache-Control: max-age=0");
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
	}

	function generatePdf() {
		ini_set('max_execution_time', 1000);
		ini_set('memory_limit', '512M');
		$this->load->library("Pdf");

		$data = [
			"post" => [
				"report_type" => $this->input->post("REPORT_TYPE"),
				"students" => $this->input->post("STUDENTS"),
				"employers" => $this->input->post("EMPLOYERS"),
				"programs" => $this->input->post("PROGRAMS"),
				"date_debut" => $this->input->post("DATE_DEBUT"),
				"date_fin" => $this->input->post("DATE_FIN"),
			],
		];

		//die($data["internships"][1]);

		switch ($this->input->post("REPORT_TYPE")) {
			case "1": //Liste des stages entre 2 dates
				$data["internships"] = $this->Internship_model->get_interships_for_report(
					$this->input->post("STUDENTS"),
					$this->input->post("EMPLOYERS"),
					$this->input->post("PROGRAMS"),
					$this->input->post("DATE_DEBUT"),
					$this->input->post("DATE_FIN")
				);
				$this->pdf->setPaper("Letter", "Portrait");
				$this->pdf->load_view("report/pdf-tables", $data);
				break;
			case "2": //Liste des Employeurs
				$data["internships"] = $this->Internship_model->get_entreprise_for_report(
					$this->input->post("STUDENTS"),
					$this->input->post("EMPLOYERS"),
					$this->input->post("PROGRAMS"),
					$this->input->post("DATE_DEBUT"),
					$this->input->post("DATE_FIN"),
					$this->input->post("CITIES"),
					$this->input->post("CATS")
				);
				$this->pdf->set_paper('Letter', 'Landscape');
				$this->pdf->load_view("report/pdf-tables", $data);
				break;
			case "3": //Publipostage Employeur
				$data["employers"] = $this->Employer_model->get_employers_for_report($this->input->post("PROGRAMS"));
				$this->pdf->setPaper("Letter", "Portrait");
				$this->pdf->load_view("report/pdf-employers", $data);
				break;
			case "4": //Liste des Protocoles entre 2 dates
				$data["documents"] = $this->Document_model->get_protocoles_for_report($this->input->post("DATE_DEBUT"), $this->input->post("DATE_FIN"), $this->input->post("PROGRAMS"));
				$this->pdf->setPaper("Letter", "Portrait");
				$this->pdf->load_view("report/pdf-protocoles", $data);
				break;
			case "5": //Publipostage Employeur simplifié
				$data["employers"] = $this->Employer_model->get_employers_for_report($this->input->post("PROGRAMS"));
				$this->pdf->setPaper("Letter", "Portrait");
				$this->pdf->load_view("report/pdf-simple-employers", $data);
				break;
		}
		$this->pdf->render();
		$this->pdf->stream("report.pdf", array("Attachment" => 0));
	}
}
