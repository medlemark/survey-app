

	<?php  if(validation_errors()) { ?>
		<div class="alert alert-dismissible alert-danger">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <strong>Message : </strong> <?php echo validation_errors(); ?> 
		</div>
	<?php } ?>
<div class="row">

<div class="col-sm-6">

<?php echo form_open('user/save'); ?>
	<legend>Create a new User</legend>

	<div class="form-group">
		<label for="fname">First Name</label>
		<input type="text" name="fname" class="form-control" id="fname" placeholder="First Name">
	</div>
	<div class="form-group">
		<label for="lname">Last Name</label>
		<input type="text" name="lname" class="form-control" id="lname" placeholder="Last Name">
	</div>
	<div class="form-group">
		<label for="adr1">Address 1</label>
		<input type="text" name="adr1" class="form-control autocomplete" id="adr1" placeholder="Address 1 ">
		 
	</div>
	<div class="form-group">
		<label for="adr2">Address 2</label>
		<input type="text" name="adr2" class="form-control autocomplete" id="adr2" placeholder="Address 2 ">
	</div>
	<div class="form-group">
		<label for="mob">Mobile</label>
		<input type="text" name="mob" class="form-control" id="mob" placeholder="Mobile">
	</div>
	
	<button type="submit" class="btn btn-primary">Save</button>

</div>
 <div class="col-sm-6">
 	<div class="form-group">
		<label for="state">State</label>
		<input type="text" name="state" class="form-control" id="state" placeholder="State">
	</div>
	<div class="form-group">
		<label for="zipcode">Zipcode</label>
		<input type="text" name="zipcode" class="form-control" id="zipcode" placeholder="Zipcode">
	</div>
	<div class="form-group">
		<label for="country">Country</label>
		<input type="text" name="country" class="form-control" id="country" placeholder="Country">
	</div>
 	<legend>Provide User Login</legend>

 	<div class="form-group">
		<label for="username">Username</label>
		<input type="text" name="username" class="form-control" id="username" placeholder="User Name">
	</div>
	<div class="form-group">
		<label for="password">Password</label>
		<input type="text" name="password" class="form-control" id="password" placeholder="Password">
	</div>
 </div>
</form>
</div>