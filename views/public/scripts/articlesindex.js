var url = "https://netboost.ca/articles/search/";
//url = "http://localhost/articles/search/";

function search(){
	var search = $('#search').val();
	console.log(url + search);
	$.ajax({
		url: (url + search),
		// dataType: "json",
		error: function(result,error){console.log(error);},
		success: function(result){render(result);}
	});
}

function render(articles){
	// console.log(articles);
	$('#articleList').html(articles);
	//console.log('success');
}