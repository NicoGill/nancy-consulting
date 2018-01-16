<?php

/**
 * Global PHP functions helper
 *
 * @package _wpng
 */

if ( ! function_exists('write_log')) {
   function write_log ( $log )  {
      if ( is_array( $log ) || is_object( $log ) ) {
         error_log( print_r( $log, true ) );
      } else {
         error_log( $log );
      }
   }
}

add_action('wp_mail_failed', 'log_mailer_errors', 10, 1);
function log_mailer_errors(){
  $fn = ABSPATH . '/mail.log'; // say you've got a mail.log file in your server root
  $fp = fopen($fn, 'a');
  fputs($fp, "Mailer Error: " . $mailer->ErrorInfo ."\n");
  fclose($fp);
}
