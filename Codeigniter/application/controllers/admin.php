<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('twig');
		$this->load->database(); // could be auto-loaded, but not every page needs the database
		// $this->load->helper("url"); // is implied by loading twig
	}

	public function index() {
		$this->list_jobs();
	}
	
	public function list_jobs() {
		$this->db->select("id,title,approved");
		$this->db->order_by("post_date", "desc");
		$query = $this->db->get('jobs');

		$data = array(
			"records" => $query->result_array()
		);

		$this->twig->display("admin_list.twig.html", $data);
	}

	public function approve() {
		$id = $this->input->post('id');

		$this->db->select("id,approved");
		$this->db->where("id", $id);
		$query = $this->db->get("jobs");

		if ($query->num_rows() != 1) { // we horked somewhere (timing/data anomaly), just bail
			redirect(site_url('admin'), 'location');
			return;
		}

		$row = $query->row_array();

		$update_data = array("approved" => ($row['approved'] == "YES" ? "NO" : "YES"));
		
		$this->db->where('id', $id);
		$this->db->update('jobs', $update_data);
		
		redirect(site_url('admin'), 'location');
	}
	public function delete() {
		$id = $this->input->post('id');

		$this->db->where('id', $id);
		$this->db->delete("jobs");

		$this->db->where('job_id', $id);
		$this->db->delete("job_keywords");

		redirect(site_url('admin'), 'location');
	}
}