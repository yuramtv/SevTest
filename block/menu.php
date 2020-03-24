<div class="menu">
                <ul>
                    <li><a href="/">Главная</a></li>
                    <li><a href="/history.php">История</a></li>
<?php
if ($User->login != null) { ?>
    <li><?= $User->login ?> [ <a href="/?out=1"><span style="font-size:10px">выйти</span></a> ]</li>
<?php
} else {
    echo "<li><a href='/?enter=1'>Войти</a></li>";
} ?>
</ul>
</div>
