<?php

namespace Drupal\customform\Form;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\customform\Dbwrapper;

class NewForm extends ConfigFormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'new_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    
    $form['app_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Weather app API Key'),
      '#default_value' => $this->config('customform.weather_config')->get('app_key', $form_state->getValue('app_key'))
     
    ];

    return parent::buildForm($form, $form_state);

}
  /**
    * {@inheritdoc}
    */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  	$this->config('customform.weather_config')->set('app_key', $form_state->getValue('app_key'))->save();
  	parent::submitForm($form, $form_state);
  }
  protected function getEditableConfigNames() {
  	return [
  	'customform.weather_config'
  	];
  }

}

