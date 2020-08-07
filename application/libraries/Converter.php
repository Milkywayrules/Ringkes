<?php

/*
*
*
*/
class Converter {

  const ALPHABET = '6ZX8BHtsfySg9CmxjVnGbFpR-vDM7dK2WNzP54JcLhqT_Yw3Qrk';
  const BASE = 51; // strlen(self::ALPHABET)

  public static function url_encode($num) {
    $str = '';

    while ($num > 0) {
      $str = self::ALPHABET[($num % self::BASE)] . $str;
      $num = (int) ($num / self::BASE);
    }

    return $str;
  }

  public static function url_decode($str) {
    $num = 0;
    $len = strlen($str);

    for ($i = 0; $i < $len; $i++) {
      $num = $num * self::BASE + strpos(self::ALPHABET, $str[$i]);
    }

    return $num;
  }

  function base64_encode($input){
    return rtrim(strtr(base64_encode($input), '+/', '-_'), '=');
  }

  function base64_decode($input){
    return base64_decode(strtr($input, '-_', '+/').str_repeat('=', 3 - (3 + strlen($input)) % 4));
  }


}

 ?>
