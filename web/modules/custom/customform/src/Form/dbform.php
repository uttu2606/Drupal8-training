<?php

namespace Drupal\customform\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\customform\Dbwrapper;

/**
 * Class dbform.
 *
 * @package Drupal\customform\Form
 */
class dbform extends FormBase {

  public function __construct(DbWrapper $dbWrapper) {
    $this->dbWrapper =$dbWrapper;
  }


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'db_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $fetched = $this->dbWrapper->getData (); 
    $form['first_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('First Name'),
      '#description' => $this->t('Enter first name'),
      '#default_value'=> $fetched ['First_Name']
    ];
    $form['last_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Last Name'),
      '#description' => $this->t('Enter last name'),
    ];

    $form['submit'] = [
        '#type' => 'submit',
        '#value' => $this->t('Submit'),
    ];

    return $form;
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
    $this->dbWrapper->setData ( $form_state->getValue ( 'first_name' ), $form_state->getValue ( 'last_name' ) ); 

  }
public static function create(ContainerInterface $container) {
  return new static(
    $container->get('customform.dbwrapper'));
}
}
