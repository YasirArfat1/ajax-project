<?php

    include 'connection.php';

    $users = mysqli_query($con,"SELECT * FROM users");
    if(mysqli_num_rows($users) > 0)
    {
        $user_data = array();
        while($row = mysqli_fetch_assoc($users)){
            $user_data[] = $row;
        }
        
    }
    echo json_encode($user_data);
    
?>