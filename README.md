# msft_timezone_to_iana_olsen
Drupal module for converting microsoft timezone id to iana olsen compatible string

# Usage
- Install like any other drupal module
- `$converter = \Drupal::service('msft_timezone_to_iana_olsen.tz_convert');`
- `$ianaTz = $convertor->convertMsftToIana('Hawaiian Standard Time')`
