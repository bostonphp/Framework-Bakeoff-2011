<?php

/**
 * JobIndex filter form base class.
 *
 * @package    JobBoard
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseJobIndexFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'term'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'job_id' => new sfWidgetFormPropelChoice(array('model' => 'Job', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'term'   => new sfValidatorPass(array('required' => false)),
      'job_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Job', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('job_index_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'JobIndex';
  }

  public function getFields()
  {
    return array(
      'term'   => 'Text',
      'job_id' => 'ForeignKey',
      'id'     => 'Number',
    );
  }
}
