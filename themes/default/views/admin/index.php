<?php
/**
 * View of the main page of the admin center
 */

/**
 * @author Craft-Soft Team
 * @package CS:Bans
 * @version 1.0 beta
 * @copyright (C)2013 Craft-Soft.ru.  Все права защищены.
 * @link http://craft-soft.ru/
 * @license http://creativecommons.org/licenses/by-nc-sa/4.0/deed.ru  «Attribution-NonCommercial-ShareAlike»
 */

$page = 'Admin center';
$this->pageTitle = Yii::app()->name . ' - ' . $page;

$this->breadcrumbs=array(
	$page,
);

Yii::app()->clientScript->registerScript('adminaction', "
$.post('".$this->createUrl('version')."', {'version': 1}, function(data){
	$('#version').html(data);
});
$('.bdaction').click(function(){
	if(!confirm('Do you confirm your actions?'))
	{
		return false;
	}
	if(this.id == 'truncatebans' && !confirm('All bans will be deleted. Are you sure?'))
	{
		return false;
	}
	$('#loading').show();
	$.post('".Yii::app()->createUrl('admin/actions')."', {'ajax': 1, 'action': this.id}, function(data) {eval(data);});
})
");

$this->renderPartial('/admin/mainmenu', array('active' =>'main', 'activebtn' => 'admsystem'));
$sysprefs = Prefs::sysprefs();
?>
<h2>System Information</h2>
<div class="container">
  <div class="row-fluid">
    <div class="span8">
		<table class="table table-bordered table-condensed">
			<tr>
				<td class="info" colspan="2">
					<b>Server settings</b>
				</td>
			</tr>
			<tr>
				<td style="width: 200px">
					Site version
				</td>
				<td id="version">
					<?php echo Yii::app()->params['Version'] ?> <?php echo CHtml::image(Yii::app()->baseUrl . '/images/loading.gif'); ?>
				</td>
			</tr>
			<?php
			foreach($sysprefs['info'] as $key => $val): ?>
			<tr>
				<td style="width: 200px">
					<?php echo $key; ?>
				</td>
				<td>
					<?php echo $val; ?>
				</td>
			</tr>
			<?php endforeach; ?>
			<tr>
				<td class="info" colspan="2">
					<b>PHP modules</b>
				</td>
			</tr>
			<?php foreach($sysprefs['modules'] as $key => $val): ?>
			<tr>
				<td style="width: 200px">
					<?php echo $key; ?>
				</td>
				<td>
					<?php echo $val; ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
    </div>
    <div class="span4">
		<table class="items table table-bordered table-condensed">
			<thead>
				<tr>
					<th>Statistics</th>
				</tr>
			</thead>
			<tbody>
				<tr class="odd">
					<td>
						<div class="pull-left muted">
							<b>Database size</b>
						</div>
						<div class="pull-right">
							<?php echo Prefs::db_size(); ?>
						</div>
					</td>
				</tr>
				<tr class="odd">
					<td>
						<div class="pull-left muted">
							<b>The number of bans in the database</b>
						</div>
						<div class="pull-right">
							<?php echo $sysinfo['bancount']; ?>
						</div>
					</td>
				</tr>
				<tr class="odd">
					<td>
						<div class="pull-left muted">
							<b>Active Bans</b>
						</div>
						<div class="pull-right">
							<?php echo $sysinfo['bancount']; ?>
						</div>
					</td>
				</tr>
				<tr class="odd">
					<td>
						<div class="pull-left muted">
							<b>Comments</b>
						</div>
						<div class="pull-right">
							<?php echo $sysinfo['commentscount']; ?>
						</div>
					</td>
				</tr>
				<tr class="odd">
					<td>
						<div class="pull-left muted">
							<b>Files</b>
						</div>
						<div class="pull-right">
							<?php echo $sysinfo['filescount']; ?>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		<br>
		<table class="items table table-bordered table-condensed">
			<thead>
					<tr>
						<th>Actions</th>
					</tr>
				</thead>
			<tbody>
				<tr class="odd">
					<td>
						<input type="button" class="btn btn-small btn-info bdaction span12" id="clearcache" value="Clear cache">
					</td>
				</tr>
				<tr class="odd">
					<td>
						<input type="button" class="btn btn-small btn-info bdaction span12" id="optimizedb" value="Base optimization">
					</td>
				</tr>
				<!--
				<tr class="odd">
					<td>
						<div class="left muted">
							<b>Ban table optimization</b>
						</div>
						<div class="right">
							<input type="button" class="btn btn-small btn-info bdaction" id="optimizebanstable" value="Ok">
						</div>
					</td>
				</tr>
				-->
				<tr class="odd">
					<td>
					    <input type="button" class="btn btn-small btn-info bdaction span12" id="truncatebans" value="Clear banlist">
					</td>
				</tr>
			</tbody>
		</table>
    </div>
  </div>
</div>
