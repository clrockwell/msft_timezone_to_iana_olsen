<?php

namespace Drupal\msft_timezone_to_iana_olsen;

use Drupal\serialization\Encoder\XmlEncoder;

/**
 * Interface MicrosoftTimeZoneDataProviderInterface.
 */
interface MicrosoftTimeZoneDataProviderInterface {

  public function __construct(XmlEncoder $xmlEncoder);

  public function loadData();

  public function getData();

}
