<?php
use Drupal\Core\Form\FormStateInterface;

function customtheme_form_system_theme_settings_alter(&$form, FormStateInterface $form_state) {
	$form['site_sub_slogan'] = array(
		'#type' => 'textfield',
		'#title' => 'Site Slogan',

		);
	return $form;
}
