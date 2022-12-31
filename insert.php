<?php

include 'connection.php';


    $data = stripslashes(file_get_contents('php://input'));
    $formdata = json_decode($data,true);
    // $id = $mydata['id'];
    $name = $formdata['name'];
    $email = $formdata['email'];
    $password = $formdata['password'];

    if(!empty($name) && !empty($email) && !empty($password))
    {
        $res = mysqli_query($con,"insert into users (`name`, `email`, `password`) values ('$name','$email','$password')");
        if($res){
            echo "Data inserted ";
        }
        else
        {
            echo "Error occured";
        }
    }
    else
    {
        echo "Please Fill All Fields";
    }
?>