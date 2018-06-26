<?php
  header("Content-type: text/html; charset=utf-8");
  session_start();
  $arr = $_POST;
  $name = $arr['name'];
  $password = $arr['password'];
  var_dump($arr);
  class Person {
    public $name = 'admin';
    public $password = 'admin';
  }
  $p = new Person();
  echo $p->name==$name;
  echo $password == $p->password;
  if($name == $p->name && $password == $p->password){
    echo 'success!';
    $_SESSION['user'] == $p->name;
    header("Location: ./aa.php"); 
  }else{
    echo '用户名或密码错误！';
  }
?>