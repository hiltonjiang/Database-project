<?php   
    header("content-type:text/html;charset=utf-8");  //设置页面内容是html  编码是utf-8
    error_reporting(E_ALL &~ E_NOTICE);     //屏蔽错误信息
    include 'connect.php';     //调用数据库连接文件
    session_start();
    $username = $_SESSION['username'];
    $name_encoded = base64_encode($username); 
    if($name_encoded == ""){
        echo "<script> alert('您还未登陆，请返回登录页进行登录');parent.location.href='login.html'; </script>";
    }
?>