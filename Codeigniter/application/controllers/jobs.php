<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jobs extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('twig');
		$this->load->helper('htmlpurifier');
		$this->load->database(); // could be auto-loaded, but not every page needs the database
		// $this->load->helper("url"); // is implied by loading twig
	}

	public function index() {
		$this->list_jobs();
	}

	public function list_jobs($job_types = "all") {
		$this->db->select("id,title,tagline");
		$search_term = $this->input->post('search_term');

		if ($search_term !== false)
		{
			$this->db->where("MATCH (tagline, description, title) AGAINST ('" .
					mysql_real_escape_string($search_term) . "')", null, false);
		}

		$this->db->where("approved", "YES");
		$this->db->order_by("post_date", "desc");
		if ($job_types != "all") {
			$this->db->where("type", $job_types);
		}
		$job_query = $this->db->get("jobs");

		if ($job_query->num_rows() > 0)
		{
			// now for the big hairy keyword query
			$this->db->select("job_id,keyword");
			
			$rows = array();
			foreach ($job_query->result_array() as $result)
			{
				$row = $result;
				$rows[$row['id']] = $row;
				$this->db->or_where("job_id", $row['id']);
			}

			$keyword_query = $this->db->get("job_keywords");

			foreach ($keyword_query->result_array() as $result)
			{
				$id = $result['job_id'];
				$rows[$id]['keywords'] []= $result['keyword'];
			}

			$data = array(
				"jobs" => &$rows,
				"job_count" => count($rows),
				"type" => &$job_types
			);

			if ($search_term !== false)
			{
				$data['search_term'] = &$search_term;
			}

			$this->twig->display("job_list.twig.html", $data);
		}
		else
		{
			$this->twig->display("no_results.twig.html");
		}
	}

	public function list_filter() {
		redirect(site_url("jobs/list_jobs/" . $this->input->post('type')), 'location');
		return;
	}

	public function search() {
		
	}

	public function view($job_id) {
		$this->db->select("*");
		$this->db->where("id", $job_id);
		$job_query = $this->db->get("jobs");

		$data = array();

		if ($job_query->num_rows() == 1)
		{
			$this->db->select("job_id,keyword");
			$this->db->where("job_id", $job_id);
			$keyword_query = $this->db->get("job_keywords");

			$keywords = array();
			foreach ($keyword_query->result_array() as $result)
			{
				$keywords []= $result['keyword'];
			}

			$job = $job_query->row_array();

			$job['keywords'] = &$keywords;

			$data['job'] = &$job;
			$data["breadcrumbs"] = array(
				array ("name" => "Home",				"url" => site_url()),
				array ("name" => "Job #" . $job['id'],	"url" => "")
			);

			$this->twig->display("job_listing.twig.html", $data);
		}
		else
		{
			$data["breadcrumbs"] = array(
				array ("name" => "Home",		"url" => site_url()),
				array ("name" => "Not Found",	"url" => "")
			);

			$this->twig->display("no_results.twig.html", $data);
		}
	}

	public function post() {
		$data = array();
		$data["breadcrumbs"] = array(
			array ("name" => "Home",		"url" => site_url()),
			array ("name" => "Post a Job",	"url" => "")
		);

		$this->twig->display("post.twig.html", $data);
	}

	public function post_action() {
		$data = array();
		$data['last'] = $_POST;

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('poster_name', 'Your name', 'required');
		$this->form_validation->set_rules('poster_company', 'Your company', 'required');
		$this->form_validation->set_rules('poster_email', 'Your email', 'required|valid_email');
		$this->form_validation->set_rules('poster_location', 'Job location', 'required');

		$this->form_validation->set_rules('keywords', 'Keywords', 'required');
		$this->form_validation->set_rules('title', 'Job title', 'required');
		$this->form_validation->set_rules('tagline', 'Tagline', 'required|max_length[140]');
		$this->form_validation->set_rules('description', 'Description', 'required');

		$this->form_validation->set_rules('verify', 'Verification', 'required');

		if ($this->form_validation->run() === false)
		{
			$data['errors'] = validation_errors("<li>", "</li>");
			$data["breadcrumbs"] = array(
				array ("name" => "Home",		"url" => site_url()),
				array ("name" => "Post a Job",	"url" => "")
			);

			$this->twig->display("post.twig.html", $data);
		}
		else
		{
			$job_record = array(
				"approved" => "NO",
				"post_date" => date("Y-m-d H:i:s"),
				"poster_name" => html_purify($this->input->post("poster_name")),
				"poster_company" => html_purify($this->input->post("poster_company")),
				"poster_email" => html_purify($this->input->post("poster_email")),
				"poster_location" => html_purify($this->input->post("poster_location")),
				"type" => html_purify($this->input->post("type")),
				"title" => html_purify($this->input->post("title")),
				"tagline" => html_purify($this->input->post("tagline")),
				"description" => html_purify($this->input->post("description"))
			);

			// personally I prefer PDO, but setting up PDO would have taken too long
			$this->db->insert('jobs', $job_record);

			$job_id = $this->db->insert_id();

			$keywords = explode(',', $this->input->post("keywords"));
			foreach ($keywords as $keyword)
			{
				$keyword_record = array(
					"job_id" => $job_id,
					"keyword" => html_purify(trim($keyword))
				);
				$this->db->insert('job_keywords', $keyword_record);
			}

			$data["breadcrumbs"] = array(
				array ("name" => "Home",					"url" => site_url()),
				array ("name" => "Successfully posted!",	"url" => "")
			);
			$this->twig->display("post_successful.twig.html", $data);
		}
	}
}