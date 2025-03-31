<div class="row">
<div class="col-sm-12">
	<?php  if($this->session->flashdata('msg') != null) { ?>
		<div class="alert alert-dismissible alert-info">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <strong>Message : </strong> <?php echo $this->session->flashdata('msg'); ?> 
		</div>
	<?php } ?>
	<?php
	// echo '<pre>';
	// var_dump($data);
	// echo '</pre>';
	?>
	<table class="table table-condensed table-hover">
		<thead>
			<tr>
				<th>#</th>
				<th>User</th>
				<th>Question</th>
				<th>Response</th>
				<th>Points</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$i = 1;
			if (isset($data) && count($data)>=1) {
				 foreach ($data as $key => $value) {
				 	 


			 		?>

			 		<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $value->username; ?></td>
						<td><?php echo $value->question; ?></td>
						<td><?php echo $value->data; ?></td>
						<td><?php echo $value->points; ?></td>
						
						<td><a href="response/delete/<?php echo $value->response_id ?>" class="btn btn-sm btn-primary">delete</a></td>
 					</tr>
			 		<?php
			 	 
			 		$i+=1;
				}
			}else{
				?>
				<tr><td colspan="5">no Rewards found! try creating new Reward.</td></tr>
				<?php
			}
			
			?>
			
		</tbody>
	</table>
</div>

</div>