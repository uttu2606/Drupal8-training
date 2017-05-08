<?php

namespace Drupal\customform\Form;

use Drupal\customform\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\user\Plugin\views\filter\Name;

class mysimpleform extends FormBase {
	public function getFormId() {
		return 'myform';
	}
	public function buildForm(array $form, FormStateInterface $form_state) {
		$form ['name'] = array (
				'#type' => 'textfield',
				'#title' => 'Name',
				'#required' => TRUE
		);
		$form ['submit'] = array (
				'#type' => 'submit',
				'#value' => 'Submit'
		);
		return $form;
	}
	public function submitForm(array &$form, FormStateInterface $form_state) {
		drupal_set_message('Form data captured succesfully');
	}
	public function validateForm(array &$form, FormStateInterface $form_state) {
		$name = $form_state->getValue ( 'name' );
		if (strlen ( $name ) <= 5) {
			$form_state->setErrorByName ( $name, 'Name should atleast contain five characters' );
		}
	}
}
