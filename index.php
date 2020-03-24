<?php
include("block/config.php");
include("class/user.php");
include("block/function.php");

$User = new User();

if (isset($_POST['login']) and isset($_POST['pass'])) {
    $login = getFieldData($_POST['login']);

    $pass = getFieldData($_POST['pass']);

    $info = $User->auth($login, $pass);

    if (!$info['result']) {
        $error = $info['error'];
        $_GET['enter'] = 1;
    }
}

if (isset($_GET['out'])) {
    $User->out();
}
?>
<!DOCTYPE html>
<html ng-app="MyApp" >

<head>
  <title>Тестовое задание</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <script type="text/javascript" src="js/angular.min.js"></script>

    <!--<script type="text/javascript" src="bootstrap/js/jquery.min.js"></script>-->
    <script src="/bootstrap/js/jquery.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <!--<script type="text/javascript" src="js/angular.min-old.js"></script>-->
    <script type="text/javascript" src="js/script.js"></script>

</head>
<body   ng-controller="TestController"  >
<p>
<div class = "container">

    <div id="wrapper">
        <div id="header">
            <div class="logo">
                <a href="/">Header</a>
            </div>

            <?php include("block/menu.php"); ?>

        </div>
        <div id="content">
            <hr/>

            <div class="col-sm-4 panel" >
<?php
if (isset($error)) {
                echo "<div class='alert alert-danger' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span></button>
                <strong>".$error."</strong>
            </div>";
}
if (isset($_GET['enter'])) { ?>
            <form action="/" method="POST">
                <div class="form-group">
                    <label for="login">Логин</label>
                    <input type="text" class="form-control" name="login" value="<?= (isset($_POST['login'])?$_POST['login']:"") ?>" required />
                </div>
                <div class="form-group">
                    <label for="pass">Пароль</label>
                    <input type="password" class="form-control" name="pass" value="" required /><br />
                    <input type="submit" class="btn btn-primary" value="Вход" />
                </div>
            </form>
<?php
} elseif ($User->login) { ?>
                <button ng-click="myrequest()" type="button" class="btn btn-info">Выполнить запрос</button>
                <div ng-show="ip" ng-class="myclass" role='alert'>
                    <button ng-click="bannerClose()" type='button' class='close'>
                        <span aria-hidden='true'>&times;</span></button>
                    <strong ng-bind="ip" ></strong>
                </div>
<?php
} else {?>
                <h1>Авторизуйтесь, пожалуйста, для продолжения</h1>
<?php
} ?>
            </div>
        </div>
        <div id="footer">
            <hr/>
            <em></em>
            <br/>
            <em>Footer</em>
            <br/>
            <em></a></em>
        </div>
    </div>
</div>

</body>
</html>