//DELETE LOGIC
function deleteStudent(e){
	var btn_id = e.target.id;
	var student_id = btn_id.substring(4,btn_id.length);
	var outline_id = $(outlineId).val();
	$.ajax({
		url:'https://netboost.ca/outlineassists/deleteStudent',
		data:{student_id:student_id,outline_id:outline_id},
		method:"POST",
		success:function(response){update(response)},
		error:function(response){error(response)}
	});
}

function update(response){
	$('table').html(response);
}

function error(){
	console.log(response);
}



//ADD LOGIC

function addStudent(e){
	var assigned = false;
	// for (var i = 0; i < Things.length; i++) {
	// 	Things[i]
	// }

	if(!assigned){
		var student_id = $('#addStudent').val();
		var outline_id = $(outlineId).val();
		$.ajax({
			url:'https://netboost.ca/outlineassists/addStudent',
			data:{student_id:student_id,outline_id:outline_id},
			method:"POST",
			success:function(response){update(response)},
			error:function(response){error(response)}
		});
	}
}

