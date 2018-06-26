<?php
  function create($count=5){
    $charset = 'abcdefghijklmnopqrstuvwxyz123456789';
    $code = '';
    $len = strlen($charset) - 1;
    for($i = 0; $i < $count; $i++){
      $code .= $charset[mt_rand(0,$len)];
    }
    return $code;
  }
  $code = create();
?>