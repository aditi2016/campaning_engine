<?php

$$db_handle = mysqli_connect("localhost","root","redhat@11111p","campaning_engine");
$date = date("y-m-d H:i:s");

function phoneNumbervalidation($mobile){
    if (preg_match('/^((\+){0,1}91(\s){0,1}(\-){0,1}(\s){0,1})?([0-9]{10})$/', $mobile, $matches)) {
        print_r($matches);
        return true;
    } else
        return false;
}

if (($handle = fopen("data9.csv", "r")) !== FALSE) {
	
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		$email_id = 0;
		$mobile_id = 0;
		$email = $data[10];
		$mobile =  $data[0];
		
		//$address = $data[10]." ".$data[9];
		
		// please make sure address is not unque
        //mysqli_query($db_handle,"INSERT INTO addresses (address) VALUES  ('$address');");
        $address_id = 0;//mysqli_insert_id($db_handle);
        
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            mysqli_query($db_handle,"INSERT INTO emails 
											(email, name, gender, city_id, address_id, creation, user_id) 
										VALUES  
											('$email', '$data[4]', 'Male', 1, '$address_id', '$date', 0);");
		
			$email_id = mysqli_insert_id($db_handle);
        } else
            echo "INVALID: " . $email . " <br/>\n";      
        
		if (phoneNumbervalidation($mobile)) {
			mysqli_query($db_handle,"INSERT INTO mobiles 
												(mobile, name, gender, city_id, address_id, creation, user_id) 
										VALUES  
												('$mobile', '$data[4]', 'Male', 1, '$address_id', '$date', 0);");
												
			$mobile_id = mysqli_insert_id($db_handle);
        } else
            echo "INVALID: " . $mobile . " <br/>\n";
								
		
		
		if($email_id != 0 && $mobile_id != 0){
			
			mysqli_query($db_handle,"INSERT INTO mobile_email_mapping (mobile_id, email_id, creation_date) 
										VALUES ('$mobile_id', '$email_id', '$date');");
		}
	
         echo  $data[4]." ".$$email." ".$mobile."\n";  //echo "name:". $data[0] . " mobile: " . $data[1] . " email: " . $data[2] . "<br />\n";
        //}
    }
    fclose($handle);
}
mysqli_close($db_handle);
?>

