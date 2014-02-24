<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<p>
    <?php if (!empty($statistic)):?>
        <h2 style="text-align: center">Список мероприятий</h2>
        <div id="unitList" class="unit">

        </div>
        <hr >
    <?php endif?>

    <h2 style="text-align: center">Добавить новое мероприятие</h2>
    <form name="addUnit" action="/site/index" method="post">
        <div id="forAdd" class="unit">
            <span class="unitText">
                <input value="Введите сюда свое новое мероприятие" type="text" id="textAdd" name="Text"/>
            </span>
            <span class="unitNumber">
                <input value="1" type="text" id="numAdd" name="Count"/>
            </span>
            <span class="unitType">
                <select class="selectType" name="Type">
                    <option disabled selected>Выбрать единицу</option>
                    <option value="hour">Часы</option>
                    <option value="unit">Штуки</option>
                    <option value="bout">Разы</option>
                </select>
            </span>
            <span>
                <input class="btnAdd" type="button" value="Добавить" />
            </span>
        </div>
    </form>
</p>