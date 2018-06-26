<?php
  header("Content-type: text/html; charset=utf-8");
   //把信息添加进入数据库
  //获取get数据
   $arr = $_GET;
   $name =$arr["name"];
   $age = $arr["age"];
   $height = $arr["height"];
   $phone = $arr["phone"];
   //连接数据库
   $link = mysqli_connect('localhost','root','','message');
   mysqli_set_charset($link,'utf8');
   //插入数据
   $q = "insert into text values(null,'$name','$age','$height','$phone');";
   $result = mysqli_query($link,$q);
   if(!$result){
      echo 'error';
       exit();
   }
  //  echo $result;
   echo 'success!';
   mysqli_close($link);
?>