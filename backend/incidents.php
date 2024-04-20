<?php
    include './db.php';
    session_start();
    
    if(isset($_POST['status']) && $_POST['status'] == 'saveIncidents') {
        // Get form data
        $spot_name = $_POST['spot_name'];
        $location_latitude = $_POST['location_latitude'];
        $location_longitude = $_POST['location_longitude'];
        $description = $_POST['description'];
        $image = $_FILES['image']['name'];
        $status = $_POST['status'];
        $flag = $_POST['flag'];
       
        // Upload image to server
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO garbage_spots (spot_name, location_latitude, location_longitude, description, image, status, flag) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sddssss", $spot_name, $location_latitude, $location_longitude, $description, $image, $status, $flag);
        
        // Execute SQL statement
        if ($stmt->execute()) {
            // Success
            $response = array(
                'status' => 'success',
                'message' => 'Incident saved successfully'
            );
        } else {
            // Error
            $response = array(
                'status' => 'error',
                'message' => 'Error saving incident: ' . $conn->error
            );
        }
        
        // Close database connection
        $stmt->close();
        $conn->close();
        
        // Return response as JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    

    if(isset($_POST['status']) && $_POST['status'] == 'getAllIncidents') {
        
        // Prepare SQL statement
        $stmt = $conn->prepare("SELECT * FROM garbage_spots");
        
        // Execute SQL statement
        $stmt->execute();
        
        // Get query results
        $result = $stmt->get_result();
        
        // Create an empty array to store the incidents
        $incidents = array();
        
        // Loop through the results and add each incident to the array
        while($row = $result->fetch_assoc()) {
            $incidents[] = $row;
        }
        
        // Close database connection
        $stmt->close();
        $conn->close();
        
        // Return the array of incidents as JSON
        header('Content-Type: application/json');
        echo json_encode($incidents);
    }

    
    if(isset($_POST['status']) && $_POST['status'] == 'getAllIncidentsForMap') {
        
        // Prepare SQL statement
        $stmt = $conn->prepare("SELECT * FROM garbage_spots WHERE status = 'saveIncidents' OR status = 'accepted'");
        
        // Execute SQL statement
        $stmt->execute();
        
        // Get query results
        $result = $stmt->get_result();
        
        // Create an empty array to store the incidents
        $incidents = array();
        
        // Loop through the results and add each incident to the array
        while($row = $result->fetch_assoc()) {
            $incidents[] = $row;
        }
        
        // Close database connection
        $stmt->close();
        $conn->close();
        
        // Return the array of incidents as JSON
        header('Content-Type: application/json');
        echo json_encode($incidents);
    }

  
    if(isset($_POST['status']) && $_POST['status'] == 'updateIncidentsStatus') {
        // Get the incident ID and status from the AJAX request
        $incidentId = $_POST['incidentId'];
        $newStatus = $_POST['newStatus'];

        // Prepare the SQL query to update the incident status
        $sql = 'UPDATE garbage_spots SET status = ? WHERE spot_id = ?';

        // Create a new prepared statement
        $stmt = $conn->prepare($sql);

        // Bind the parameters to the prepared statement
        $stmt->bind_param('si', $newStatus, $incidentId);

        // Execute the prepared statement
        if ($stmt->execute()) {
            // Return a success message to the AJAX request
            echo '1';
        } else {
            // Return an error message to the AJAX request
            echo 'Error updating incident status: ' . $conn->error;
        }

        // Close the prepared statement and database connection
        $stmt->close();
        $conn->close();

    }

    if(isset($_POST['status']) && $_POST['status'] == 'updateFlag') {
        // Get incident ID and flag value from POST data
        $incidentId = $_POST['incidentId'];
        $flagValue = $_POST['flagValue'];
    
        // Update the flag value in the database
        $query = "UPDATE incidents SET flag = :flagValue WHERE id = :incidentId";
        $stmt = $conn->prepare($query);
        
        $stmt->execute(array(':flagValue' => $flagValue, ':incidentId' => $incidentId));
    
        if ($stmt->execute()) {
            // Flag value updated successfully
            $response = array('status' => 'success', 'message' => 'Flag value updated successfully');
            echo json_encode($response);
        } else {
            // Failed to update flag value
            $response = array('status' => 'error', 'message' => 'Failed to update flag value');
            echo json_encode($response);
        }
    }
    
    

?>