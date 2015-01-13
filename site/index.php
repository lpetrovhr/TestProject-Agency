
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />

		<title> Apartmani Test for API </title>

		<link rel="stylesheet" type="text/css" href="css/reset.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

		<script type="text/javascript" src="js/jquery-1.11.1.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
	</head>

	<body>
		<div class="container">
			<h3 class="text-center">Welcome</h3>
			<button id="activate" class="btn center-block">Hit me</button>	
		</div>

		<div id="result-field" class="container text-center">
		</div>

		<script type="text/javascript">
		$(document).ready(function() {
			var entry = '';
			$('#activate').click(function(e) {
				e.preventDefault();  			// neka vrsta zaštite da se ne izvrši bla bla
				$.ajax({							
					type: 'GET',
					url: 'getter.php',	
					data: {'action': 'read'},	
					dataType: 'json', 
					success: function(data) {	
						var json = data;	 
						$('#result-field').html(CreateTableView(json));		
						//var ul = $('<ul>').appendTo('#result-field');		
						$(json).each(function(i,val) { 
							$.each(val, function(k,v) { 
								  console.log(k+" : "+ v); 
								  //just checking
							}); 
						}); 
					}                                                                                            
				});
			});
			$('#result-field').on('click','a', function() {

				var id = $(this).data('id');
				$.ajax({  
					type: 'GET',
					url: 'getter.php',
					data: {'action': 'readOne', 'id': id}, 
					dataType: 'json',
					success: function(data) {
						var json = data;
						$('#result-field').html(json);
						//var ul = $('<ul>').appendTo('#result-field');
						$('#result-field').append(CreateDetailView(json));
						entry = json;
						$(json).each(function(i,val) {
							$.each(val, function(k,v) {
								  console.log(k+" : "+ v);
								  //just checking
							});
						});
					}
				});
			});

			$('#edit-entry').on('click', function() {
				EditEntry(entry);

			});

			function CreateTableView(objArray) {

				var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
				var str = '<ul class="all">';

				//table body
				
				$(objArray).each(function(i,val) {
					str += '<li>';
					str += '<a class="btn-link" href="#" data-id=' + val.appObjectID+ '><h5>' + val.objectName + '</h5></a>';
					str += '</li>';
				});
				
				str += '</ul>';
				return str;
			}
			function CreateDetailView(objArray) {
				var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
				var str = '<div class="container text-left">';
				$(array).each(function(i,val) {
					$.each(val, function(k,v) {
						str += '<span><b>' + k + ': </b></span>';
						str += '<span>' + v + '</span><br />';
					});
				});
				str +='<button class="btn" id="edit-entry"> Edit Entry </button>';
				str += '<div>';
				return str;
			}
			function EditEntry(entry) {
				var array = typeof entry != 'object' ? JSON.parse(entry) : entry;

			}

		});
		</script>
	</body>
</html>