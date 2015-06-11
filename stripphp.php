<?php
/**
 * Strip code from PHP file.
 *
 * @param string $code
 *
 * @return string
 */
function stripPHP($code) {
   $validTypes = array(
      T_INLINE_HTML,
      T_ENCAPSED_AND_WHITESPACE,
      T_CONSTANT_ENCAPSED_STRING,
      );
   $tokens = token_get_all($code);
   $stripped = '';
   foreach ($tokens as $token) {
      if (is_array($token)) {
         list($type, $text) = $token;
         if (in_array($type, $validTypes)) {
            $text = trim($text);
            $text = preg_replace('/^[\'"]/', '', $text);
            $text = preg_replace('/[\'"]$/', '', $text);
            $text = preg_replace('/\\s+|(\\\\\\w)+/', ' ', $text);
            if ($text) {
               $stripped .= $text . "\n";
            }
         }
      }
   }
   return $stripped;
}
?>
