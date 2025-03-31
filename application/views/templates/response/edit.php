
<div class="row">
<div class="col-sm-6">
<?php echo validation_errors(); ?>

<?php echo form_open('reward/save/'.$data[0]->reward_id); ?>
	<legend>Create a new Reward</legend>

	<div class="form-group">
		<label for="title">title</label>
		<input type="text" name="title" class="form-control" id="title" placeholder="title for reward ex: 5$ amazon card" value="<?php echo $data[0]->title; ?>">
	</div>
	<div class="form-group">
		<label for="intro">Points</label>
		<input type="number" name="points" class="form-control" id="points" placeholder="Points to get this reward" value="<?php echo $data[0]->points; ?>">
	</div>
	 

	<button type="submit" class="btn btn-primary">Save Edit</button>
</form>
 
 
</div>
</div>