<?php

/**
 * Job form base class.
 *
 * @method Job getObject() Returns the current form's model object
 *
 * @package    JobBoard
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseJobForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'name'         => new sfWidgetFormInputText(),
      'location'     => new sfWidgetFormInputText(),
      'company'      => new sfWidgetFormInputText(),
      'email'        => new sfWidgetFormInputText(),
      'category_id'  => new sfWidgetFormPropelChoice(array('model' => 'Category', 'add_empty' => false)),
      'title'        => new sfWidgetFormInputText(),
      'keywords'     => new sfWidgetFormInputText(),
      'position'     => new sfWidgetFormTextarea(),
      'description'  => new sfWidgetFormTextarea(),
      'token'        => new sfWidgetFormInputText(),
      'is_activated' => new sfWidgetFormInputCheckbox(),
      'agree_terms'  => new sfWidgetFormInputCheckbox(),
      'expires_at'   => new sfWidgetFormDateTime(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'name'         => new sfValidatorString(array('max_length' => 255)),
      'location'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'company'      => new sfValidatorString(array('max_length' => 255)),
      'email'        => new sfValidatorString(array('max_length' => 255)),
      'category_id'  => new sfValidatorPropelChoice(array('model' => 'Category', 'column' => 'id')),
      'title'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'keywords'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'position'     => new sfValidatorString(array('required' => false)),
      'description'  => new sfValidatorString(array('required' => false)),
      'token'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_activated' => new sfValidatorBoolean(),
      'agree_terms'  => new sfValidatorBoolean(),
      'expires_at'   => new sfValidatorDateTime(array('required' => false)),
      'created_at'   => new sfValidatorDateTime(array('required' => false)),
      'updated_at'   => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Job', 'column' => array('token')))
    );

    $this->widgetSchema->setNameFormat('job[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Job';
  }


}
