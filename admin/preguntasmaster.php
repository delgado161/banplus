<?php

// Call Row_Rendering event
$preguntas->Row_Rendering();

// id_encuesta
// pregunta
// estatus
// Call Row_Rendered event

$preguntas->Row_Rendered();
?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<tbody>
<?php if ($preguntas->id_encuesta->Visible) { // id_encuesta ?>
		<tr id="r_id_encuesta">
			<td class="ewTableHeader"><?php echo $preguntas->id_encuesta->FldCaption() ?></td>
			<td<?php echo $preguntas->id_encuesta->CellAttributes() ?>>
<div<?php echo $preguntas->id_encuesta->ViewAttributes() ?>><?php echo $preguntas->id_encuesta->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($preguntas->pregunta->Visible) { // pregunta ?>
		<tr id="r_pregunta">
			<td class="ewTableHeader"><?php echo $preguntas->pregunta->FldCaption() ?></td>
			<td<?php echo $preguntas->pregunta->CellAttributes() ?>>
<div<?php echo $preguntas->pregunta->ViewAttributes() ?>><?php echo $preguntas->pregunta->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($preguntas->estatus->Visible) { // estatus ?>
		<tr id="r_estatus">
			<td class="ewTableHeader"><?php echo $preguntas->estatus->FldCaption() ?></td>
			<td<?php echo $preguntas->estatus->CellAttributes() ?>>
<div<?php echo $preguntas->estatus->ViewAttributes() ?>><?php echo $preguntas->estatus->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
