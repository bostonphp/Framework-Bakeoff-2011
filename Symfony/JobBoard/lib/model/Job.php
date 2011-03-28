<?php


/**
 * Skeleton subclass for representing a row from the 'jobs' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Tue Feb 22 13:40:48 2011
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */

class Job extends BaseJob {

	/**
	 * Initializes internal state of Job object.
	 * @see        parent::__construct()
	 */
	public function __construct()
	{
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();
	}

  public function save(PropelPDO $con = null)
  {
     if ($this->isNew() && !$this->getExpiresAt())
     {
       $now = $this->getCreatedAt() ? $this->getCreatedAt('U') : time();
       $this->setExpiresAt($now + 86400 * 7);
     }

     if (!$this->getToken())
     {
       $this->setToken(sha1($this->getEmail().rand(11111, 99999)));
       $this->emailAdmin();
     }
     
     $obj = parent::save($con);     
     $this->buildIndex();
     return $obj;
  }
  
  public function delete(PropelPDO $con = null) {
    JobIndexPeer::removeJob($this->getId());
    return parent::delete($con);
  }
  
  public function buildIndex() {
    $keyword_terms = preg_split("/\W/", $this->getKeywords(), 0, PREG_SPLIT_NO_EMPTY);
    $description_terms = preg_split("/\W/", $this->getDescription(), 0, PREG_SPLIT_NO_EMPTY);
    $title_terms = preg_split("/\W/", $this->getTitle(), 0, PREG_SPLIT_NO_EMPTY);
    $location_terms = preg_split("/\W/", $this->getLocation(), 0, PREG_SPLIT_NO_EMPTY);
    $company_terms = preg_split("/\W/", $this->getCompany(), 0, PREG_SPLIT_NO_EMPTY);
    $position_terms = preg_split("/\W/", $this->getPosition(), 0, PREG_SPLIT_NO_EMPTY);
    $name_terms = preg_split("/\W/", $this->getName(), 0, PREG_SPLIT_NO_EMPTY);
    
    $terms = array_unique(array_merge($keyword_terms, $description_terms, $title_terms, $location_terms, $company_terms, $position_terms, $name_terms));
    // delete all terms for the existing job index
    if($this->getId()) {
      JobIndexPeer::removeJob($this->getId());
      foreach($terms as $term) {
        $job_index = new JobIndex();
        $job_index->setJobId($this->getId());
        $job_index->setTerm($term);
        $job_index->save();
      }      
    }
    
  }
  
  public function getApplyEmail() {
    $body = "I am interested in the job posting I saw on the Boston PHP Job Board \n\n ";
    $body .= sfContext::getInstance()->getController()->genUrl("jobs/show?id=".$this->getId(), true);
    return $this->getEmail()."?subject=RE:+".urlencode($this->getTitle())."&body=".urlencode($body);
  }
  
  public function getSplitKeywords() {
    $keywords = preg_split("/\W/", $this->getKeywords(), 0, PREG_SPLIT_NO_EMPTY);
    return $keywords;
  }
  
  public function emailAdmin() {
    if($this->getIsActivated() == false) {
      $body = sfContext::getInstance()->getController()->genUrl("jobs/activate?token=".$this->getToken(), true);
      $mailer = sfContext::getInstance()->getMailer();
      $message = Swift_Message::newInstance()
        ->setFrom('chhean@saurinc.com')
        ->setTo('developer@saurinc.com')
        ->setSubject('Job Activation')
        ->setBody($body)
      ;
      $mailer->send($message);    
    }
  }


} // Job