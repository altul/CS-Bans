<?php
/**
 * System Settings View
 */

/**
 * @author Craft-Soft Team
 * @package CS:Bans
 * @version 1.0 beta
 * @copyright (C)2013 Craft-Soft.ru.  Все права защищены.
 * @link http://craft-soft.ru/
 * @license http://creativecommons.org/licenses/by-nc-sa/4.0/deed.ru  «Attribution-NonCommercial-ShareAlike»
 */

$page = 'System settings';
$this->pageTitle = Yii::app()->name . ' :: Admin center - ' . $page;

$this->breadcrumbs=array(
	'Admin center' => array('/admin/index'),
	$page,
);

$this->renderPartial('/admin/mainmenu', array('active' =>'site', 'activebtn' => 'websettings'));
?>
<h2>System settings</h2>
<?php
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'settings-form',
	'type'=>'horizontal',
	'enableAjaxValidation'=>true,
));
?>
<p class="note">Fields marked <span class="required">*</span> required.</p>
<fieldset>
	<legend>System</legend>
	<?php echo $form->errorSummary($model); ?>
	<?php //echo $form->dropDownListRow($model, 'default_lang', array('ru' => 'Русский', 'en' => 'English')); ?>
	<?php //echo $form->checkBoxRow($model, 'use_capture', array('1' => 'Да', '0' => 'Нет')); ?>
	<?php echo $form->checkBoxRow($model, 'auto_prune'); ?>
	<?php echo $form->textFieldRow($model, 'max_file_size'); ?>
	<?php echo $form->textFieldRow($model, 'cookie'); ?>
	<?php echo $form->textFieldRow($model, 'max_offences'); ?>
	<?php echo $form->textFieldRow($model, 'max_offences_reason'); ?>
	<legend>View</legend>
	<?php //echo $form->dropDownListRow($model, 'banner', array('---' => '---', 'amxbans.png' => 'amxbans.png')); ?>
	<?php //echo $form->textFieldRow($model, 'banner_url'); ?>
	<?php echo $form->dropDownListRow($model, 'design', $themes); ?>
	<?php echo $form->dropDownListRow($model, 'start_page', array(
		'/site/index' => 'Home',
		'/bans/index' => 'Banlist',
		'/serverinfo/index' => 'Servers',
		'/amxadmins/index' => 'Admins',
	));
	?>
	<legend>Comments</legend>
	<?php echo $form->checkBoxRow($model, 'use_comment'); ?>
	<?php echo $form->checkBoxRow($model, 'comment_all'); ?>
	<legend>Files</legend>
	<?php echo $form->checkBoxRow($model, 'use_demo'); ?>
	<?php echo $form->checkBoxRow($model, 'demo_all'); ?>
	<?php echo $form->textFieldRow($model, 'file_type'); ?>
	<legend>Banlist</legend>
	<?php echo $form->textFieldRow($model, 'bans_per_page'); ?>
	<?php echo $form->checkBoxRow($model, 'show_comment_count'); ?>
	<?php echo $form->checkBoxRow($model, 'show_demo_count'); ?>
	<?php echo $form->checkBoxRow($model, 'show_kick_count'); ?>
</fieldset>
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Save')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Reset')); ?>
</div>

<?php $this->endWidget(); ?>
