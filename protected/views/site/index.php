<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<script type="text/javascript" src="/js/userscripts/FormAddControll.js"></script>
<script type="text/javascript" src="/js/userscripts/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/js/userscripts/FormData.js"></script>

<h2 style="text-align: center">Добавить новое что-то</h2>
<form name="AddUnit" method="POST" action="/">

    <div id="forAdd">
        <span class="unitText">
            <?php echo CHtml::label('Введите сюда свое новое что-то', 'text'); ?><br>
            <?php echo CHtml::textField('text', '', array('id' => 'inputAdd')); ?>
        </span>
        <span class="unitNumber">
            <?php echo CHtml::textField('count', '1', array('id' => 'countAdd')) ?>
        </span>
        <span class="unitType">
            <?php 
                $arrlist = array();
                foreach ($unittypes as $val) {
                    $arrlist[$val->type] = $val->name_ru;
                }
                $list = array('Выбрать единицу' => $arrlist);
                echo CHtml::dropDownList('type', '', $list);
            ?>
        </span>
        <span>
            <?php echo CHtml::button('Добавить', array('id' => 'btnAdd')); ?>
        </span>
    </div>
</form>
<h3 style="text-align: center; margin-top: 20px;">
    <form action="." method="POST">
        <?php echo CHtml::label('Изменить дату', 'chDate'); ?>
        <?php echo CHtml::textField('chDate'); ?>
        <?php echo CHtml::submitButton('Выполнить'); ?>
    </form>
</h3>

<?php if (!empty($statistic)):?>
    <br><br>
    <hr style="width: 96%; margin: auto">
    <br><br>
    <h2 style="text-align: center">
        <?php $chDate = (!isset($_POST['chDate'])) ? 'now' : $_POST['chDate']; ?>
        Список чего-то (<?php echo str_replace('/', '.', $this->getWeekDateInterval(DAY_BEGIN, 7, $chDate)); ?>)
    </h2>
    <div id="unitList">
        <table id="units">
            <thead>
                <th>Название мероприятия</th>
                <th>Количество</th>
                <th>Единица</th>
                <th>Операция</th>
            </thead>
            <tbody>
                <?php foreach ($statistic as $val): ?>
                    <tr>
                        <td><?php echo $val->text; ?></td>
                        <td><?php 
                            echo '<span>' . intval($val->count) . '</span>';
                            echo '&nbsp;&nbsp;';
                            echo CHtml::button('+', array('class' => 'changeCount', 'op' => 'inc', 'id' => $val->id));
                            echo CHtml::button('--', array('class' => 'changeCount', 'op' => 'dec', 'id' => $val->id));
                        ?></td>
                        <td><?php echo $val->type; ?></td>
                        <td><?php echo CHtml::button('X', array('class' => 'delRow', 'id' => $val->id)); ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <div/>
<?php endif; ?>