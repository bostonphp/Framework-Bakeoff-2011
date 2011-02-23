<?php

class IndexController extends Zend_Controller_Action
{
	public function indexAction(){
		$jobs = new Application_Model_Job();
		$this->view->jobs = $jobs->fetchAll('is_approved=1');
	}

	public function addAction(){
		$is_not_spam = $this->getRequest()->getParam('is_not_spam');
		if(!empty($is_not_spam) && $this->getRequest()->isPost()){
			$postData = $this->getRequest()->getPost();
				
			$jobs = new Application_Model_Job();
			$jobs->addJob($postData);

			mail('admin@bostonphp.org', 'Job posting for approval: ' . $postData['title'], $postData['description']);
			
			$this->_forward("success");
		} else {

		}
	}

	public function successAction(){
		 
	}

	public function getAction()
	{
		$id = $this->getRequest()->getParam('id');

		$jobs = new Application_Model_Job();
		$job = $jobs->getJob($id);
		$this->view->job = $job;
	}
}
