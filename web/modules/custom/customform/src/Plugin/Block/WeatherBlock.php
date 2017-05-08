<?php

namespace Drupal\customform\Plugin\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Block\Annotation\Block;
use Drupal\customform\Weather;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
* @Block(
*   id= "Weather_block",
*   admin_label= "Weather Block"
* )
**/
class WeatherBlock extends BlockBase implements ContainerFactoryPluginInterface {
private $weatherConfig;
	public function __construct(array $configuration, $plugin_id, $plugin_definition, Weather $weatherConfig) {
		parent:: __construct($configuration, $plugin_id, $plugin_definition );
	$this->weatherConfig = $weatherConfig;
}
	public function build() {
		$weather_data = $this->weatherConfig->pulldata ( $this->configuration ['city_name'] ) ;
		return array(
		'#theme' => 'weather_widget',
		'#weather_data' => $weather_data,
		'#attached' => [
		 'library' => [
		 'customform/weather-widget']
		 ] 
		);

	}
	public function blockForm($form, FormStateInterface $Form_state) {
		$form['city_name'] = array(
			'#type' => 'textfield',
			'#title' => 'City Name',
			'#default_value' => $this->configuration['city_name'],
			);
		return $form;
	}
	public function blockSubmit($form, FormStateInterface $form_state) {
		$this->configuration['city_name'] = $form_state->getValue('city_name');
	}
	public static function create(ContainerInterface $container,array $configuration, $plugin_id, $plugin_definition) {
		return new static (
		$configuration, $plugin_id, $plugin_definition, $container->get('customform.weather')
		);
	}
}