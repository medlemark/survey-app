<div class="row">
<div class="col-sm-12">
	<?php  if($this->session->flashdata('msg') != null) { ?>
		<div class="alert alert-dismissible alert-info">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <strong>Message : </strong> <?php echo $this->session->flashdata('msg'); ?> 
		</div>
	<?php } ?>
	<table class="table table-condensed table-hover">
		<thead>
			<tr>
				<th>#</th>
				<th>Title</th>
				<th>Questions</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$i = 1;
			if (isset($data) && count($data)>=1) {
				 foreach ($data as $key => $value) {
				 	if($value->total != 0){


			 		?>

			 		<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $value->title; ?></td>
						<td><?php echo  $value->total; ?></td>
						<td><a href="survey/edit/<?php echo $value->survey_id ?>" class="btn btn-sm btn-default">edit</a></td>
						<td><a href="survey/delete/<?php echo $value->survey_id ?>" class="btn btn-sm btn-primary">delete</a></td>
 					</tr>
			 		<?php
			 		}
			 		$i+=1;
				}
			}else{
				?>
				<tr><td colspan="5">no survey found! try creating new survey.</td></tr>
				<?php
			}
			
			?>
			
		</tbody>
	</table>
</div>

</div>