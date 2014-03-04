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
    <?php echo CHtml::beginForm(); ?>

        <div id="forAdd" class="unit">
            <span class="unitText">
                <?php echo CHtml::label('Введите сюда свое новое мероприятие', 'text'); ?><br>
                <?php echo CHtml::textField('text'); ?>
            </span>
            <span class="unitNumber">
                <?php echo CHtml::textField('count', '1') ?>
            </span>
            <span class="unitType">
                <?php echo CHtml::dropDownList( 'type',
                                                '',
                                                array(
                                                    'Выбрать единицу' => array(
                                                        'hour' => 'часы',
                                                        'unit' => 'штуки',
                                                        'bout' => 'разы',
                                                    )
                                                )); ?>
            </span>
            <span>
                <?php echo CHtml::ajaxSubmitButton('Добавить', ''); ?>
            </span>
        </div>
    <?php CHtml::endForm(); ?>
</p>