<?php

namespace Drupal\msft_timezone_to_iana_olsen;

/**
 * Class TzConvert.
 */
class TzConvert implements TzConvertInterface {

  /**
   * @var \Drupal\msft_timezone_to_iana_olsen\MicrosoftTimeZoneDataProviderInterface
   */
  protected $dataProvider;

  /**
   * The loaded data from the data provider.
   * @var array
   */
  protected $lookup_data;
  /**
   * TzConvert constructor.
   * @param \Drupal\msft_timezone_to_iana_olsen\MicrosoftTimeZoneDataProviderInterface $dataProvider
   */
  public function __construct(MicrosoftTimeZoneDataProviderInterface $dataProvider) {
    $this->dataProvider = $dataProvider;
    $this->lookup_data = $this->dataProvider->getData();
  }

  public function convertMsftToIana(string $microsfot_timezone_id) : string {
    if (!array_key_exists($microsfot_timezone_id, $this->lookup_data)) {
      throw new TimezoneConversionException('Could not find the microsoft timezone id in the provided data');
    }

    return $this->lookup_data[$microsfot_timezone_id];
  }
}
