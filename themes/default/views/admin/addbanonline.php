<?php
/**
 * View add ban online
 */

/**
 * @author Craft-Soft Team
 * @package CS:Bans
 * @version 1.0 beta
 * @copyright (C)2013 Craft-Soft.ru.  Все права защищены.
 * @link http://craft-soft.ru/
 * @license http://creativecommons.org/licenses/by-nc-sa/4.0/deed.ru  «Attribution-NonCommercial-ShareAlike»
 */

$page = 'Add online ban';
$this->pageTitle = Yii::app()->name . ' - ' . $page;

$this->breadcrumbs=array(
	'Admin center' => array('/admin/index'),
	$page,
);

Yii::app()->clientScript->registerScript('', '

$(".servtr").live("click", function(){
	$("#loading").show();
	var sid = this.id.substr(6);
	$.post(
		"",
		{
			"'.Yii::app()->request->csrfTokenName.'": "'.Yii::app()->request->csrfToken.'",
			"sid": sid
		},
		function(data){
			eval(data);
		}
	);
});
$.post(
	"'.Yii::app()->createUrl('/serverinfo/getinfo', array('', 'banonline')).'",
	{"'.Yii::app()->request->csrfTokenName.'": "'.Yii::app()->request->csrfToken.'"},
	function(data) {$("#servers").html(data);}
);'
);

Yii::app()->clientScript->registerScript('playeraction', '
function playeraction(action, player, server)
{
	var reasontext;
	var profile = false;
	var reason = null;

	switch (action)
	{
		case "ban":
			reasontext = "Ban user"
			break;
		case "kick":
			reasontext = "Kick user"
			break;
		default:
			return false;
	}

	if(!confirm(reasontext + " " + player + "?")) {
		return false;
	}
	if(action == "ban")
	{
		var reason = prompt("Enter the reason for the ban", "Cheater");
		if(!reason)
			return alert("Enter a reason!");
		var bantime = prompt("Enter the ban time in minutes (1440 - day, 10080 - week, 43200 - month)", "1440");
		if(!bantime)
			return alert("Enter the ban term!");
	}

	$("#loading").show();
	$.post(
		"'.Yii::app()->createUrl('/serverinfo/context').'?id=" + server,
		{
			"'.Yii::app()->request->csrfTokenName.'": "'.Yii::app()->request->csrfToken.'",
			"action": action,
			"player": "#" + player,
			"reason": reason,
			"time": bantime
		},
		function(data){eval(data);}
	);
}
', CClientScript::POS_HEAD);

$this->renderPartial('/admin/mainmenu', array('active' =>'main', 'activebtn' => 'addbanonline'));
?>
<h2>Add Ban Online</h2>
<table class="table table-bordered table-condensed table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th>Address</th>
			<th>Version</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($servers as $server):?>
		<tr class="servtr" id="server<?php echo intval($server->id) ?>">
			<td><?php echo CHtml::encode($server->hostname)?></td>
			<td><?php echo CHtml::encode($server->address)?></td>
			<td><?php echo CHtml::encode($server->amxban_version)?></td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>
<table class="table table-bordered table-condensed table-striped">
	<thead>
		<tr>
			<th style="width: 15px">#</th>
			<th>Ник</th>
			<th style="width: 150px">Steam ID</th>
			<th style="width: 100px">IP</th>
			<th style="width: 50px">ID</th>
			<th style="width: 50px">Тип</th>
			<th style="width: 50px"></th>
		</tr>
	</thead>
	<tbody id="players"></tbody>
</table>
