<?php

/*
 * CSS Compressor
 * Date Created: 2011/10/09
 * Written By: Jeff Lee
 */
class CSS {
	private $css_files;
	private $base_path;
	
	public function  __construct($css_files, $base_path = '') {
		$this->base_path = $base_path;
		$this->add($css_files);
	}

	public function add($css_files) {
		if (is_array($css_files)) {
			foreach ($css_files as $css_file) {
				$this->add($css_file);
			}
		} else {
			if (startsWith($css_files, "http")) {
				$this->css_files[] = $css_files;
			} else if (file_exists($this->base_path . $css_files)) {
				$this->css_files[] = $this->base_path . $css_files;
			}
		}
	}

	public function output() {
		/*
		 * callback for ob_start()
		 * Compress the css files using regular expression and return output
		 *
		 * TODO:
		 *   - Merge padding, margin, border, etc.
		 *   - Delete empty code blocks
		 */
		function regx_removal($buffer) {
			// remove comments
			$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
			// remove tabs, consecutivee spaces, newlines, etc.
			$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '	', '	'), '', $buffer);
			// remove single spaces
			$buffer = str_replace(array(" {", "{ ", "; ", ": ", " :", " ,", ", ", ";}"), array("{", "{", ";", ":", ":", ",", ",", "}"), $buffer);

			return $buffer;
		}

		header('Content-type: text/css');
		
		ob_start("regx_removal");
		foreach ($this->css_files as $css_file) {
			// make the url in css file absolute
//			echo preg_replace('/url\((?!http)(?!\'http)(?!\"http)(\"|\')?/', 'url(\1' . str_replace($_SERVER["DOCUMENT_ROOT"], "", $this->base_path), file_get_contents($css_file));

			// Fix suggested by mrXCray (https://github.com/mrXCray/)
			echo preg_replace('/url\((?!(http|\/))(?!(\'http|\'\/))(?!(\"http|\"\/))(\"|\')?/', 'url(\1' . str_replace($_SERVER["DOCUMENT_ROOT"], "", $this->base_path), file_get_contents($css_file));
		}
		ob_end_flush();
	}
}
?>
