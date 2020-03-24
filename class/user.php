<?php

class User
{
    public $login = null;

    public function __construct()
    {
        $this->checkAuth();
    }

    public function auth($login, $pass)
    {
        try {
            $out = array();

            if (empty($login) or empty($pass)) {
                throw new Exception("некорректно введены логин или пароль");
            }

            $query = "SELECT `id`,`passwd` FROM `users` WHERE `login` = '$login'";

            $myrow = DB()->query($query)->fetchAll(PDO::FETCH_ASSOC);

            if ($pass != $myrow[0]['passwd']) {
                throw new Exception("неверный логин или пароль");
            }

            $_SESSION['id'] = $myrow[0]['id'];

            $_SESSION['sClientHash'] = md5($myrow[0]['id'].SCRIPT_CODE);

            $this->login = $login;

            $out['result'] = true;
        } catch (Exception $e) {
            $out['result'] = false;
            $out['error'] = $e->getMessage();
        }
        return $out;
    }

    private function checkAuth()
    {
        if ($this->login != null) {
            return $this->login;
        }

        if (isset($_SESSION['id']) and isset($_SESSION['sClientHash'])) {
            $ClientID = (int)$_SESSION['id'];
            $sClientHash = substr($_SESSION['sClientHash'], 0, 32);

            if (md5($ClientID.SCRIPT_CODE) == $sClientHash) {
                if (($info = $this->getUser($ClientID)) != null) {
                    $this->login = $info['login'];
                }
            }
        }
    }

    private function getUser($ClientID)
    {
        $query = "SELECT * FROM `users` WHERE `id` = '$ClientID'";
        $out = DB()->query($query)->fetch(PDO::FETCH_ASSOC);

        return $out;
    }

    public function out()
    {
        unset($_SESSION['id']);
        unset($_SESSION['sClientHash']);

        $this->login = null;
    }
}
