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
				<th>First name</th>
				<th>Last Name</th>
				<th>State</th>
				<th>Zip</th>
				<th>Country</th>
				<th>Mobile</th>
				<th>Edit</th>
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
						<td><?php echo $value->firstName; ?></td>
						<td><?php echo $value->lastName; ?></td>
						<td><?php echo $value->uState; ?></td>
						<td><?php echo $value->uZipCode; ?></td>
						<td><?php echo $value->uCountry; ?></td>
						<td><?php echo $value->uMobNum; ?></td>
						 
						<td><a href="user/edit/<?php echo $value->userID; ?>" class="btn btn-sm btn-default">edit</a></td>
						<td><a href="user/delete/<?php echo $value->userID; ?>" class="btn btn-sm btn-primary">delete</a></td>
 					</tr>
			 		<?php
			 		 
			 		$i+=1;
				}
			}else{
				?>
				<tr><td colspan="9">no user found! try creating new users.</td></tr>
				<?php
			}
			
			?>
			
		</tbody>
	</table>
</div>

</div>