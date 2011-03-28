<?php

/**
 * jobs actions.
 *
 * @package    JobBoard
 * @subpackage jobs
 * @author     Your name here
 */
class jobsActions extends sfActions
{
  public function executeActivate(sfWebRequest $request) {
    $token = $request->getParameter("token");
    $this->forward404Unless( $job = JobPeer::getWithToken($token) );
    $job->setIsActivated(true);
    $job->save();
    $this->job = $job;
  }
  
  public function executeIndex(sfWebRequest $request)
  {
    $this->categories = CategoryPeer::doSelect(new Criteria());
    
    $tag = $request->getParameter('tag');
    if($tag != null) {
      $this->Jobs = JobPeer::getWithTag($tag);
    } elseif($category_id = $request->getParameter('category_id')) {
      $this->Jobs = JobPeer::getWithCategory($category_id);
    } else {
      $this->Jobs = JobPeer::doSelect(new Criteria());      
    }
  }
  
  public function executeSearch(sfWebRequest $request) {
    $terms = $request->getParameter('q');
    $this->Jobs = JobPeer::searchTerms($terms);
    $this->setTemplate('index');
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->Job = JobPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->Job);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new JobForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new JobForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($Job = JobPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Job does not exist (%s).', $request->getParameter('id')));
    $this->form = new JobForm($Job);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($Job = JobPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Job does not exist (%s).', $request->getParameter('id')));
    $this->form = new JobForm($Job);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($Job = JobPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Job does not exist (%s).', $request->getParameter('id')));
    $Job->delete();

    $this->redirect('jobs/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $Job = $form->save();

      $this->redirect('jobs/edit?id='.$Job->getId());
    }
  }
}
