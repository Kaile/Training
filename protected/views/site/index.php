<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<script type="text/javascript" src="/assets/userscripts/forms.js"></script>
<h2 style="text-align: center">Добавить новое мероприятие</h2>
<form method="POST" action="/">

    <div id="forAdd">
        <span class="unitText">
            <?php echo CHtml::label('Введите сюда свое новое мероприятие', 'text'); ?><br>
            <?php echo CHtml::textField('text', '', array('id' => 'inputAdd')); ?>
        </span>
        <span class="unitNumber">
            <?php echo CHtml::textField('count', '1', array('id' => 'countAdd')) ?>
        </span>
        <span class="unitType">
            <?php 
                $list = array('Выбрать единицу' => array(
                                    'hour' => 'часы',
                                    'unit' => 'штуки',
                                    'bout' => 'разы',
                                 )
                             );
                echo CHtml::dropDownList('type', '', $list);
            ?>
        </span>
        <span>
            <?php echo CHtml::button('Добавить', array('id' => 'btnAdd')); ?>
        </span>
    </div>
</form>


<?php if (!empty($statistic)):?>
    <br><br>
    <hr style="width: 96%; margin: auto">
    <br><br>
    <h2 style="text-align: center">Список мероприятий</h2>
    <div id="unitList">
        <table id="units">
            <thead>
                <th>Название мероприятия</th>
                <th>Количество</th>
                <th>Единицы</th>
            </thead>
            <tbody>
                <?php foreach ($statistic as $val): ?>
                    <tr>
                        <td><?php echo $val->text; ?></td>
                        <td><?php echo intval($val->count); ?></td>
                        <td><?php echo $val->type; ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <div/>
<?php endif ?>