<?php
    header("content-type:text/html;charset=utf-8");  //设置页面内容是html  编码是utf-8
    error_reporting(E_ALL &~ E_NOTICE);     //屏蔽错误信息
    include 'connect.php';     //调用数据库连接文件

    $sql = "SELECT keyword,COUNT(*) AS keywordcount FROM keyword GROUP BY keyword ORDER BY keywordcount DESC limit 5";
    $res = $conn->query($sql);
    $row = $res->fetch_all(MYSQLI_ASSOC);
    /*for($i=0; $i<5; $i++){
        $row[$i]['id'] = $i + 1;
        echo $row[$i]['id'];
        echo $row[$i]['keyword'];
        echo '<br>';
    }*/
    echo json_encode($row); //keyword(关键词)
?>