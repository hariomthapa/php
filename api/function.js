
$(function(){
	var functionName = 'GetProducts';
	function loadData(){
		$.getJSON('http://localhost:8080/curl_p/api.php?function='+ functionName +'&jsonCallback=?',function(data){
			console.log(data);
			var all_data=[];
			$.each(data, function(k, name){
			 var array_data='<div class="names">'+name+'</div>';
			 all_data.push(array_data);
			});
			$('#data').append(data);
		});
	}
	loadData();
});