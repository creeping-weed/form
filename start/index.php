<?php

// 思路:
// 1, 检查你是否带有车票( cookie, 是否有一个 PHPSESSID 的值 )
// 2, 如果没有, 回到 登录页
// 3, 如果有, 开启 session 检查 session 中知否存储了 curr_user_login_id
// 4, 如果没有, 表示你登录失效或是伪装的请求. 因此直接跳转到登录页
// 5, 如果存在该数据, 表示登录成功, 什么也不做, 后面继续运行

if ( isset( $_COOKIE[ "PHPSESSID" ] ) ) {
    // 带有. 验证 session.

    session_start(); // 根据用户传入的 PHPSESSID 将对应的 SESSION 取出来

    /*
    if ( isset( $_SESSION[ "curr_user_login_id" ] ) ) {
        // 存在, 表示正常登录, 就什么也不做, 直接继续运行
    } else {
        // 不存在, 表示可能登录失效, 或伪装 cookie 请求, 回到登录页, 重新登录
        header( "location: ./login.php" );
        exit;
    }
    */

    if ( empty( $_SESSION[ "curr_user_login_id" ] ) ) {
        header( "location: ./login.php" );
        exit;
    }

} else {
    // 没有, 回到登录页
    header( "location: ./login.php" );
    exit;
}


// 如果代码可以运行到这里, 必定是登录成功的
// 1, 连接数据库
// 2, 准备 sql 语句
// 3, 执行 sql 语句
// 4, 通过 读取器 读取一行数据
// 5, 释放读取器
// 6, 关闭数据库连接

$conn = mysqli_connect( "127.0.0.1", "root", "123456", "baixiu" );
// mysqli_query( $conn, "set names utf8" );
$sql = "SELECT * FROM users WHERE id=" . $_SESSION[ "curr_user_login_id" ];
$reader = mysqli_query( $conn, $sql );  // is_resource, is_bool
$user_info = mysqli_fetch_assoc( $reader );  // is_array
// 理论上应该验证, 这里简化了
mysqli_free_result( $reader );
mysqli_close( $conn );


// 统计信息的查询
// 1> 所有的文章数量
// SELECT COUNT( * ) FROM posts;
$conn = mysqli_connect( "127.0.0.1", "root", "123456", "baixiu" );
$sql = "SELECT COUNT( * ) FROM posts";
$reader = mysqli_query( $conn, $sql );
$item = mysqli_fetch_row( $reader );
mysqli_free_result( $reader );
mysqli_close( $conn );
$post_total = $item[ 0 ];


// 2> 草稿的总数
// SELECT COUNT( * ) FROM posts WHERE status='drafted' ;
$conn = mysqli_connect( "127.0.0.1", "root", "123456", "baixiu" );
$sql = "SELECT COUNT( * ) FROM posts WHERE status='drafted'";
$reader = mysqli_query( $conn, $sql );
$item = mysqli_fetch_row( $reader );
mysqli_free_result( $reader );
mysqli_close( $conn );
$post_drafted_total = $item[ 0 ];



// 3> 分类的总数
// SELECT COUNT( * ) FROM categories;
$conn = mysqli_connect( "127.0.0.1", "root", "123456", "baixiu" );
$sql = "SELECT COUNT( * ) FROM categories";
$reader = mysqli_query( $conn, $sql );
$item = mysqli_fetch_row( $reader );
mysqli_free_result( $reader );
mysqli_close( $conn );
$category_total = $item[ 0 ];

// 4> 评论 总数
// SELECT COUNT( * ) FROM comments;
$conn = mysqli_connect( "127.0.0.1", "root", "123456", "baixiu" );
$sql = "SELECT COUNT( * ) FROM comments";
$reader = mysqli_query( $conn, $sql );
$item = mysqli_fetch_row( $reader );
mysqli_free_result( $reader );
mysqli_close( $conn );
$comment_total = $item[ 0 ];



// 5> 待审核
// SELECT COUNT( * ) FROM comments WHERE status='held';
$conn = mysqli_connect( "127.0.0.1", "root", "123456", "baixiu" );
$sql = "SELECT COUNT( * ) FROM comments WHERE status='held'";
$reader = mysqli_query( $conn, $sql );
$item = mysqli_fetch_row( $reader );
mysqli_free_result( $reader );
mysqli_close( $conn );
$comment_held_total = $item[ 0 ];

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
    <a href="./logout.php">退出</a>
    <h1>欢迎登录</h1>
    <h2>用户昵称: <?php echo $user_info[ "nickname" ] ?></h2>
    <h2>用户头像: <?php echo $user_info[ "avatar" ] ?></h2>

    <p>文章总数: <?php echo $post_total ?>( 草稿数量: <?php echo $post_drafted_total ?> )</p>
    <p>评论总数: <?php echo $comment_total ?>( 待审核数量: <?php echo $comment_held_total ?> )</p>
    <p>分类的总数: <?php echo $category_total ?></p>
</body>
</html>