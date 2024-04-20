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
        <h2 class="text-white text-center" style="padding-top: 6%; letter-spacing:1px;">ADD STAFF</h2>
        <h6 class="text-muted text-center" style=" padding-bottom:4%">Home / Staff</h6>
    </div>

  <br/>
  <div class="container mt-5" style="margin-bottom: 5%;" >
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card rounded">
         
          <div class="card-body p-4">
            <form>
             
              <div class="form-group mt-4">
                <label for="full_name">Staff Name:</label>
                <input type="text" class="form-control" id="full_name" name="full_name" >
              </div>
              <div class="form-group mt-4">
                <label for="full_name">Staff BOD:</label>
                <input type="date" class="form-control" id="user_bod" name="user_bod" >
              </div>
              <div class="form-group mt-4">
                <label for="full_name">Staff NIC:</label>
                <input type="text" class="form-control" id="user_nic" name="user_nic" >
              </div>
             
              <div class="form-group mt-4">
                <label for="full_name">Phone Number:</label>
                <input type="text" class="form-control" id="user_phone" name="user_phone" oninput="validatePhoneNumber()">
                <small id="phone-error" style="color: red; display: none;">Invalid phone number</small>
              </div>
              <div class="form-group mt-4">
                <label for="full_name">Address:</label>
                <input type="text" class="form-control" id="user_address" name="user_address" >
              </div>
              <br/>
              <center>
                    <div id="review_recaptcha"></div>
              </center>

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
     
            function reg_action() {
              // Create form data object
              var formData = new FormData();
              formData.append('full_name', document.getElementById("full_name").value);
              formData.append('user_bod', document.getElementById("user_bod").value);
              formData.append('user_nic', document.getElementById("user_nic").value);
              formData.append('user_phone', document.getElementById("user_phone").value);
              formData.append('user_address', document.getElementById("user_address").value);
              formData.append('status', "addStaff");

              // Send AJAX request to save data to server
              var xhr = new XMLHttpRequest();
              xhr.open('POST', '../backend/staff.php', true);
              xhr.onload = function () {
                var ob = JSON.parse(this.responseText);

                if (ob.status == true) {
                  Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Staff Adding success.',
                    showCloseButton: true,
                  }).then((result) => {
                    window.location.href = "./staff.php";
                  });
                } else {
                  Swal.fire({
                    icon: 'error',
                    title: 'error',
                    text: 'Staff Adding not success.',
                    showCloseButton: true,
                  });
                }
              };
              xhr.send(formData);
            }


            function validatePhoneNumber() {
                const phoneInput = document.getElementById("user_phone");
                const phoneError = document.getElementById("phone-error");
                const phoneRegex = /^\d{10}$/; // Matches 10 digits

                if (!phoneRegex.test(phoneInput.value)) {
                    phoneError.style.display = "inline";
                } else {
                    phoneError.style.display = "none";
                }
            }

    </script>
  </body>
</html>
