<?php
session_start();
if(1){
  header('Location: ./index.html');
}else{
  header("Location: ./login.html");
}
?>