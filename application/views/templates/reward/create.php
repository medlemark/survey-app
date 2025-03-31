
<div class="row">
<div class="col-sm-6">
<?php echo validation_errors(); ?>

<?php echo form_open('reward/save'); ?>
	<legend>Create a new Reward</legend>

	<div class="form-group">
		<label for="title">title</label>
		<input type="text" name="title" class="form-control" id="title" placeholder="title for reward ex: 5$ amazon card">
	</div>
	<div class="form-group">
		<label for="intro">Points</label>
		<input type="number" name="points" class="form-control" id="points" placeholder="Points to get this reward">
	</div>
	 

	<button type="submit" class="btn btn-primary">Save</button>
</form>
 
 
</div>
</div>