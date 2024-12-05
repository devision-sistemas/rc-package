<?php

namespace Reaction\Base\Traits;

trait Ajax
{
/**
 * Verifies the AJAX request nonce to ensure the request is valid.
 * If the nonce verification fails, sends a JSON error response and exits.
 *
 * @param string $nonce The nonce to verify against the AJAX request.
 *
 * @return void
 */
  final protected static function check_ajax_call(string $nonce): Void
  {
    if (!wp_verify_nonce($_REQUEST['nonce'], $nonce)) {
      wp_send_json_error('Invalid request');
      exit;
    }
  }

  /**
   * Check if required fields are set.
   * $data array is usually the $_POST object. Use the $required_fields array
   * in the following format:
   * 
   * $required_fields = [
   *   'field' => 'Error Message',
   * ];
   *
   * @param array $data
   * @param array $required_fields
   * 
   * @return void
   */   
  final protected static function check_ajax_required_fields(array $data, array $required_fields): Void
  {
    foreach ($required_fields as $key => $value) {
      if (!isset($data[$key]) || empty($data[$key])) {
        wp_send_json_error($value);
        exit;
      }
    }
  }
}
