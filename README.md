JavaScript-CSS-Minifier-in-PHP
==============================

Minify JavaScript and CSS on the fly

Usage
-----

* In a normal HTML file, include JavaScript or CSS as follows:

```
<link rel="stylesheet" href="/compile?folder=css&url=font.css,style.css,smoothness/jquery-ui.css" />
<script type="text/javascript" src="/compile?url=js/script.js"></script>
```
* Put .htacces file n the webroot allows you to call the script by /compressor?{Params}


Parameters
----------

+ **url** (Required) - Relative path or URL.  Comma separated if multiple files.

+ **base** (Optional) - Path from the $webroot (defined in compressor.php).  Useful when the page is "included" or dynamically loaded.

One example would be the 404 error page.  Usually when 404 error occurs, the 404 page content is loaded, but URL unchanged.

In this case, you will need to indicate the base otherwise file will not found.

+ **folder** (Optional) - Path from the current page location.  Useful if you want to include multiple files at the same time, you can save characters.

Example: to include css/style1.css css/style2.css css/jqueryui/jquery-ui.css

<link rel="stylesheet" href="/compile?folder=css&url=style1.css,style2.css,jqueryui/jquery-ui.css" />

+ **type** (Optional) - js or css.  Auto detected if not defined.


TODO
----
* Add Cache ability (Right now if you want to generate the minified file, just run the php scritp in the terminal and output to file)
