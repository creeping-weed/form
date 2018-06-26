<?php
  include('./code.php');
//   echo $_SESSION['code'];
//   if($_SESSION['code']==0){
      
//   }
  $code = create();
  $_SESSION['code'] = $code;
  $message = '';
  if ( $_SERVER[ "REQUEST_METHOD" ] == "POST" ) {
        $arr = $_POST;
        $name = $arr['name'];
        $password = $arr['password'];
        $keycode = $arr['code'];
        if($keycode==$_SESSION['code']){
            $message = $_SESSION['code'];
        }else{
            class Person {
                public $name = 'admin';
                public $password = 'admin';
            }
            $p = new Person();
            if ( $name == $p->name && $password == $p->password ) {
                // 当用户名与 密码都验证成功后
                session_start(); // 只要调用这个函数, 服务器就会开辟一个 session 内存
                // 同时给浏览器发送一个 PHPSESSID 的 数据, 数据值简单的理解为这个 session 内存的 id
                // 将 当前用户的 ID存储到 SESSION 中
                $_SESSION[ "curr_user_login_id" ] = $p->name;
                // 清除session当中的code;
                $_SESSION['code'] = 0;
                // 直接跳转到 index.php 页面
                header( "location: ./index.php" );
                exit;
               
            } else {
                $message = "用户名或密码错误( 密码错误 )";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>个人信息表单</title>
</head>
<style>
    html,
    body,
    ul,
    li,
    ol,
    dl,
    dd,
    dt,
    p,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    form,
    fieldset,
    legend,
    img {
        margin: 0;
        padding: 0;
    }
    
    .content {
        width: 450px;
        background-color: #ccc;
        margin: 100px auto;
        border-radius: 5px;
        overflow: hidden;
    }
    
    .content h3 {
        text-align: center;
        background-color: rgb(228, 122, 51);
        line-height: 40px;
        height: 40px;
        font-size: 22px;
        padding: 5px 0;
    }
    
    .content div {
        height: 50px;
        border-top: 1px solid #555;
        line-height: 50px;
        padding: 0 20px;
        font-size: 16px;
    }
    
    .content input[type=text],
    .content input[type=password] {
        /* width: 220px;
    padding: 5px 5px;
    border-radius: 2px; */
        /* display: block; */
        width: 74%;
        height: 22px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
    }
    
    .content input[type=text]:focus,
    .content input[type=password]:focus {
        border-color: #66afe9;
        outline: 0;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(102, 175, 233, .6);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(102, 175, 233, .6);
    }
    
    .btn {
        display: inline-block;
        margin: 0 20px;
        padding: 6px 12px;
        font-size: 14px;
        font-weight: 400;
        line-height: 1.42857143;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        -ms-touch-action: manipulation;
        touch-action: manipulation;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background-image: none;
        border: 1px solid transparent;
        border-radius: 4px;
    }
    
    .btn:hover {
        color: #333;
        text-decoration: none;
    }
    
    .btn-success {
        color: #fff;
        background-color: #5cb85c;
        border-color: #4cae4c;
    }
    
    .btn-danger {
        color: #fff;
        background-color: #d9534f;
        border-color: #d43f3a;
    }
    
    .btn-danger:hover {
        color: #fff;
        background-color: #c9302c;
        border-color: #ac2925;
    }
    
    .btn-success:hover {
        color: #fff;
        background-color: #449d44;
        border-color: #398439;
    }
    
    .btnBox {
        text-align: center;
    }
    .mes {
        color: red;
        text-align: center;
        height: 30px;
        line-height: 30px;
    }
    .code input[name=code]{
        width: 30%;
    }
    .code span {
        background-color: rgb(228, 122, 51);
        padding: 2px 5px;
    }
</style>
<body>
    <div class="content">
        <h3>个人信息</h3>
        <p class="mes"><?php echo $message ?></p>
        <form action="" method="POST">
            <div>
                <label for="name">用户名:</label>
                <input type="text" id="name" placeholder="请输入用户名" autocomplete="off" name="name">
            </div>
            <div>
                <label for="password">密  码:</label>
                <input type="password" id="password" placeholder="请输入密码" autocomplete="off" name="password">
            </div>
            <div class="code">
                <label for="code">验证码:</label>
                <input type="text" id="code" placeholder="请输入验证码" autocomplete="off" name="code">
                <span><?php echo $code?></span>
            </div>
            <div class="btnBox">
                <input type="reset" value="重置" class="btn btn-danger">
                <input type="submit" value="登入" class="btn btn-success">
            </div>
        </form>
    </div>
</body>
</html>