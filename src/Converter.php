<?php

namespace BW\NumeralSystem;

class Converter
{
    /**
     * Минимальное основание для перевода чисел
     */
    const MIN_RADIX = 2;
    
    /**
     * Максимальное основание для перевода чисел с учетом регистра и с использованием 
     * специальных символов, которые разрешены в адресной строке браузера без кодирования
     */
    const MAX_RADIX = 76;
    
    /**
     * Максимальное основание для перевода чисел без учета регистра
     */
    const INSENSITIVE_RADIX = 36;
    
    /**
     * Максимальное основание для перевода чисел без использования специальных символов
     */
    const NO_SPECIAL_CHAR_RADIX = 62;
    
    /**
     * Основание N для перевода
     * @var integer
     */
    private static $radix;
    
    /**
     * Массив чисел для перевода с основанием 10 в числа с основанием N и обратно,
     * которые допистимы для использования в адресной строке браузера без преобразования в спецсимволы
     * @var array
     */
    private static $symbols = array(
            '0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J',
            'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T',
            'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd',
            'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n',
            'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x',
            'y', 'z', '!', '$', '(', ')', '*', '+', ',', '-',
            '.', ':', ';', '@', '_', '~',
        );
    
    
    /**
     * Конструктор - Устанавливает основание для перевода чисел
     * @param int $base Основание для преобразования
     */
    private function __construct() {}
    
    /**
     * Convert <b>$number</b> from decimal to <b>$to_base</b> base
     * @param mixed $number The number for converting
     * @param integer $to_base The base to convert
     * @return string The converted number to base <b>$to_base</b>
     * @throws \Exception
     */
    public static function fromDec($number, $to_base) {
        self::setRadix($to_base, __METHOD__); // Set current radix
        $number = (int)$number;
        if ( ! is_integer(self::$radix)) {
            throw new \Exception('Exception detected: '. __METHOD__ .' expects parameter 2 to be "integer", "'. gettype($from_base) .'" given.');
        }
        
        $result = '';
        do {
            $floor = floor( $number / self::$radix ); // Вычисляем частное
            $modulo = $number - $floor * self::$radix; // Вычисляем остаток от деления
            $number = $floor; // Записываем текущее частное в переменную, для нахождения нового частного
            $result = self::$symbols[ $modulo ] . $result; // Формируем число по основанию N
        } while ( $floor );
        
        return $result;
    }
    
    /**
     * Convert <b>$number</b> from <b>$from_base</b> to decimal base
     * @param mixed $number The number for converting
     * @param integer $from_base The base from convert
     * @return integer The converted number to decimal
     * @throws \Exception
     */
    public static function toDec($number, $from_base) {
        self::setRadix($from_base, __METHOD__); // Set current radix
        $number = (string)$number;
        $number = trim($number);
        $count = strlen($number);
        if (self::$radix <= self::INSENSITIVE_RADIX) {
            $number = strtoupper($number);
        } 
        
        $result = 0;
        for ($i = 0, $j = $count - 1; $i < $count; $i++, $j--) {
            $search = array_search($number[$i], self::$symbols, TRUE);
            if ($search === FALSE) {
                throw new \Exception('Exception detected: unrecognized character "'. $number[$i] .'" of number "'. $number .'" in '. __METHOD__ .'. Allowed chars is <b>'. implode('', array_slice(self::$symbols, self::NO_SPECIAL_CHAR_RADIX)) .'</b>.');
            }
            $result += $search * pow(self::$radix, $j);
        }
        
        return $result;
    }
    
    private static function setRadix($radix, $method) {
        if ( ! is_integer($radix)) {
            throw new \Exception('Exception detected: '. $method .' expects parameter 2 to be "integer", "'. gettype($radix) .'" given.');
        } elseif (self::MIN_RADIX > $radix || $radix > self::MAX_RADIX) {
            throw new \Exception('Exception detected: the radix "'. $radix .'" is out of range, must be greater or equal '. self::MIN_RADIX .' and less or equal '. self::MAX_RADIX .' in '. $method .'.');
        }
        
        self::$radix = $radix;
    }
}