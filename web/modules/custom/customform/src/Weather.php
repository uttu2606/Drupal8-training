<?php

namespace Drupal\customform;
use GuzzleHttp\Client;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Component\Serialization\Json;
;

class Weather {
	private $config, $request;
	public function  __construct(ConfigFactoryInterface
	 $config, Client $request) {
		$this->config = $config;
		$this->request = $request;
	}

	public function pulldata($cityName) {
		$appid= $this->config->get('customform.weather_config')->get('app_key');
		$response = $this->request->request('GET', 'http://api.openweathermap.org/data/2.5/weather' , ['query' => ['q' => $cityName,
			'appid' => $appid]]);
		return Json::decode($response->getBody()->getContents());
		
	}
}