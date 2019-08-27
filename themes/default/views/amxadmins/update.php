<?php
/**
 * Admin server editing view
 */

/**
 * @author Craft-Soft Team
 * @package CS:Bans
 * @version 1.0 beta
 * @copyright (C)2013 Craft-Soft.ru.  Все права защищены.
 * @link http://craft-soft.ru/
 * @license http://creativecommons.org/licenses/by-nc-sa/4.0/deed.ru  «Attribution-NonCommercial-ShareAlike»
 */

$this->pageTitle = Yii::app()->name . ' :: Admin Center - Edit admin';
$this->breadcrumbs = array(
	'Admin Center' => array('/admin/index'),
	'AmxModX Admins' => array('admin'),
	'Edit Admin ' . $model->nickname
);

$this->renderPartial('/admin/mainmenu', array('active' =>'server', 'activebtn' => 'servamxadmins'));

$this->menu=array(
	array('label'=>'Add AmxModX Admin', 'url'=>array('create')),
	array('label'=>'Managing AmxModX Admins', 'url'=>array('admin')),
);
?>

<h2>Edit AmxModX Admin <?php echo $model->nickname; ?></h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
