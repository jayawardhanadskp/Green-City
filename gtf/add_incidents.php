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
        <h2 class="text-white text-center" style="padding-top: 6%; letter-spacing:1px;">ADD INCIDENTS </h2>
        <h6 class="text-muted text-center" style=" padding-bottom:4%">Home / Incidents</h6>
    </div>

  <br/>
  <div class="container mt-5" style="margin-bottom: 5%;" >
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card rounded">
         
          <div class="card-body p-4">
            <form>
             
                <div class="form-group mt-4">
                  <label for="full_name">Spots Name:</label>
                  <input type="text" class="form-control" id="spot_name" name="spot_name" >
                </div>
                <div class="form-group mt-4">
                  <label for="full_name">Image:</label>
                  <input type="file" class="form-control" id="image" name="image" >
                </div>
                <div class="form-group mt-4">
                  <label for="full_name">Description:</label>
                  <textarea class="form-control" id="description" name="description"></textarea>
                </div>
            
                <div class="d-grid gap-2 mt-4">
                  <button type="button" class="btn btn-dark" onclick="reg_action()">SUBMIT</button>
                </div>
                
            </form>
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

    <script type="text/javascript">
   
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      } else {
        console.log("Geolocation is not supported by this browser.");
      }

      function showPosition(position) {
        localStorage.setItem("latitude", position.coords.latitude);
        localStorage.setItem("longitude", position.coords.longitude);
      }


      

      function reg_action() {

          var spot_name = $('#spot_name').val();
          var image = $('#image')[0].files[0];
          var description = $('#description').val();

          var formData = new FormData();
          formData.append('spot_name', spot_name);
          formData.append('location_latitude', localStorage.getItem("latitude"));
          formData.append('location_longitude', localStorage.getItem("longitude"));
          formData.append('image', image);
          formData.append("status", "saveIncidents");
          formData.append('flag', "");
          formData.append('description', description);

          $.ajax({
            url: '../backend/incidents.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                
              Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Indicators Adding success.',
                showCloseButton: true,
                }).then((result) => {
              
                    window.location.href = "./all_incidents.php"; 
              });
            },
            error: function(xhr, status, error) {
              Swal.fire({
                  icon: 'error',
                  title: 'error',
                  text: 'Indicators Adding Not success.',
                  showCloseButton: true,
              });
            }
          });
        }


    </script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>

  </body>
</html>
