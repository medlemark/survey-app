(function(){
	var map,marker=null;
	$(document).ready(function(){
		 $('#type_input').val('1');
		$('#type_input').on('change',function(){
			if($(this).val() == '2'){
				$('#multichoix').show();
			}
			if($(this).val() == '1'){
				$('#multichoix').hide('slow');
			}
		})
		$('#multichoix').on('click','.btn',function(){
			 var k = $(this);
			 if(k.text() == '+') {
			 	var temp = $('#template_choix').clone();
			 	$(temp).attr('id',''); 
			 	$(temp).attr('value',''); 
			 	$(temp).attr('class','cloned'); 
			 	$('#multichoix').append(temp);
			 
			 }else if(k.text() == '-') {
			 	$(k).parents().closest('.cloned').remove('slow');
			 	var d = $(k).parents().closest('.cloned');
			 	$(d).remove();
			 }
			
		})

		$(document).on('click','.add_qst',function(){
			 createQuestion(this);
		});
		$(document).on('click','.deleteQuestion',function(){
			deleteQuestion(this);
		});
		$(document).on('click','.editQuestion',function(){
			initQuestion();
			editQuestion(this);
		});
		$(document).on('click','.saveEdit',function(){
			saveEditQuestion(this);
			var savebtn = $('.saveEdit').clone();
			savebtn.attr('class','btn btn-sm btn-primary add_qst');
			savebtn.text('Add Question');

			$('.saveEdit').replaceWith(savebtn);
		});

		var initQuestion = function(){
			$('#title_question').val('');
			//$('#name_question').val('');
			$('#points_question').val('');
			$('[name=required_question]').prop('checked',false);
			$('#type_input').val('1');
			if (!$('tr.info').length) {
				$('#type_input').trigger('change');
			}
			
			$('#multichoix .cloned').remove();
			$('#multichoix input').val('');

		}
		var deleteQuestion = function(e){
			$(e).closest('tr').remove();
			initQuestion();
		}
		var saveEditQuestion = function(e){
			createQuestion(true);
		}
		var editQuestion = function(e){
			initQuestion();
			if ($('tr.info').length == 1) {
				$('tr.info').removeClass('info');
			}
			$(e).parents().closest('tr').addClass('info');
			var currentEdit = JSON.parse($(e).parent().find('[name^=questions_data]').text());
			 
			$('#title_question').val(currentEdit.title);
			//$('#name_question').val(currentEdit.name);
			$('#points_question').val(currentEdit.points);
			var required = currentEdit.required == 'Yes' ? true : false;
			$('[name=required_question]').prop('checked',required);
			if(currentEdit.type == 'Text'){
				$('#type_input').val('1');
			}else if(currentEdit.type == 'Multi Choice'){
					for (var i = 0; i < currentEdit.options.length; i++) {
						if(currentEdit.options[i] != ''){
							if( $('#template_choix input').val() == ''){
								$('#template_choix input').val(currentEdit.options[i]);
							}else{	
								var cloned = $('#template_choix').clone();
								cloned.find('input').val(currentEdit.options[i]);
								cloned.attr('id','');
								cloned.attr('class','cloned');
								$('#multichoix').append(cloned);
							}
						}
					}
					$('#type_input').val('2');
					if ($('#multichoix').css('display') == 'none') {
						 $('#multichoix').show();
					} 

			}
			 
			var savebtn = $('.add_qst').clone();
			savebtn.attr('class','btn btn-sm btn-primary saveEdit');
			savebtn.text('Save Edit');

			$('.add_qst').replaceWith(savebtn);
		}
		var createQuestion = function(edit=false){
			var title = $('#title_question').val();
			//var name = $('#name_question').val();
			var points = $('#points_question').val();
			if(title.length == 0 || isNaN(parseInt(points)) ){

				return 
			}
			var req = $('[name=required_question]').is(':checked') == true ? 'Yes' : 'No';
			var type = $('#type_input').val() == 1 ? 'Text' : 'Multi Choice';
			var options = $('[name^=multi_checkbox]').map(function(){ return $(this).val(); }).get();
			var q = {
				'title':title,
				//'name':name,
				'required':req,
				'type':type,
				'points':points,
				'options':options,
			}
			if ($('tr.info').length == 1) {
				var currentEdit = JSON.parse($('#question_holder tr.info').find('[name^=questions_data]').text());
				if(currentEdit.question_id != undefined){
					q.question_id = currentEdit.question_id;
				}
			}
			
			var tr = '<tr>';
			tr += '<td>'+title+'</td>';
			tr += '<td>'+req+'</td>';
			tr += '<td>'+type+'</td>';
			tr += '<td>'+points+'</td>';
			tr += '<td><a class="btn btn-sm btn-default editQuestion">edit</a>';
			tr += '<a class="btn btn-sm btn-default deleteQuestion">delete</a>';
			tr += '<textarea style="display:none" name="questions_data[]"> '+JSON.stringify(q)+'</textarea></td>';
			tr += '</tr>';
			if(edit == true){
			 
			$('#question_holder tr.info').replaceWith(tr);
			$('#question_holder tr.info').removeClass('info');
			}else{

			$('#question_holder tr:last').after(tr);
			}
			initQuestion();
		 
		}
		initQuestion();


		function setAutoComplete(){
			if($('.autocomplete').length >=1){
				 
				var inputs = document.getElementsByClassName("autocomplete");

				for (var i = 0; i <  inputs.length; i++) {
					var autocomplete = new google.maps.places.Autocomplete(inputs[i]);
					autocomplete.addListener('place_changed', function() {
						if($('input[name=location]').length == 1){
						var place = autocomplete.getPlace();
						 // console.log(place);
						 var loc = place.geometry.location;
						 var lat = loc.lat();
						 var lng  = loc.lng();
						 // var bounds = new google.maps.LatLngBounds();
						 // bounds.extend(loc);   
						 $('#location_lat').val(lat);
					     $('#location_lng').val(lng);
						 if(marker == null){
						 	marker = new google.maps.Marker({
					          map: map,
					          position:loc,
					     	});
					      
						 }else{
						 	marker.setPosition(loc);
						 	
						 }
					     //$('#map').show();
 
					     map.setCenter(marker.getPosition());
					     google.maps.event.trigger(map, 'resize');
 					  
						}
						 
					});
				}
		 
			}
		}
		function setUpMap(){
			 map = new google.maps.Map(document.getElementById('map'), {
		          center: {lat: -33.8688, lng: 151.2195},
		          zoom: 11
		     });
		     var cLat =$('#location_lat').val();
		     var cLng =$('#location_lng').val();
		     if(cLat != '' && cLng != ''){
		     		marker = new google.maps.Marker({
					          map: map,
					          position: new google.maps.LatLng(parseFloat(cLat), parseFloat(cLng)),
					}); 
					map.setCenter(marker.getPosition());
					google.maps.event.trigger(map, 'resize');
		     }
		    
		}
		setUpMap();
		setAutoComplete();
	});
})();