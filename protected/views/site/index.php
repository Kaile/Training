<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1 style="text-align: center">Список новостей</h1>
<p></p>
<p>

    <!-- Поделись своей проблемой анонимно и получи анонимный четный ответ -->
    <!-- Поделись своей проблемой анонимно и получи анонимный четный ответ -->
    <?php
        foreach ($param as $res) {
            echo $res[0] . PHP_EOL;
            echo $res[1] . PHP_EOL . PHP_EOL;
        }
    ?>
</p>