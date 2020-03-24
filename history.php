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
  <title>История запросов</title>
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
<body ng-controller="TestController"  >
<p>
<div class = "container">

    <div id="wrapper">
        <div id="header">
            <div class="logo">
                <a href="/">Header</a>
            </div>
<?php
include("block/menu.php"); ?>
        </div>
        <div id="content">
            <hr/>

            <div class="col-sm-8 panel" >
<?php
if (isset($error)) {
                echo "<div class='alert alert-danger' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span></button>
                <strong>".$error."</strong>
            </div>";
} ?>

                <table class='table table-hover table-bordered'>
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>ip (inet)</th>
                        <th>ip (var)</th>
                        <th>login</th>
                        <th>time</th>
                    </tr>
                    </thead>
                    <tbody>
<?php
                    $query = "SELECT *,INET_NTOA(ip) as var_ip FROM `iphistory` ORDER BY id DESC";
                    $myrow = DB()->query($query)->fetchAll(PDO::FETCH_ASSOC);

foreach ($myrow as $item) {
                        echo "<tr>
                          <th>" . $item['id'] . "</th>
                          <th>" . $item['ip'] . "</th>
                          <th>" . $item['var_ip']. "</th>
                          <th>" . $item['login'] . "</th>
                          <th>" . $item['datetime'] . "</th>
                      </tr>";
} ?>
                    </tbody>
                </table>

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
