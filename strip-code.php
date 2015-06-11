<?php
/**
 * Strip code and tags from a file.
 */
if ($argc >= 2) {
   $filename = $argv[$argc - 1];
}
else {
   die("Usage: {$argv['0']} [-w] [-m REGEXP] FILENAME\n");
}
$options = getopt('wm:');
$withFilename = isset($options['w']);
$matchingExpr = isset($options['m']) ? $options['m'] : null;
$matchingExpr = '/\\b(' . implode('|', $temps) . ')\\b/i';
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
$lines = explode("\n", $text);
foreach ($lines as $line) {
   if ($matchingExpr && !preg_match_all($matchingExpr, $line, $matches)) {
      continue;
   }
   if ($withFilename) {
      echo $filename . ':';
   }
   echo $line;
   if ($matchingExpr) {
      echo ' (';
      foreach ($matches[0] as $i => $match) {
         if ($i > 0) {
            echo ', ';
         }
         echo $match;
      }
      echo ')';
   }
   echo "\n";
}
?>
