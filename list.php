
<?php
/*Database Connection*/
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'dm';
Global $dbconfig; // to use globally
$dbconfig = mysqli_connect($host,$username,$password,$database) or die("Une erreur s'est produite lors de la connexion à la base de données");
?>

<?php 
$result=mysqli_query($dbconfig,"SELECT * FROM todo");

?>
<table class="table" id=todoListTable>
	<thead>
		<th class="col-md-1">N°</th>
		<th class="col-md-9">Tâches</th>
		<th class="col-md-2"> <div class="pull-right">Statut</div></th>
	</thead>
	<tbody>
		<?php $i=1;?>
		<?php while($res = mysqli_fetch_assoc($result)){?>
		<tr>
			<td class="col-md-1"><?=$i;$i++;?></td>
			<td class="col-md-9"><?=$res['description']?></td>
			<td class="col-md-2">
				<div class="btn-group pull-right">

				<a style="margin-left: 2px" title="Modifier" class="btn btn-info btn-xs edit-button" id="edit_<?=$res['id']?>" onclick="checks(<?=$res['id']?>,'<?=addslashes($res['description'])?>');"><span class='glyphicon glyphicon-edit'></span></a>

				<?php if ($res['status'] < 1): ?>
					<a style="margin-left: 2px" title="Achever" class="btn btn-success btn-xs edit-button" id="checked_<?=$res['id']?>" onclick="completeItem(<?=$res['id']?>);"><span class='glyphicon glyphicon-check'></span></a>
				<?php endif ?>

				<a style="margin-left: 2px" title="Supprimer" class="btn btn-danger btn-xs delete-button" id="delete_<?=$res['id']?>" onclick="DeleteItem(<?=$res['id']?>);"><span class='glyphicon glyphicon-trash'></span></a>

				</div>
			</td>
		</tr>
		<?php }?>
	</tbody>
</table>
