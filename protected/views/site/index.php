<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<script type="text/javascript" src="/assets/userscripts/forms.js"></script>
<h2 style="text-align: center">Добавить новое мероприятие</h2>
<form method="POST" action="/">

    <div id="forAdd" class="unit">
        <span class="unitText">
            <?php echo CHtml::label('Введите сюда свое новое мероприятие', 'text'); ?><br>
            <?php echo CHtml::textField('text', '', array('id' => 'inputAdd')); ?>
        </span>
        <span class="unitNumber">
            <?php echo CHtml::textField('count', '1') ?>
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
    <hr >
    <h2 style="text-align: center">Список мероприятий</h2>
    <div>
        <?php foreach ($statistic as $val): ?>
            <div class="unit">
                <span class="unitText">
                        <?php echo $val->text; ?>
                    </span>
                    <span class="unitNumber">
                        <?php echo intval($val->count); ?>
                    </span>
                    <span class="unitType">
                        <?php echo $val->type; ?>
                    </span>
            </div>
        <?php endforeach ?>
    <div/>
    <div id="unitList"/>
<?php endif ?>