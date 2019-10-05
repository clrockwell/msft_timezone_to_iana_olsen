<?php

namespace Drupal\msft_timezone_to_iana_olsen;

use Throwable;

class TimezoneConversionException extends \Exception {
  public function __construct($message = "", $code = 0, Throwable $previous = NULL) {
    parent::__construct($message, $code, $previous);
  }
}