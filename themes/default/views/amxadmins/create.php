<?php
/**
 * View Adding Admin Servers
 */

/**
 * @author Craft-Soft Team
 * @package CS:Bans
 * @version 1.0 beta
 * @copyright (C)2013 Craft-Soft.ru.  Все права защищены.
 * @link http://craft-soft.ru/
 * @license http://creativecommons.org/licenses/by-nc-sa/4.0/deed.ru  «Attribution-NonCommercial-ShareAlike»
 */

$this->pageTitle = Yii::app()->name . ' :: Admin Center - Adding AmxModX Admin';
$this->breadcrumbs = array(
	'Admin Center' => array('/admin/index'),
	'AmxModX Admins' => array('admin'),
	'Adding AmxModX Admin'
);

$this->renderPartial('/admin/mainmenu', array('active' =>'server', 'activebtn' => 'servamxadmins'));

$this->menu=array(
	array('label'=>'Admin Management', 'url'=>array('admin')),
);
?>

<h2>Add AmxModX Admin</h2>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'webadmins' => new Webadmins)); ?>
