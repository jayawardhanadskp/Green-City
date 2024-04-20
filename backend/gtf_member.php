<?php
    include './db.php';
    session_start();
    if(isset($_POST['status']) && $_POST['status'] == 'saveMember') {
        // Get the input values
        $member_type = mysqli_real_escape_string($conn, $_POST['member_type']);
        $member_name = mysqli_real_escape_string($conn, $_POST['member_name']);
        $member_bod = mysqli_real_escape_string($conn, $_POST['member_bod']);
        $member_occupation = mysqli_real_escape_string($conn, $_POST['member_occupation']);
        $member_password = mysqli_real_escape_string($conn, $_POST['member_password']);
        $member_email = mysqli_real_escape_string($conn, $_POST['member_email']);
        $member_phone = mysqli_real_escape_string($conn, $_POST['member_phone']);
        $member_address = mysqli_real_escape_string($conn, $_POST['member_address']);

       
        $password_hash = md5($member_password);
        // Prepare the SQL statement using parameter binding
        $stmt = mysqli_prepare($conn, "INSERT INTO member (member_type, member_name, member_bod, member_occupation, member_password, member_email, member_phone, member_address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        // Bind the parameters to the statement
        mysqli_stmt_bind_param($stmt, "ssssssss", $member_type, $member_name, $member_bod, $member_occupation, $password_hash, $member_email, $member_phone, $member_address);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Output success message as JSON
            $response = array('success' => true, 'message' => 'Member added successfully');
            echo json_encode($response);
        } else {
            // Output error message as JSON
            $response = array('success' => false, 'message' => 'Error adding member: ' . mysqli_error($conn));
            echo json_encode($response);
        }

        // Close the statement
        mysqli_stmt_close($stmt);

        // Close the connection
        mysqli_close($conn);
    }


    if(isset($_POST['status_action']) && $_POST['status_action'] == 'user_login') {
    
        $user_name = $_POST['user_name'];
        $plaintext_password = md5($_POST['pass']);
    
        $sql = "SELECT * FROM member where member_email='$user_name' and member_password='$plaintext_password' ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
    
                $_SESSION["email"] = $row['email'];

                $response = array('success' => true, 'message' => 'Member added successfully' , 'user_type' => $row["member_type"]);
                echo json_encode($response);
                   
            }
        } else {
                $response = array('success' => false, 'message' => 'Member added not successfully' , 'user_type' => "");
                echo json_encode($response);
        }
    }

    if(isset($_POST['status']) && $_POST['status'] == 'getAllCaptain') {
        // Prepare SQL statement
        $stmt = $conn->prepare("SELECT * FROM member where member_type = 'Captain'");
        
        // Execute SQL statement
        if ($stmt->execute()) {
            // Success
            $result = $stmt->get_result();
            
            $captains = array();
            while ($row = $result->fetch_assoc()) {
                $captain = array(
                    'member_id' => $row['member_id'],
                    'member_name' => $row['member_name'],
                    'member_phone' => $row['member_phone'],
                    'member_email' => $row['member_email']
                );
                array_push($captains, $captain);
            }
            
            $response = array(
                'status' => 'success',
                'captains' => $captains
            );
        } else {
            // Error
            $response = array(
                'status' => 'error',
                'message' => 'Error getting captains: ' . $conn->error
            );
        }
        
        // Close database connection
        $stmt->close();
        $conn->close();
        
        // Return response as JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    

    if(isset($_POST['status']) && $_POST['status'] == 'updateMember') {
       
    }

    if(isset($_POST['status']) && $_POST['status'] == 'deleteMemeber') {
       
    }

?>