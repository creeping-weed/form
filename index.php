<?php

// 思路:
// 1, 检查是否有一个 PHPSESSID 的值
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
        
        .content input[type=text] {
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
        
        .content input[type=text]:focus {
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
    </style>

    <body>
        <div class="content">
            <h3>个人信息</h3>
            <form action="./insert.php" method="GET">
                <div>
                    <label for="name">姓名:</label>
                    <input type="text" id="name" placeholder="请输入姓名" autocomplete="off" name="name">
                </div>
                <div>
                    <label for="age">年龄:</label>
                    <input type="text" id="age" placeholder="请输入年龄" autocomplete="off" name="age">
                </div>
                <div>
                    <label for="height">身高:</label>
                    <input type="text" id="height" placeholder="请输入身高:cm" autocomplete="off" name="height">
                </div>
                <div>
                    <label for="phone">电话:</label>
                    <input type="text" id="phone" placeholder="请输入电话" autocomplete="off" name="phone">
                </div>
                <div class="btnBox">
                    <input type="reset" value="重置" class="btn btn-danger">
                    <input type="submit" value="提交" class="btn btn-success">
                </div>
            </form>
        </div>
    </body>

    </html>