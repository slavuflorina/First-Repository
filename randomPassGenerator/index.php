<?php
function password_generator($chars) 
{
  $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz~!@#$%^&*()_+=.,/\?:;';
  return substr(str_shuffle($data), 0, $chars);
}
  echo password_generator(10)."\n";
?>