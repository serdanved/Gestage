<?php
class Pdf_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function get_all_pdf() {
        return $this->db->select("DOCUMENT_PDF_PROG.*, PROGRAMS.NAME as PROG_NAME")
            ->join("PROGRAMS", "PROGRAMS.ID = PROG_ID", "left")
            ->get("DOCUMENT_PDF_PROG")
            ->result_array();
    }

    function get_all_prog_pdf($progId) {
        return $this->db->where("PROG_ID", $progId)
            ->select("DOCUMENT_PDF_PROG.*, PROGRAMS.NAME as PROG_NAME")
            ->join("PROGRAMS", "PROGRAMS.ID = PROG_ID", "left")
            ->get("DOCUMENT_PDF_PROG")
            ->result_array();
    }

    function get_prog_pdf_type($progId, $type) {
        return $this->db->where("PROG_ID", $progId)
            ->where("TYPE", $type)
            ->select("DOCUMENT_PDF_PROG.*, PROGRAMS.NAME as PROG_NAME")
            ->join("PROGRAMS", "PROGRAMS.ID = PROG_ID", "left")
            ->get("DOCUMENT_PDF_PROG")
            ->result_array();
    }

    function get_pdf($id) {
        return $this->db->where("ID", $id)
            ->select("DOCUMENT_PDF_PROG.*, PROGRAMS.NAME as PROG_NAME")
            ->join("PROGRAMS", "PROGRAMS.ID = PROG_ID", "left")
            ->get("DOCUMENT_PDF_PROG")
            ->row_array();
    }

    function add_pdf($params) {
        $this->db->insert("DOCUMENT_PDF_PROG", $params);
        return $this->db->insert_id();
    }

    function delete_pdf($id) {
        return $this->db->delete("DOCUMENT_PDF_PROG", array("ID" => $id));
    }

    function get_stage_pdf($docId) {
        return $this->db->where("ID", $docId)
            ->get("DOCUMENT_PDF_STAGE")
            ->row_array();
    }

    function get_all_stage_pdf($stageId) {
        return $this->db->where("STAGE_ID", $stageId)
            ->get("DOCUMENT_PDF_STAGE")
            ->result_array();
    }

    function add_stage_pdf($params) {
        $this->db->insert("DOCUMENT_PDF_STAGE", $params);
        return $this->db->insert_id();
    }

    function add_default_pdf_to_stage($stageId) {
        $addedIds = array();
        $progId = $this->db->select("PROGRAM_ID")
            ->where("ID", $stageId)
            ->get("INTERNSHIPS")
            ->row_array()["PROGRAM_ID"];

        $docs = $this->get_all_prog_pdf($progId);
        foreach ($docs as $D) {
            $addedIds[] = array(
                "new" => $this->add_stage_pdf(array(
                    "STAGE_ID" => $stageId,
                    "NAME" => $D["NAME"],
                    "TYPE" => $D["TYPE"],
                )),
                "default" => $D["ID"],
            );
        }

        return $addedIds;
    }

    function delete_stage_pdf($docId) {
        return $this->db->where("ID", $docId)->delete("DOCUMENT_PDF_STAGE");
    }
}