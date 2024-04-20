<!doctype html>
<html lang="en">
  <head>
    <title>GREEN CITY</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css"  />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  </head>
  <body>

    <?php include './nav_after_login_gtf.php'  ?>
    <div style="background-color: #403B4A;">
        <h2 class="text-white text-center" style="padding-top: 6%; letter-spacing:1px;">WELCOME TO DASHBOARD</h2>
        <h6 class="text-muted text-center" style=" padding-bottom:4%">Home / Dashboard</h6>
    </div>

  <br/>
  <div class="container-fluid p-5" style="margin-bottom: 5%;" >
        <div class="row">
            <div class="col-4 p-4" style="background-color: #EAEAEA;" >
                <h5 class="text-uppercase">All Incident</h5>
                <hr/>
                <div id="incident-cards"></div>
            </div>
            <div class="col-8">
                <div id="mapid" style="height: 650px;"></div>
            </div>
        </div>
  </div>
    
    <!-- Bootstrap JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js" ></script>
    <script>

    loadmap();
    function loadmap(){
        // Create a map instance
        var mymap = L.map('mapid').setView([6.9271, 79.8612], 10);

        // Add a tile layer to the map (using OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
        maxZoom: 18,
        }).addTo(mymap);

      // Load incidents from backend API
      $.ajax({
        url: '../backend/incidents.php',
        type: 'POST',
        data: {
          status: "getAllIncidentsForMap"
        },
        success: function(response) {
          // Parse the response JSON
          console.log(response);

          var html ="";
          // Loop through the incidents and add markers to the map
          for (var i = 0; i < response.length; i++) {
            var lat = response[i].location_latitude;
            var lng = response[i].location_longitude;
            var marker = L.marker([lat, lng]).addTo(mymap);
            if(response[i].flag == 1){
                marker.bindPopup('<b>Incident ID:</b> ' + response[i].spot_id + '<br><b>Location:</b> ' + response[i].spot_name+'<br/><br/><button class="btn btn-outline-dark btn-sm" onclick="loadinsident()">View</button>&nbsp;<button class="btn btn-outline-danger btn-sm" onclick="unSetflag(' + response[i].spot_id + ')"><i class="bi bi-flag-fill"></i></button>');
            }else{
                marker.bindPopup('<b>Incident ID:</b> ' + response[i].spot_id + '<br><b>Location:</b> ' + response[i].spot_name+'<br/><br/><button class="btn btn-outline-dark btn-sm" onclick="loadinsident()">View</button>&nbsp;<button class="btn btn-outline-danger btn-sm" onclick="setflag(' + response[i].spot_id + ')">Flag</button>');
            }

            html += "<div class='card mt-3'>";
            html += "<div class='p-3 text-center '><img src='../../backend/uploads/" + response[i].image + "' style='width:80%' class='card-img-top rounded' alt=''></div>";
            html += "<div class='card-body'>";
            html += "<h5 class='card-title'>" + response[i].spot_name + "</h5>";
            html += "<p class='card-text'>" + response[i].description + "</p>";
            html += "<div class='text-end'>";
            if(response[i].status == "saveIncidents"){
                html += "<a href='#' class='btn btn-success' onclick='updateStatus("+response[i].spot_id+",1)'>Accept</a>&nbsp;";
                html += "<a href='#' class='btn btn-danger' onclick='updateStatus("+response[i].spot_id+",0)'>Reject</a>";
            }else{
                html += "<a href='#' class='btn btn-primary' onclick='completeIncident("+response[i].spot_id+")'>Complete</a>";
            }
            html += "</div>";
            html += "</div>";
            html += "</div>";
          }
          $('#incident-cards').html(html);
        },
        error: function(xhr, status, error) {
          console.error('Error fetching incidents:', error);
        }
      });
    }

      function loadinsident(){
        alert(2);
      }      
      
      function setflag(incidentId){
        $.ajax({
            url: '../backend/incidents.php',
            type: 'POST',
            data: {
                status: "updateFlag",
                incidentId: incidentId,
                flagValue: "1"
            },
            success: function(response) {
                // Show success message using SweetAlert
                Swal.fire({
                    title: 'Flag updated',
                    text: 'This insident is very important.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            },
            error: function(xhr, status, error) {
                console.error('Error updating flag:', error);
            }
        });

      }

      function updateStatus(id,status){
        if(status == 0){
            accept(id);
        }else{
            reject(id);
        }
      }

      function accept(id){
        $.ajax({
            url: '../backend/incidents.php',
            type: 'POST',
            data: {
                status: "updateIncidentsStatus",
                incidentId: id,
                newStatus: "accepted"
            },
            success: function(response) {
                console.log(response);
                Swal.fire({
                    title: "Success",
                    text: "Incident has been accepted",
                    icon: "success",
                }).then((result) => {
                    // Refresh the page or do something else upon success
                    location.reload(); 
                });
            },
            error: function(xhr, status, error) {
            console.error('Error updating incident status:', error);
            }
        });
      }
      
      function completeIncident(id){
        $.ajax({
            url: '../backend/incidents.php',
            type: 'POST',
            data: {
                status: "updateIncidentsStatus",
                incidentId: id,
                newStatus: "complete"
            },
            success: function(response) {
                console.log(response);
                Swal.fire({
                    title: "Success",
                    text: "Incident has been accepted",
                    icon: "success",
                }).then((result) => {
                    // Refresh the page or do something else upon success
                    location.reload(); 
                });
            },
            error: function(xhr, status, error) {
            console.error('Error updating incident status:', error);
            }
        });
      }


      function reject(id){
        $.ajax({
            url: '../backend/incidents.php',
            type: 'POST',
            data: {
                status: "updateIncidentsStatus",
                incidentId: id,
                newStatus: "rejected"
            },
            success: function(response) {
                console.log(response);
                Swal.fire({
                    title: "Success",
                    text: "Incident has been accepted",
                    icon: "success",
                }).then((result) => {
                    // Refresh the page or do something else upon success
                    location.reload(); 
                });
            },
            error: function(xhr, status, error) {
            console.error('Error updating incident status:', error);
            }
        });
      }
    </script>
  </body>
</html>
