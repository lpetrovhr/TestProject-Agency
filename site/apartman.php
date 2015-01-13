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
			<div id="newEntryWindow" title="Create a new db entry">
				<form id="create_entry" method="POST" action="getter.php">
					<div class="row">
						<div class="col-sm-4 col-md-4">
							<h3>Owner Information</h3>
							<p> First name: <br /> <input type="text" name="firstName" required/></p>
							<p> Last name: <br /> <input type="text" name="lastName" required/></p>
							<p> Email: <br /> <input type="email" name="email" required/></p>
							<p> Web address: <br /><input type="text" name="webAddress" required/> </p>
							<p> Telephone: <br /><input type="text" name="telephone" required/> </p>
							<p> Mobilephone: <br /><input type="text" name="mobile" required/> </p>
						</div>
						<div class="col-sm-4 col-md-4">
							<h3>Object Information </h3>
							<p>Object Name<br /><input type="text" name="objectName" required/> </p>
							<p>Address<br /><input type="text" name="objectAddress" required/> </p>
							<p>Number of beds<br /><input type="text" name="nbrOfBeds" required/> </p>
							<p>Number of Additional Beds<br /><input type="text" name="nbrOfAdditionalBeds" required/> </p>
							<p>Number of Bedrooms<br /><input type="text" name="nbrOfBedRooms" required/> </p>
							<p>Have Living Room<br /><input type="checkbox" name="haveLivingRoom" /> </p>
							<p>Have Telephone<br /><input type="checkbox" name="haveTelephone" /> </p>
							<p>Have Television<br /><input type="checkbox"  name="haveTV" /> </p>
							<p>Have Wifi<br /><input type="checkbox" name="haveWifi" /> </p>
						</div>
						<div class="col-sm-4 col-md-4">
							<h3>Location Information</h3>
							<p>City: <br /><input type="text" name="city" required/> </p>
							<p>State: <br /><input type="text" name="state" required/> </p>
							<p>Postal Number: <br/> <input type="text" name="postalNumber" required/> </p>
						</div>
					</div>
					<div class="actions row">
						<input id="entry_submit" type="submit" value="Create New Entry" name="new_submit" class="btn primary" />
					</div>
				</form>
			</div>
		</div>
		</div>

		<div id="result-field" class="container text-center">
		</div>

		<script type="text/javascript">
		$(document).ready(function() {
			$("#create_entry").submit(function(event) {
			});
		});
		</script>
	</body>
</html>