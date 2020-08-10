<?php

/**
 * Author : Amir Shokri
 * Email : amirsh.nll@gmail.com
 * Date : September 2020
 * Website : www.amirshnll.ir
 * API Docs : https://docs.nomics.com
 */
class API
{
	/* Class Member */
	private $api_code;
	private $api_address;
	private $cache_file_name;
	private $updated_time;

	/* Construct */
	function __construct()
	{
		$this->set_api_code('');
		$this->set_api_address('https://api.nomics.com/v1/currencies/ticker?key=');
		$this->set_cache_file_name('cache/data.json');
		$this->set_updated_time(date('Y, M d', time()));
	}

	/* Setter And Getter */
	public function get_api_code() {
		return $this->api_code;
	}

	public function set_api_code($api_code) {
		if(empty($api_code) || is_null($api_code))
			return;
		else
			$this->api_code = htmlspecialchars($api_code, ENT_QUOTES, 'UTF-8');
	}

	public function get_api_address() {
		return $this->api_address;
	}

	public function set_api_address($api_address) {
		if(empty($api_address) || is_null($api_address))
			return;
		else
			$this->api_address = htmlspecialchars($api_address, ENT_QUOTES, 'UTF-8');
	}

	public function get_cache_file_name() {
		return $this->cache_file_name;
	}

	public function set_cache_file_name($cache_file_name) {
		if(empty($cache_file_name) || is_null($cache_file_name))
			return;
		else
			$this->cache_file_name = htmlspecialchars($cache_file_name, ENT_QUOTES, 'UTF-8');
	}

	public function get_updated_time() {
		return $this->updated_time;
	}

	public function set_updated_time($updated_time) {
		if(empty($updated_time) || is_null($updated_time))
			return;
		else
			$this->updated_time = htmlspecialchars($updated_time, ENT_QUOTES, 'UTF-8');
	}

	/* Private Function */
	private function request() {
		return json_encode($this->get_api_address() . $this->get_api_code());
	}

	private function cache($jsonData) {
		$file = fopen($this->get_cache_file_name(), 'w');
		fwrite($file, $jsonData);
		fclose($file);
	}

	private function isJson($jsonData) {
		return ((is_string($jsonData) &&
			(is_object(json_decode($jsonData)) ||
				is_array(json_decode($jsonData))))) ? true : false;
	}

	/* Public Function */
	public function read() {
		if(file_exists($this->get_cache_file_name()) && time() - filemtime($this->get_cache_file_name()) < 5000) {
			$file = fopen($this->get_cache_file_name(), "r");
			$jsonData = fread($file, filesize($this->get_cache_file_name()));
			fclose($file);
			if($this->isJson($jsonData)) {
				$this->set_updated_time(date('Y, M d', filemtime($this->get_cache_file_name())));
				return json_decode($jsonData, true);
			}
		}
		$jsonData = null;

		$jsonData = @file_get_contents($this->get_api_address() . $this->get_api_code());
		if($this->isJson($jsonData)) {
			$this->cache($jsonData);
			$this->set_updated_time(date('Y, M d', time()));
			return json_decode($jsonData, true);
		} else {
			if(file_exists($this->get_cache_file_name())) {
				$file = fopen($this->get_cache_file_name(), "r");
				$jsonData = fread($file, filesize($this->get_cache_file_name()));
					fclose($file);
					if($this->isJson($jsonData)) {
						$this->set_updated_time(date('Y, M d', filemtime($this->get_cache_file_name())));
						return json_decode($jsonData, true);
					} else {
						return false;
					}
				} else {
					return false;
				}
			}
		}

	}

?>