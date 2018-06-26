<?php
if ( $_SERVER[ "REQUEST_METHOD" ] == "POST" ) {
    
    if ( empty( $_POST[ "email" ] ) || empty( $_POST[ "password" ] ) ) {
        $message = "请输入完整信息";
    } else {
        
        $email = $_POST[ "email"];
        $password = $_POST[ "password"];
        
        $conn = mysqli_connect( "127.0.0.1", "root", "123456", "baixiu" );
        
        $sql = "SELECT id, password FROM users WHERE email='$email'";
        $reader = mysqli_query( $conn, $sql );
        
        
        
        $item = mysqli_fetch_assoc( $reader ); 
        
        if ( $item ) {
            
            if ( $password == $item[ "password" ] ) {
                // 当用户名与 密码都验证成功后
                session_start(); // 只要调用这个函数, 服务器就会开辟一个 session 内存
                // 同时给浏览器发送一个 PHPSESSID 的 数据, 数据值简单的理解为这个 session 内存的 id

                // 将 当前用户的 ID存储到 SESSION 中
                $_SESSION[ "curr_user_login_id" ] = $item[ "id" ];

                // 直接跳转到 index.php 页面
                header( "location: ./index.php" );
                exit;
               
            } else {
                
                $message = "用户名或密码错误( 密码错误 )";
            }
        } else {
            
            $message = "用户名或密码错误( 用户不存在 )";
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
    <title>Document</title>
</head>
<body>
    <?php 
    if ( isset( $message ) ) { 
        echo "<p>$message</p>";
    } 
    ?>
    <hr>
    <?php if ( isset( $message ) ) { ?>
    <p><?php echo $message ?></p>
    
    <?php } ?>
    <form method="post">
        邮箱: <input type="text" name="email" /><br>
        密码: <input type="password" name="password"><br>
        <input type="submit" value="登录">
    </form>
</body>
</html>
