<?php
 	echo "Hello PHP<br/>";
    $conn = mysqli_connect("mysql","root","test123456");
    print_r($conn);
    if(!$conn){
        echo "连接数据库失败";
    }else{
        echo "连接数据库成功";
    }
    phpinfo();