<?php
	/*
	 * Date Created: 2011/08/12
	 * Written By: Jeff Lee
	 * Date Modified:
	 *   - 2011/10/09: Added CSS compressor, relative path, multiple file merging
	 *   - 2012/04/28: Moved JavaScript compression to a JS class
	 */

	require_once("utils.php");

	$webroot = "/home/leejefon/public_html/";

	// Required
	// For css, multiple files can be comma separated, can use external link (http://)
	// For js, one file at a time, can use external link (http://)
	$urls = $_GET["url"];

	// Optional, possible values: js, css
	$type = $_GET["type"];

	// Optional
	$base = $_GET["base"];

	// Optional
	$folder = $_GET["folder"];

	if ($urls == null) {
		echo "URL is required";
		return;
	}

	if ($type == null) {
		if (endsWith($urls, "js") == true) {
			$type = "js";
		} else if (endsWith($urls, "css") == true) {
			$type = "css";
		}
	}

	if ($base == null) {
		$base = getBase($HTTP_REFERER);
	} else if (endsWith($base, "/") == false) {
		$base .= "/";
	}

	if ($folder != null && endsWith($folder, "/") == false) {
		$folder .= "/";
	}

	if ($type == "css") {
		require_once("CSS.php");
		$css = new CSS(explode(",", $urls), $webroot . $base . $folder);
		$css->output();

	} else if ($type == "js") {
		require_once("JS.php");
		$js = new JS(explode(",", $urls), $webroot . $base . $folder);
		$js->output();
	}
?>
