<?php
/**
 * Strip code from JavaScript file.
 *
 * @param string $code
 *
 * @return string
 */
function stripJavaScript($code) {
   preg_match_all('/(["\'])(.*?)\\1/', $code, $matches);
   $stripped = '';
   foreach ($matches[2] as $match) {
      $string = trim($match);
      if ($string) {
         $stripped .= $string . "\n";
      }
   }
   return $stripped;
}
?>
