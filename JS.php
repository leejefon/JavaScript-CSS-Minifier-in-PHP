<?php

require 'packer/class.JavaScriptPacker.php';

/*
 * JavaScript Compressor
 * Date Created: 2012/04/28
 * Written By: Jeff Lee
 */
class JS {
	private $js_files;
	private $base_path;

	public function __construct($js_files, $base_path = '') {
		$this->base_path = $base_path;
		$this->add($js_files);
	}

	public function add($js_files) {
		if (is_array($js_files)) {
			foreach ($js_files as $js_file) {
				$this->add($js_file);
			}
		} else {
			if (startsWith($js_files, "http")) {
				$this->js_files[] = $js_files;				
			} else if (file_exists($this->base_path . $js_files)) {
				$this->js_files[] = $this->base_path . $js_files;
			}
		}
	}

	public function output($method = "minify") {
		/*
		 * callback for ob_start()
		 * Compress the js files using the closure compiler
		 */
		function minify($buffer) {
			$fields = array(
				'js_code' => urlencode($buffer),
				'compilation_level' => 'SIMPLE_OPTIMIZATIONS', // 'WHITESPACE_ONLY', 'ADVANCED_OPTIMIZATIONS'
				'output_format' => 'text',
				'output_info' => 'compiled_code'
			);

			$fields_string = "";
			foreach ($fields as $key => $value) {
				$fields_string .= $key . '=' . $value . '&';
			}

			rtrim($fields_string, '&');

			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, "http://closure-compiler.appspot.com/compile");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$server_output = curl_exec ($ch);

			curl_close ($ch);

			return $server_output;
		}

		function packer($buffer) {
			$packer = new JavaScriptPacker($buffer, "Normal", true, false);
			return $packer->pack();
		}

		header('Content-type: text/javascript');

		ob_start($method);
		foreach ($this->js_files as $js_file) {
			echo file_get_contents($js_file);
		}
		ob_end_flush();
	}
}
?>
