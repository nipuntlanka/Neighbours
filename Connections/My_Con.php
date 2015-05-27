<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_My_Con = "localhost";
$database_My_Con = "neighbors";
$username_My_Con = "root";
$password_My_Con = "helpshad32";
$My_Con = mysql_pconnect($hostname_My_Con, $username_My_Con, $password_My_Con) or trigger_error(mysql_error(),E_USER_ERROR); 
?>