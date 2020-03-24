<?php
    define('LOCAL_NAME', 'test');

if ($_SERVER['SERVER_NAME'] == LOCAL_NAME) {
    define('MYSQL_HOST', 'localhost');
    define('MYSQL_USER', 'root');
    define('MYSQL_PASS', '');
    define('MYSQL_NAME', 'test');
} else {
    define('MYSQL_HOST', 'mysql.zzz.com.ua');
    define('MYSQL_USER', 'bjtest73');
    define('MYSQL_PASS', 'db98a77fE4');
    define('MYSQL_NAME', 'yura_mtv');
}
    define('SCRIPT_CODE', '1234567890');

    session_start();

date_default_timezone_set("Europe/Moscow");

$unix = time() - (0*60*60);
$date_time = date("Y-m-d H:i:s", $unix);
