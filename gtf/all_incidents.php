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
        <h2 class="text-white text-center" style="padding-top: 6%; letter-spacing:1px;">ALL INCIDENTS </h2>
        <h6 class="text-muted text-center" style=" padding-bottom:4%">Home / Incidents</h6>
    </div>

  <br/>
  <div class="container mt-5" style="margin-bottom: 5%;" >
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card rounded">
          <div class="card-body p-4">
                <table class="table">
                    <thead>
                        <tr class="bg-dark text-white">
                            <td>Spot Id</td>
                            <td>Spot Name</td>
                            <td>Image</td>
                            <td>Added Date</td>
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
    <script src="https://cdn.emailjs.com/dist/email.min.js"></script>

    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
    <script>
            
    

          $.ajax({
                url: '../backend/incidents.php',
                type: 'POST',
                data: {
                    status: "getAllIncidents"
                },
                success: function(response) {
                    // Loop through the incidents and create table rows for each one
                    var tableRows = '';
                    for (var i = 0; i < response.length; i++) {
                        var incident = response[i];
                        var imageSrc = incident.image ? incident.image : 'path/to/default/image.jpg';
                        var addedDate = new Date(incident.date_added).toLocaleString();
                        tableRows += '<tr>' +
                            '<td>' + incident.spot_id + '</td>' +
                            '<td>' + incident.spot_name + '</td>' +
                            '<td><img src="../backend/uploads/' + imageSrc + '" width="50" height="50"></td>' +
                            '<td>' + addedDate + '</td>' +
                            '<td class="text-center"><button type="button" class="btn btn-primary btn-sm" onclick="editIncident(' + incident.spot_id + ')">Edit</button>&nbsp;&nbsp;<button type="button" class="btn btn-secondary btn-sm" onclick="viewIncident(' + incident.spot_id + ')">View</button></td>' +
                            '</tr>';
                    }
                    // Insert the table rows into the table body
                    $('tbody').html(tableRows);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching incidents:', error);
                }
          });

    </script>
  </body>
</html>
