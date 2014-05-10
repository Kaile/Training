<?php 
/** 
 * @var $this Controller
 * @var $unitTypes UnitTypes
 */
?>

<h2 style="text-align: center">Добавить новую единицу измерения</h2>
<div class="form">
<?php 
	echo CHtml::beginForm('AddUnitType', 'POST', array('name' => 'UnitTypes'));
	echo CHtml::errorSummary($unitTypes);
?>
<div class="row">
	<?php 
	echo CHtml::activeLabel($unitTypes, 'name_ru'); 
	echo CHtml::activeTextField($unitTypes, 'name_ru');
	?>
</div>
<div class="row">
	<?php 
	echo CHtml::activeLabel($unitTypes, 'type'); 
	echo CHtml::activeTextField($unitTypes, 'type');
	?>
</div>
<div class="row">
	<?php echo CHtml::submitButton('Добавить');?>
</div>
	<?php echo CHtml::endForm();?>
</div>  
<?php if (!empty($list)):?>
    <br/>
    <hr style="width: 96%; margin: auto">
    <br><br>
    <h2 style="text-align: center">
        Список типов единиц измерений
    </h2>
    <div id="unitList">
        <table id="units">
            <thead>
                <th>Название единицы</th>
                <th>Обозначение типа единицы</th>
                <th>Операция</th>
            </thead>
            <tbody>
                <?php foreach ($list as $val): ?>
                    <tr>
                        <td><?php echo $val->name_ru; ?></td>
                        <td><?php echo $val->type; ?></td>
                        <td><?php echo CHtml::button('X', array('class' => 'delRow', 'id' => $val->id)); ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <div/>
<?php endif;