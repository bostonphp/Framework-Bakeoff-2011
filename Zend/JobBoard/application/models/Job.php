<?php

class Application_Model_Job extends Zend_Db_Table_Abstract
{
	protected $_name = "job_post";

	public function addJob($values){
		$data = array(
					'name' => $values['name'],
					'company' => $values['company'],
					'email' => $values['email'],
					'location' => $values['location'],
					'type' => $values['type'],
					'skills' => implode(', ', $values['skills']),
					'reason' => $values['reason'],
					'title' => $values['title'],
					'description' => $values['description'],
					'is_approved' => 1,
					'date' => date("Y-m-d")); 
		$this->insert($data);
	}

	public function getJob($id)
	{
		$id = (int)$id;
		$row = $this->fetchRow('id = ' . $id);
		if (!$row) {
			throw new Exception("Could not find row $id");
		}
		return $row->toArray();
	}
}
