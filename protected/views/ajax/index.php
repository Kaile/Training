<?php
/* @var $this AjaxController */

$this->breadcrumbs=array(
	'Ajax',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<p>
<?php echo CHtml::form();

echo CHtml::label('Текст', 'input');
echo CHtml::textArea('input', $input);

echo CHtml::label('Результат', 'output');
echo CHtml::textArea('output', $output);

echo CHtml::ajaxSubmitButton('Преобразовать', '', ['type' => 'post', 'update' => '#output'], ['type' => 'submit']);
echo CHtml::endForm();
?>
</p>
