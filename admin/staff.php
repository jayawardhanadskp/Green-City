<!doctype html>
<html lang="en">
  <head>
    <title>GREEN CITY</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

  </head>
  <body>

    <?php include './nav_after_login_gtf.php'  ?>
    <div style="background-color: #403B4A;">
        <h2 class="text-white text-center" style="padding-top: 6%; letter-spacing:1px;">STAFF MANAGAMENT</h2>
        <h6 class="text-muted text-center" style=" padding-bottom:4%">Home / Staff</h6>
    </div>
    <div class="container mt-5" style="margin-bottom: 5%;" >
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card rounded">
          <div class="card-body p-4">
                <div class="mt-3 text-end">
                    <button class="btn btn-dark" onclick='window.location.href = "./dashboard.php";'>Back</button>
                    <button class="btn btn-dark" onclick='window.location.href = "./add_staff.php";'>Add Staff</button>
                </div>
                <table class="table mt-2">
                    <thead>
                        <tr class="bg-dark text-white">
                            <td>Staff Id</td>
                            <td>Staff Name</td>
                            <td>Telephone Number</td>
                            <td>Address</td>
                            <td  class="text-center">Action</td>
                        </tr>
                    </thead>
                    <tbody style="background-color:#F4F4F4;"></tbody>
                </table>
          </div>
        </div>
      </div>
    </div>
  </div>

    
    <!-- Bootstrap JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

            loadStaffTable();
           function loadStaffTable(){
                // Send AJAX request to get all staff data from server
                
                $.ajax({
                    url: '../backend/staff.php',
                    type: 'POST',
                    data: {
                        status: 'allStaff'
                    },
                    success: function(response) {
                            
                            var staff =   JSON.parse(response);
                            var tableRows = '';
                            for (var i = 0; i < staff.length; i++) {
                                tableRows += '<tr>';
                                tableRows += '<td>' + staff[i].staff_id + '</td>';
                                tableRows += '<td>' + staff[i].full_name + '</td>';
                                tableRows += '<td>' + staff[i].staff_phone + '</td>';
                                tableRows += '<td>' + staff[i].staff_address + '</td>';
                                tableRows += '<td class="text-center">';
                                tableRows += '<a href="#" class="btn btn-success btn-sm" onclick="editStaff(' + staff[i].staff_id + ')">Edit</a>';
                                tableRows += '  ';
                                tableRows += '<a href="#" class="btn btn-danger btn-sm" onclick="deleteStaff(' + staff[i].staff_id + ')">Delete</a>';
                                tableRows += '</td>';
                                tableRows += '</tr>';
                            }
                            $('tbody').html(tableRows);
                       
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr);
                        console.log(status);
                        console.log(error);
                    }
                });
            }

            function editStaff(staffId) {
                // Code to edit staff record
            }

            function deleteStaff(staffId) {
            // Confirmation message
            Swal.fire({
                icon: 'warning',
                title: 'Are you sure?',
                text: 'You are about to delete this staff record. This action cannot be undone.',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                // Send AJAX request to delete staff record
                $.ajax({
                    url: '../backend/staff.php',
                    type: 'POST',
                    data: {
                    status: 'deleteStaff',
                    staffId: staffId
                    },
                    success: function(response) {
                        var return_data = JSON.parse(response);
                    if (return_data.status == 'success') {
                        // Reload the staff table
                        loadStaffTable();
                        // Show success message
                        Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Staff record has been deleted successfully.',
                        showCloseButton: true,
                        });
                    } else {
                        // Show error message
                        Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to delete staff record.',
                        showCloseButton: true,
                        });
                    }
                    },
                    error: function(xhr, status, error) {
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                    // Show error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to delete staff record.',
                        showCloseButton: true,
                    });
                    }
                });
                }
            });
            }


    </script>
  </body>
</html>
