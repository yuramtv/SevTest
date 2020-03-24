<?php

# Функция: объект класса для работы с базой данных.
function & DB()
{
    static $oClass = null;
    if (is_null($oClass)) {
        try {
            $oClass = new PDO('mysql:host='.MYSQL_HOST.';dbname='.MYSQL_NAME.';charset=utf8', MYSQL_USER, MYSQL_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            $oClass->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die('Database error '.$e->getMessage());
        }
    }
    return $oClass;
}

function getFieldData($data)
{
    $data = htmlspecialchars(stripslashes(trim($data)));
    return $data;
}

function debug($value)
{
    switch (gettype($value)) {
        default:
            $main = print_r($value, true);
            break;
        case "string":
            $main = $value;
            break;
    }
    echo "<pre>".$main."</pre>";
}
