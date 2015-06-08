<?php
echo("hello php world!");
header("Content-Type:text/html;charset=utf-8");
$link=mysqli_connect("127.0.0.1","root","Focus_01");
if(!$link) echo "FAILD!连接错误，用户名密码不对";
else echo "OK!可以连接"; 
Phpinfo();

?>