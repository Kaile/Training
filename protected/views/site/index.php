<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1 style="text-align: center">Список мероприятий</h1>
<p>
    <div id="forAdd" class="unit">
        <span class="unitText">
            <input value="Введите сюда свое новое мероприятие" type="text" id="textAdd" />
        </span>
        <span class="unitNumber">
            <input value="1" type="text" id="numAdd" />
        </span>
        <span class="unitType">
            <select class="selectType">
                <option disabled selected>Выбрать единицу</option>
                <option value="hour">Часы</option>
                <option value="unit">Штуки</option>
                <option value="bout">Чвсы</option>
            </select>
        </span>
        <span class="btnAdd">
            <input type="button" value="Добавить" />
        </span>
    </div>

</p>