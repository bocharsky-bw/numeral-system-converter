<?php

require_once __DIR__ .'/../src/Converter.php';

use BW\NumeralSystem\Converter;

echo '<pre>';

print base_convert(1041114, 10, 16) ."\n";
print Converter::fromDec(1041114, 16) ."\n";
print base_convert('1041114', 10, 16) ."\n";
print Converter::fromDec('1041114', 16) ."\n";
print "\n";

print base_convert('51f', 16, 10) ."\n";
print Converter::toDec('51f', 16) ."\n";
print base_convert('51F', 16, 10) ."\n";
print Converter::toDec('51F', 16) ."\n";
print "\n";

print Converter::toDec('14df', Converter::INSENSITIVE_RADIX) ."\n";
print Converter::toDec('14dF', Converter::INSENSITIVE_RADIX) ."\n";
print Converter::toDec('14DF', Converter::INSENSITIVE_RADIX) ."\n";
print "\n";

print Converter::toDec('14df', Converter::NO_SPECIAL_CHAR_RADIX) ."\n";
print Converter::toDec('14dF', Converter::NO_SPECIAL_CHAR_RADIX) ."\n";
print Converter::toDec('14DF', Converter::NO_SPECIAL_CHAR_RADIX) ."\n";
print "\n";

print Converter::fromDec(9, Converter::MIN_RADIX) ."\n";
print Converter::toDec('1001', Converter::MIN_RADIX) ."\n";
print "\n";

print Converter::fromDec(94276256, Converter::MAX_RADIX) ."\n";
print Converter::toDec('2!w54', Converter::MAX_RADIX) ."\n";
print "\n";

echo '</pre>';