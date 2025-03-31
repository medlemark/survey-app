
<div class="row">
<div class="col-sm-6">
<?php echo validation_errors(); ?>

<?php echo form_open('survey/save'); ?>
	<legend>Create a new Survey</legend>

	<div class="form-group">
		<label for="title">title</label>
		<input type="text" name="title" class="form-control" id="title" placeholder="Title">
	</div>
	<div class="form-group">
		<label for="intro">Introduction</label>
		<input type="text" name="intro" class="form-control" id="intro" placeholder="Introduction">
	</div>
	<div class="form-group">
		<label for="thankyou">Thank you Message </label>
		<input type="text" name="thankyou" class="form-control" id="thankyou" placeholder="Thank you message">
	</div>
	<div class="form-group">
		<label for="thankyou">Location </label>
		<input type="text" name="location" class="form-control autocomplete" id="location" placeholder="loctation">
		<input type="hidden" name="location_lat" id="location_lat" style="display: none;">
		<input type="hidden" name="location_lng" id="location_lng" style="display: none;">
	</div>
	<div class="form-group">
		 <div id="map">
		 	
		 </div>
	</div>
	 
	<div class="">
		<table class="table table-condensed" id="question_holder">
			<thead>
				<tr>
					 
					<th>Question</th>
					<th>required</th>
					<th>type</th>
					<th>points</th>
					<th>edit/delete</th>
				</tr>
			</thead>
			<tbody>
				 
			</tbody>
		</table>
	</div>
	

	<button type="submit" class="btn btn-primary">Save</button>
</form>
</div>
<div class="col-sm-6 panel">
	 
	<legend> create questions </legend>
	 <div class="form-group">
		<label for="title_question">Question </label>
		<input type="text" name="title_question" id="title_question" class="form-control" required="required" placeholder="title ">

	</div> 
	 
	<div class="form-group">
		<label for="points_question">Points </label>
		<input type="number" name="points_question" id="points_question" class="form-control" required="required" placeholder="points  ">
	</div>
	<div class="form-group">
		<!--label for="required_question">Required </label>
		<input type="checkbox" name="required_question" id="required_question" class="form-control" -->
		 <div class="checkbox">
                        <label>
                          <input type="checkbox" name="required_question"> Required
                        </label>
        </div>
	</div>
	<div class="form-group">
		<label for="type_input">Type of Question </label>
		<select name="type_input" id="type_input" class="form-control" required="required">
			<option value="1">Text</option>
			<option value="2">Multi Checkbox</option>
		</select>
	</div>
 
	<div class="form-group" id="multichoix" style="display: none;">
		<div id="template_choix">
		<label for="multi_checkbox">Option  </label>
		<div class="row">
			<div class="col-sm-10"><input class="form-control" name="multi_checkbox[]" id="multi_checkbox" type="text"></div>
			<div class="col-sm-2"> 
				<button class="btn btn-sm btn-default">+</button>
				<button class="btn btn-sm btn-default">-</button>
			</div>
		</div>
		</div>
	</div>
	<div class="form-group">
		<button type="submit" class="btn btn-primary add_qst" >Add Question</button>
	</div>
 
</div>
</div>