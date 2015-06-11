<?php
/**
 * Strip code and tags from a file.
 */
if ($argc == 2) {
   $filename = $argv[1];
}
else {
   die("Usage: {$argv['0']} FILENAME\n");
}
if (!file_exists($filename)) {
   die("File {$filename} does not exist\n");
}
if (preg_match('/\\.(\\w+)$/', $filename, $match)) {
   $ext = strtolower($match[1]);
}
else {
   die("File extension not recognized\n");
}
$code = file_get_contents($filename);
if ($ext == 'php') {
   require_once 'stripphp.php';
   $text = stripPHP($code);
}
elseif ($ext == 'html' || $ext == 'xhtml' || $ext == 'xml') {
   require_once 'striphtml.php';
   $text = stripHTML($code);
}
elseif ($ext == 'js') {
   require_once 'stripjavascript.php';
   $text = stripJavaScript($code);
}
else {
   die("File extension not supported\n");
}
$text = trim($text);
echo $text . "\n";
?>
