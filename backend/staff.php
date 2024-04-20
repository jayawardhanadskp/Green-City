<?php
    include './db.php';
    session_start();
    
    if(isset($_POST['status']) && $_POST['status'] == 'addStaff') {
        // Get form data
        $full_name = $_POST['full_name'];
        $user_bod = $_POST['user_bod'];
        $user_nic = $_POST['user_nic'];
        $user_phone = $_POST['user_phone'];
        $user_address = $_POST['user_address'];
    
        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO staff (full_name, staff_bod, staff_nic, staff_phone, staff_address) VALUES (?, ?, ?, ?, ?)");
    
        // Bind parameters to statement
        $stmt->bind_param("sssss", $full_name, $user_bod, $user_nic, $user_phone, $user_address);
    
        // Execute SQL statement
        if ($stmt->execute()) {
            // Success
            $response = array(
                'status' => true,
                'message' => 'Staff member added successfully'
            );
        } else {
            // Error
            $response = array(
                'status' => false,
                'message' => 'Error adding staff member: ' . $conn->error
            );
        }
    
        // Close database connection
        $stmt->close();
        $conn->close();
    
        // Return response as JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    if(isset($_POST['status']) && $_POST['status'] == 'allStaff') {
       
        // SQL query to select all staff
        $sql = "SELECT * FROM staff";
    
        // Execute the query
        $result = mysqli_query($conn, $sql);
    
        // Create an array to hold the staff data
        $staff = array();
    
        // Check if the query was successful
        if($result) {
            // Loop through the rows and add each staff to the array
            while($row = mysqli_fetch_assoc($result)) {
                $staff[] = $row;
            }
        }
    
        // Return the staff data as JSON
        echo json_encode($staff);
    }
    
    if(isset($_POST['status']) && $_POST['status'] == 'deleteStaff') {
        $staffId = $_POST['staffId'];
        $query = "DELETE FROM staff WHERE staff_id = $staffId";
        $result = mysqli_query($conn, $query);
        if($result) {
            $response['status'] = 'success';
            $response['message'] = 'Staff record deleted successfully';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Failed to delete staff record';
        }
        echo json_encode($response);
      
        $conn->close();
    }

?>