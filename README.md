numeral-system-converter
========================

Convert numbers to different numeral systems.

Installation
------------

1) Use `require_once` for include converter to your code. Add next code before using converter

```php
require_once /path-to-numeral-system-converter/src/Converter.php';
use BW\NumeralSystem\Converter;
```

2) Or use `composer` to install. Add next code to `composer.json` file

require: `"bocharsky-bw/numeral-system-converter": "dev-master"`

Using
-----

```php
echo '<pre>';

print Converter::fromDec(9, Converter::MIN_RADIX) ."\n";
print Converter::toDec('1001', Converter::MIN_RADIX) ."\n";
print "\n";

print Converter::fromDec(11, 16) ."\n";
print Converter::toDec('B', 16) ."\n";
print "\n";

print Converter::fromDec(94276256, Converter::MAX_RADIX) ."\n";
print Converter::toDec('2!w54', Converter::MAX_RADIX) ."\n";
print "\n";

echo '</pre>';
```
