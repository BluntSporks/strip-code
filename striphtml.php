<?php
/**
 * Strip code from HTML file.
 *
 * @param string $code
 *
 * @return string
 */
function stripHTML($code) {
   $text = strip_tags($code);
   $lines = explode("\n", $text);
   $stripped = '';
   foreach ($lines as $line) {
      $line = trim($line);
      if ($line) {
         $stripped .= $line . "\n";
      }
   }
   return $stripped;
}
?>
