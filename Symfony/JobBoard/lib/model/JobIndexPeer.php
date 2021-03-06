<?php


/**
 * Skeleton subclass for performing query and update operations on the 'job_index' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Tue Feb 22 18:07:37 2011
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class JobIndexPeer extends BaseJobIndexPeer {
  
  public static function removeJob($job_id) {
    $criteria = new Criteria();
    $criteria->add(self::JOB_ID, $job_id);
    return self::doDelete($criteria);
  }

  public static function getWithTerm($keywords) {
    $terms = preg_split("/\W/", $keywords, 0, PREG_SPLIT_NO_EMPTY);
    $c = new Criteria();
    $c->add(self::TERM, $terms, Criteria::IN);
    $c->addGroupByColumn(self::JOB_ID);
    return self::doSelect($c);
  }

} // JobIndexPeer
