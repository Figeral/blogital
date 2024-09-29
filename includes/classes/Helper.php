<?php

declare(strict_types=1);
class Helper
{

   public function passwordMatch($pw1, $pw2): bool
   {
      return $pw1 == $pw2 ? true : false;
   }
   public function isValidLength($str, $min = 7, $max = 20): bool
   {
      return strlen($str) > $min && $str < $max ? true : false;
   }
   public function isEmpty($postValue): bool
   {
      if (is_array($postValue)) {
         foreach ($postValue as $value) {
            if (is_null($value) || strlen($value) === 0) {
               return true;
            }
         }
         return false;
      }
   }
   public function isSecure(string $pw): bool
   {
      return (preg_match("~[a-z]+~", $pw) && preg_match("~[A-Z]+~", $pw) && preg_match("~[0-9]+~", $pw)) === true ? true : false;
   }
   public function keepValues($value, $type, $attr)
   {
      switch ($type) {
         case "textarea":
            echo "value=' $value'";
            break;
         case "textbox":
            echo "value=' $value'";
            break;
         case "select":
            echo $attr == 'P' ?  "" : "";
         default:
            echo "";
      };
   }
}
