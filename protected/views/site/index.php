<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
    <h2 style="text-align: center">Добавить новое мероприятие</h2>
    <?php echo CHtml::form(); ?>

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
                <?php echo CHtml::ajaxSubmitButton('Добавить', Yii::app()->baseUrl . 'index.php/site/addunit/', array('update' => '#unitList')); ?>
                
            </span>
        </div>
    <?php CHtml::endForm(); ?>
    
    
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
                            <?php echo $val->count; ?>
                        </span>
                        <span class="unitType">
                            <?php echo $val->type; ?>
                        </span>
                </div>
            <?php endforeach ?>
        <div/>
        <div id="unitList"><div/>
    <?php endif ?>