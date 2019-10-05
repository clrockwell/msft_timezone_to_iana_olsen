<?php

namespace Drupal\msft_timezone_to_iana_olsen;

use Drupal\serialization\Encoder\XmlEncoder;

/**
 * Class MicrosoftTimeZoneDataProvider.
 */
class MicrosoftTimeZoneDataProvider implements MicrosoftTimeZoneDataProviderInterface {

  /**
   * @var array
   */
  protected $data;

  /**
   * @var \Drupal\serialization\Encoder\XmlEncoder
   */
  protected $encoder;

  /**
   * MicrosoftTimeZoneDataProvider constructor.
   * @param \Drupal\serialization\Encoder\XmlEncoder $encoder
   */
  public function __construct(XmlEncoder $encoder) {
    $this->encoder = $encoder;
    $this->loadData();
  }

  public function getData() {
    return $this->data;
  }

  public function loadData() {
    $file = drupal_get_path('module', 'msft_timezone_to_iana_olsen') . '/data/windowsZones.xml';
    $node = file_get_contents($file);
    $dom = new \DOMDocument();
    $dom->loadXML($node);
    foreach ($dom->childNodes as $childNode) {
      if (XML_DOCUMENT_TYPE_NODE === $childNode->nodeType) {
        $dom->removeChild($childNode);
      }
    }
    foreach ($dom->childNodes as $childNode) {
      if (XML_COMMENT_NODE === $childNode->nodeType) {
        $dom->removeChild($childNode);
      }
    }

    $parsed = $this->encoder->decode($dom->saveXML(), 'xml');
    $this->data = $this->massageData($parsed['windowsZones']['mapTimezones']['mapZone']);
  }

  protected function massageData($mapZones) {
    $data = [];
    foreach ($mapZones as $tz) {
      // Skip backward compatible @see https://www.php.net/manual/en/timezones.others.php
      if (stripos($tz['@type'], 'Etc/GMT') !== FALSE) {
        continue;
      }
      $data[$tz['@other']] = $tz['@type'];
    }

    return $data;
  }

}
