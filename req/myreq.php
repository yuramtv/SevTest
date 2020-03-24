<?php
########################
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
//ini_set('max_execution_time', 0);
###############

include("../block/config.php");
include("../class/user.php");
include("../block/function.php");

if (isset($_GET['key']) and $_GET['key']==1) {
    $User = new User();
    try {
        if ($User->login == null) {
            throw new Exception("Авторизуйтесь для выполнения запроса");
        }
        //$url = 'http://ip.jsontest.com';
        $url = 'https://api.ipify.org?format=json';

        $raw_data = file_get_contents($url);

        //$raw_data = (object)Array('ip'=>'185.16.31.227');

        if ($raw_data === false) {
            throw new Exception("Ошибка удалённого сервера");
        }

        $data = json_decode($raw_data);
        $ip = $data->ip;

        $result = DB()->prepare('INSERT INTO `iphistory` (`ip`, `login`, `datetime`) VALUES ( INET_ATON(?), ?, ?)')->execute(array($ip, $User->login, $date_time));

        if (!$result) {
            throw new Exception("Ошибка записи в БД");
        }

        $out['result'] = true;
        $out['ip'] = $ip;
    } catch (Exception $e) {
        $out['result'] = false;
        $out['error'] = $e->getMessage();
    }
    exit(json_encode($out));
}
