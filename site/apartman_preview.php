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
			<div class="textalignright marginbottom10">
			<span id="newtodo" class="btn info">Create a new entry</span>
			<div id="newtodo_window" title="Create a new TODO item">
				<form id="create_entry" method="POST" action="getter.php">
					<div class="col-sm-6 col-md-6">
						<h3>Owner Information</h3>
						<input type="hidden" id="ownerID" name="ownerID"/>
						<p> First name: <br /> <input id="firstName" type="text" name="firstName" /></p>
						<p> Last name: <br /> <input id="lastName" type="text" name="lastName" /></p>
						<p> Email: <br /> <input id="email" type="email" name="email" /></p>
						<p> Web address: <br /><input id="webAddress" type="text" name="webAddress"/> </p>
						<p> Telephone: <br /><input id="telephone" type="text" name="telephone"/> </p>
						<p> Mobilephone: <br /><input id="mobile" type="text" name="mobile"/> </p>
					</div>
					<div class="col-sm-6 col-md-6">
						<h3>Object Information </h3>
						<input id="objectID" type="hidden" name="objectID"/>
						<p>Object Name<br /><input id="objectName" type="text" name="objectName"/> </p>
						<p>Address<br /><input id="objectAddress" type="text" name="objectAddress"/> </p>
						<input id="locationID" type="hidden" name="locationID" />
						<p>Number of beds<br /><input id="nbrOfBeds" type="text" name="nbrOfBeds"/> </p>
						<p>Number of Additional Beds<br /><input id="nbrOfAdditionalBeds" type="text" name="nbrOfAdditionalBeds"/> </p>
						<p>Number of Bedrooms<br /><input id="nbrOfBedRooms" type="text" name="nbrOfBedRooms"/> </p>
						<p>Have Living Room<br /><input id="haveLivingRoom" type="checkbox" name="haveLivingRoom"/> </p>
						<p>Have Telephone<br /><input id="haveTelephone" type="checkbox" name="haveTelephone"/> </p>
						<p>Have Television<br /><input id="haveTV" type="checkbox" name="haveTV"/> </p>
						<p>Have Wifi<br /><input id="haveWifi" type="checkbox" name="haveWifi"/> </p>
					</div>

					<div class="actions">
						<input id="entry_submit" type="submit" value="Create" name="new_submit" class="btn primary" />
					</div>
				</form>
			</div>
			<div>
				<button id="edit_all" class="btn">EDIT entry</button>
			</div>
		</div>
		</div>

		<div id="result-field" class="container text-center">
		</div>

		<script type="text/javascript">
		$(document).ready(function() {
			$.each($('form').serializeArray(), function(index, value){
			    $('[name="' + value.name + '"]').attr('readonly','readonly');
			});
			$.ajax({
					type: 'GET',
					url: 'getter.php',
					data: {'action': 'readOne', 'id': 1},
					dataType: 'json',
					success: function(data) {
						//alert(JSON.stringify(data));
						var json = data;
						$(json).each(function(i,val) {
							console.log(val);
							console.log(val.objectName);
							$.each(val, function(k,v) {
								  console.log(k+" : "+ v);
								  //just checking
								  switch(k){
								  	case 'appObjectID':
								  		$('#objectID').val(v);
								  		break;
								  	case 'objectName':
								  		$('#objectName').val(v);
								  		break;
								  	case 'objectAddress':
								  		$('#objectAddress').val(v);
								  		break;
								  	case 'objectLocation':
								  		$('#locationID').val(v);
								  		break;
								  	case 'nbrOfBeds':
								  		$('#nbrOfBeds').val(v);
								  		break;
								  	case 'nbrOfAdditionalBeds':
								  		$('#nbrOfAdditionalBeds').val(v);
								  		break;
								  	case 'nbrOfBedRooms':
								  		$('#nbrOfBedRooms').val(v);
								  		break;
								  	case 'haveLivingRoom':
								  		if(v == '1') {
								  			$('#haveLivingRoom').prop('checked', true);
								  		}
								  		break;
								  	case 'haveTV':
								  		if(v == '1') {
								  			$('#haveTV').prop('checked', true);
								  		}
								  		break;
								  	case 'haveTelephone':
								  		if(v == '1') {
								  			$('#haveTelephone').prop('checked', true);
								  		}
								  		break;
								  	case 'haveWiFi':
								  		if(v == '1') {
								  			$('#haveWifi').prop('checked', true);
								  		}
								  		break;
								  	case 'ownerID':
								  		$('#ownerID').val(v);
								  		break;				
								  	case 'ownerFirstName':
								  		$('#firstName').val(v);
								  		break;
								  	case 'ownerLastName':
								  		$('#lastName').val(v);
								  		break;
								  	case 'ownerEmail':
								  		$('#email').val(v);
								  		break;
								  	case 'ownerWeb':
								  		$('#webAddress').val(v);
								  		break;
								  	case 'ownerTelephone':
								  		$('#telephone').val(v);
								  		break;
								  	case 'ownerCellPhone':
								  		$('#mobile').val(v);
								  		break;
								  }
							});
						});
					}
				});

			$('#edit_all').click(function(event) {
				event.preventDefault();
				$.each($('form').serializeArray(), function(index, value){
				    $('[name="' + value.name + '"]').removeAttr('readonly');
				});
			});

			$('form').submit(function(event) {
				event.preventDefault();
				$.ajax({
				  url: 'getter.php',
				  type: 'PUT',
				  data: $('form').serialize(),
				  success: function(data) {
				    alert('Update done.');
				  }
				});
			});
		});
		</script>
	</body>
</html>