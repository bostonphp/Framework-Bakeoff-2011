<?php

/**
 * JobIndex form base class.
 *
 * @method JobIndex getObject() Returns the current form's model object
 *
 * @package    JobBoard
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseJobIndexForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'term'   => new sfWidgetFormInputText(),
      'job_id' => new sfWidgetFormPropelChoice(array('model' => 'Job', 'add_empty' => false)),
      'id'     => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'term'   => new sfValidatorString(array('max_length' => 255)),
      'job_id' => new sfValidatorPropelChoice(array('model' => 'Job', 'column' => 'id')),
      'id'     => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('job_index[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'JobIndex';
  }


}
