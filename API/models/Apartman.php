<?php
class Apartman {
	public $apartman_id;
	public $apartman_name;

	public static function getAllItems() {
		//connect to db
		$con = new mysqli("localhost", "root","", "apartmani");

		//check connection
		if ($con->connect_errno) {
		    //printf("Connect failed: %s\n", $mysqli->connect_error);
		    throw new Exception('Connection Failed with '.$con->connect_error);
		    //exit();
		}

		//query
		$query = "SELECT ao.appObjectID, ao.objectName, ao.objectAddress FROM appObject ao JOIN Location loc on ao.objectLocation = loc.idLocation
		JOIN ownerInfo oi on ao.appObjectID = oi.ownershipID";

		//grab result
		$result = $con->query($query);

		//check if anything is in there
		if($result) {
			//now go throught all rows
			while ($row = $result->fetch_object()) {
				$app_array[] = $row;
			}

			//free result set
			$result->close();
			$con->next_result();
		}


		//close db connection
		$con->close();
		
		//return data to controller
		return $app_array;

	}

	public static function getItem($apartman_id) {
		//connect to db
		$con = new mysqli("localhost", "root", "", "apartmani");

		//check connection
		if ($con->connect_errno) {
		    //printf("Connect failed: %s\n", $mysqli->connect_error);
		    throw new Exception('Connection Failed with '.$con->connect_error);
		    //exit();
		}

		//specific query for only one item with ID
		$query = "SELECT * FROM appObject ao JOIN Location loc on ao.objectLocation = loc.idLocation
		JOIN ownerInfo oi on ao.appObjectID = oi.ownershipID WHERE appObjectID=".$apartman_id;

		$result = $con->query($query);
		if($result) {
			while($row = $result->fetch_object()) {
				$dataT = $row;
			}

			$result->close();
			$con->next_result();
		}

		$con->close();

		return $dataT;
	}

	//update values to a DB
	public static function save($data) {
		$con = new mysqli("localhost", "root", "", "apartmani");

		//check connection
		if ($con->connect_errno) {
		    throw new Exception('Connection Failed with '.$con->connect_error);
		}
		//set Location first
		$city = '"'.$con->real_escape_string($data->city).'"';
		$state = '"'.$con->real_escape_string($data->state).'"';
		$postalNumber = '"'.$con->real_escape_string($data->postalNumber).'"';

		//check if already exits
		$query_checkLocation = "SELECT idLocation FROM location where city = $city AND postalNumer = $postalNumber";
		$result_checkLocation = $con->query($query_checkLocation);

		if($result_checkLocation === false) {
			throw new Exception("Problem with call");
		}

		$row = $result_checkLocation->fetch_object();

		if(is_null($row)) {
			//new insert
			$query_insertLocation = "INSERT INTO location (city, state, postalNumer) 
			VALUES ($city, $state, $postalNumber)";

			$result_insertLocation = $con->query($query_insertLocation);

			if($result_insertLocation === false) {
				throw new Exception("Problem with call Insert Location");
			}

			//grab last inserted ID 
			$location_id = $con->insert_id;
		} else {
			$entryExists = $row->idLocation;
			$location_id = (int)$entryExists;
		}

		//enter object in db
		if(isset($data->haveLivingRoom)) {
			$data_haveLivingRoom = 1;
		} else {
			$data_haveLivingRoom = 0;
		}
		if(isset($data->haveTV)) {
			$data_haveTV = 1;
		} else {
			$data_haveTV = 0;
		}
		if(isset($data->haveWifi)) {
			$data_haveWifi = 1;
		} else {
			$data_haveWifi = 0;
		}
		if(isset($data->haveTelephone)) {
			$data_haveTelephone = 1;
		} else {
			$data_haveTelephone = 0;
		}
		
		//mysqli escape string removal to get INSERT query run normally
		$objectName = '"'.$con->real_escape_string($data->objectName).'"';
		$objectAddress = '"'.$con->real_escape_string($data->objectAddress).'"';
		$nbrOfBeds = '"'.$con->real_escape_string($data->nbrOfBeds).'"';
		$nbrOfAdditionalBeds = '"'.$con->real_escape_string($data->nbrOfAdditionalBeds).'"';
		$nbrOfBedRooms = '"'.$con->real_escape_string($data->nbrOfBedRooms).'"';
		$haveLivingRoom = ''.$con->real_escape_string($data_haveLivingRoom).'';
		$haveTV = ''.$con->real_escape_string($data_haveTV).'';
		$haveWifi = ''.$con->real_escape_string($data_haveWifi).'';
		$haveTelephone = ''.$con->real_escape_string($data_haveTelephone).'';
		$objectLocation = '' .$con->real_escape_string($location_id).'';

		//first check if that object already exist
		$query_check = "SELECT COUNT(*) AS 'exists' FROM appObject where objectName = $objectName AND objectAddress = $objectAddress";
		$result_check = $con->query($query_check);

		if($result_check === false) {
			throw new Exception("Problem with call");
			//return "There is already entry with the same Object Name and Address. Entry not saved.";
		}
		$row = $result_check->fetch_object();
		$entryExists = (bool) $row->exists;

		if($entryExists) {
			return "There is already entry with the same Object Name and Address. Entry not saved.";
		}

		$insert_object = "INSERT INTO appObject (objectName,objectAddress,objectLocation,nbrOfBeds,nbrOfAdditionalBeds,nbrOfBedRooms,haveLivingRoom,haveTV,haveTelephone,haveWiFi)
		VALUES ( $objectName,$objectAddress,$objectLocation,$nbrOfBeds,$nbrOfAdditionalBeds,$nbrOfBedRooms,$haveLivingRoom,$haveTV,$haveTelephone,$haveWifi)";

		$result_object = $con->query($insert_object);
		if(!$result_object) {
			return "Object is not inserted. It can be problem with a database";
		}

		//grab id

		//grab last inserted ID 
		$objectID = $con->insert_id;

		$firstName = '"'.$con->real_escape_string($data->firstName).'"';
		$lastName = '"'.$con->real_escape_string($data->lastName).'"';
		$lastName = '"'.$con->real_escape_string($data->email).'"';
		$webAddress = '"'.$con->real_escape_string($data->webAddress).'"';
		$telephone = '"'.$con->real_escape_string($data->telephone).'"';
		$mobile = '"'.$con->real_escape_string($data->mobile).'"';

		//insert owner of object
		$insert_owner = "INSERT INTO ownerInfo (ownerFirstName,ownerLastName,ownerEmail,ownerWeb,ownerTelephone,ownerCellPhone,ownershipID)
		VALUES ($firstName,$lastName,$lastName,$webAddress,$telephone,$mobile,$objectID)";
		
		$result_owner = $con->query($insert_owner);

		if(!$result_owner) {
			throw new Exception('Owner died ');
		}
		return "success";
	}

