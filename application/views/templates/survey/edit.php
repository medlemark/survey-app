
<div class="row">
<div class="col-sm-6">
<?php echo validation_errors(); ?>

<?php echo form_open('survey/save/'.$data[0]->survey_id); ?>
	<legend>Create a new Survey</legend>

	<div class="form-group">
		<label for="title">title</label>
		<input type="text" name="title" class="form-control" id="title" placeholder="Input field" value="<?php echo $data[0]->title; ?>">
	</div>
	<div class="form-group">
		<label for="intro">Introduction</label>
		<input type="text" name="intro" class="form-control" id="intro" placeholder="Input field" value="<?php echo $data[0]->intro; ?>">
	</div>
	<div class="form-group">
		<label for="thankyou">Thank you Message </label>
		<input type="text" name="thankyou" class="form-control" id="thankyou" placeholder="Input field" value="<?php echo $data[0]->thankyou; ?>">
	</div>
	 <div class="form-group">
		<label for="thankyou">Location </label>
		<input type="text" name="location" class="form-control autocomplete" id="location" placeholder="loctation" value="<?php echo $data[0]->location; ?>">
		<input type="hidden" name="location_lat" id="location_lat" style="display: none;" value="<?php echo $data[0]->lat; ?>">
		<input type="hidden" name="location_lng" id="location_lng" style="display: none;" value="<?php echo $data[0]->lng; ?>">
	</div>
	<div class="form-group">
		 <div id="map">
		 	
		 </div>
	</div>
	<div class="">
		<table class="table table-condensed" id="question_holder">
			<thead>
				<tr>
					 
					<th>title</th>
					<th>required</th>
					<th>type</th>
					<th>points</th>
					<th>edit/delete</th>
				</tr>
			</thead>
			<tbody>
					<?php 
					foreach($data as $k => $v){ 
					$data_json = []; 
					$data_json['question_id'] = $v->question_id;
					$data_json['title'] = trim(stripcslashes($v->question),"'");
					 
					$data_json['required'] = (bool)$v->required == true ? 'Yes' : 'No';
					$data_json['type'] = trim(stripslashes($v->type_input),"'");
					$data_json['points'] = (int)$v->points;
					$data_json['options'] = json_decode(stripslashes(trim($v->options,"'")));
					?>
					<tr>
						 
						<td><?php echo trim(stripcslashes($v->question),"'"); ?></td>
						<td><?php echo (bool)$v->required == true ? 'Yes' : 'No'; ?></td>
						<td><?php echo trim(stripslashes($v->type_input),"'"); ?></td>
						<td><?php echo (int)$v->points; ?></td>
						<td><a class="btn btn-sm btn-default editQuestion">edit</a><a class="btn btn-sm btn-default deleteQuestion">delete</a><textarea style="display:none" name="questions_data[]"> 
							<?php echo json_encode($data_json,JSON_UNESCAPED_SLASHES);?>
							
						</textarea></td>
						 
						
					</tr>
				<?php } ?>
				 
			</tbody>
		</table>
	</div>
	

	<button type="submit" class="btn btn-primary">Save Edit</button>
</form>
</div>
<div class="col-sm-6 panel">
	 
	<legend> create questions </legend>
	 <div class="form-group">
		<label for="title_question">Title </label>
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