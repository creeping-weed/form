<?php

// 删除 session
// session_start();
// unset( $_SESSION[ "curr_user_login_id" ] );
// session_destroy();


// 思路:
// 1, 通过点击 index.php 页面的退出按钮
// 2, 删除 session 数据
// 3, 回到登录页

session_start();
unset( $_SESSION[ "curr_user_login_id" ] );
session_destroy();

header( "location: ./login.php" );

?>