	public static function update($data) {
		$con = new mysqli("localhost", "root", "", "apartmani");

		//check connection
		if ($con->connect_errno) {
		    throw new Exception('Connection Failed with '.$con->connect_error);
		    //exit();
		}

		//owner stuff
		$ownerID = '"'.$con->real_escape_string($data->ownerID).'"';
		$firstName = '"'.$con->real_escape_string($data->firstName).'"';
		$lastName = '"'.$con->real_escape_string($data->lastName).'"';
		$email = '"'.$con->real_escape_string($data->email).'"';
		$webAddress = '"'.$con->real_escape_string($data->webAddress).'"';
		$telephone = '"'.$con->real_escape_string($data->telephone).'"';
		$mobile = '"'.$con->real_escape_string($data->mobile).'"';
		$objectID = '"'.$con->real_escape_string($data->objectID).'"';;

		$update_owner = "UPDATE ownerInfo SET ownerFirstName = $firstName, ownerLastName = $lastName, ownerEmail = $email,
		ownerWeb = $webAddress, ownerTelephone = $telephone, ownerCellPhone = $mobile, ownershipID = $objectID WHERE ownerID = $ownerID";

		$result_update_owner = $con->query($update_owner);
		if(!$result_update_owner) {
			return "Owner faild to update";
		}

		//object setters for checkboxes
		if(!is_null($data->haveLivingRoom)) {
			$data_haveLivingRoom = 1;
		} else {
			$data_haveLivingRoom = 0;
		}
		if(!is_null($data->haveTV)) {
			$data_haveTV = 1;
		} else {
			$data_haveTV = 0;
		}
		if(!is_null($data->haveWifi)) {
			$data_haveWifi = 1;
		} else {
			$data_haveWifi = 0;
		}
		if(!is_null($data->haveTelephone)) {
			$data_haveTelephone = 1;
		} else {
			$data_haveTelephone = 0;
		}

		//object stuff
		$objectName = '"'.$con->real_escape_string($data->objectName).'"';
		$objectAddress = '"'.$con->real_escape_string($data->objectAddress).'"';
		$objectLocation = '"'.$con->real_escape_string($data->locationID).'"';
		$nbrOfBeds = '"'.$con->real_escape_string($data->nbrOfBeds).'"';
		$nbrOfAdditionalBeds = '"'.$con->real_escape_string($data->nbrOfAdditionalBeds).'"';
		$nbrOfBedRooms = '"'.$con->real_escape_string($data->nbrOfBedRooms).'"';
		$haveLivingRoom = ''.$con->real_escape_string($data_haveLivingRoom).'';
		$haveTV = ''.$con->real_escape_string($data_haveTV).'';
		$haveWifi = ''.$con->real_escape_string($data_haveWifi).'';
		$haveTelephone = ''.$con->real_escape_string($data_haveTelephone).'';

		$update_object = "UPDATE appObject SET 
		objectName = $objectName,
		objectAddress = $objectAddress,
		objectLocation = $objectLocation,
		nbrOfBeds = $nbrOfBeds,
		nbrOfAdditionalBeds = $nbrOfAdditionalBeds,
		nbrOfBedRooms = $nbrOfBedRooms,
		haveLivingRoom = $haveLivingRoom,
		haveTV = $haveTV,
		haveTelephone = $haveTelephone,
		haveWiFi = $haveWifi WHERE appObjectID = $objectID";

		$result_update_object = $con->query($update_object);

		if(!$result_update_object) {
			return "Failed to update object";
		}

		return "success";
		//object stuff
	}
}