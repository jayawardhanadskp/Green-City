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
        <h2 class="text-white text-center" style="padding-top: 6%; letter-spacing:1px;">CAPTAINS MANAGAMENT</h2>
        <h6 class="text-muted text-center" style=" padding-bottom:4%">Home / Captain</h6>
    </div>
    <div class="container mt-5" style="margin-bottom: 5%;" >
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card rounded">
          <div class="card-body p-4">
                <div class="mt-3 text-end">
                    <button class="btn btn-dark" onclick='window.location.href = "./dashboard.php";'>Back</button>
                    <button class="btn btn-dark" onclick='window.location.href = "./add_captain.php";'>Add Captain</button>
                </div>
                <table class="table mt-2">
                    <thead>
                        <tr class="bg-dark text-white">
                            <td>Captain Id</td>
                            <td>Captain Name</td>
                            <td>Telephone Number</td>
                            <td>Email</td>
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
            $.ajax({
            url: '../backend/gtf_member.php',
            type: 'POST',
            data: {
                status: 'getAllCaptain'
            },
            success: function(response) {
                if (response.status == 'success') {
                var captains = response.captains;
                var tableRows = '';
                for (var i = 0; i < captains.length; i++) {
                    tableRows += '<tr>';
                    tableRows += '<td>' + captains[i].member_id + '</td>';
                    tableRows += '<td>' + captains[i].member_name + '</td>';
                    tableRows += '<td>' + captains[i].member_phone + '</td>';
                    tableRows += '<td>' + captains[i].member_email + '</td>';
                    tableRows += '<td class="text-center">';
                    tableRows += '<a href="#" class="btn btn-success btn-sm" onclick="editCaptain(' + captains[i].member_id + ')">Edit</a>';
                    tableRows += '  ';
                    tableRows += '<a href="#" class="btn btn-danger btn-sm" onclick="deleteCaptain(' + captains[i].member_id + ')">Delete</a>';
                    tableRows += '</td>';
                    tableRows += '</tr>';
                }
                $('tbody').html(tableRows);
                } else {
                alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr);
                console.log(status);
                console.log(error);
            }
            });

    </script>
  </body>
</html>
