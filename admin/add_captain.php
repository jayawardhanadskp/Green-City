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
        <h2 class="text-white text-center" style="padding-top: 6%; letter-spacing:1px;">ADD CAPTAIN</h2>
        <h6 class="text-muted text-center" style=" padding-bottom:4%">Home / Captain</h6>
    </div>

  <br/>
  <div class="container mt-5" style="margin-bottom: 5%;" >
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card rounded">
         
          <div class="card-body p-4">
            <form>
             
              <div class="form-group mt-4">
                <label for="full_name">Member Name:</label>
                <input type="text" class="form-control" id="full_name" name="full_name" >
              </div>
              <div class="form-group mt-4">
                <label for="full_name">Member BOD:</label>
                <input type="date" class="form-control" id="user_bod" name="user_bod" >
              </div>
              <div class="form-group mt-4">
                <label for="full_name">Member Occupation:</label>
                <select class="form-select" id="user_occupation" name="user_occupation" >
                  <option value="">Select Occupation</option>
                  <option value="leader">Leader</option>
                  <option value="con-leader">Co-Leader</option>
                  <option value="supervisor">Supervisor</option>
                </select>
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
              <div class="form-group mt-4">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email"  oninput="check_email()">
                <span id="email_status" style="font-size:12px;"></span>
              </div>
              <div class="form-group mt-4">
                  <label for="name">Password:</label>
                  <input type="password" class="form-control" id="pass" name="pass" oninput="checkPasswordStrength()" >
                  <span id="password-strength" style="font-size:12px;"></span>
                </div>
                <div class="form-group mt-4">
                  <label for="name">Confirm - Password:</label>
                  <input type="password" class="form-control" id="cpass" name="cpass" oninput="pass_match_check()">
                  <span id="re_pass_status" style="font-size:12px;"></span>
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
     
      
   
      function reg_action(){
      
            // Create form data object
            var formData = new FormData();
            formData.append('member_name', document.getElementById("full_name").value);
            formData.append('member_bod',  document.getElementById("user_bod").value);
            formData.append('member_occupation',  document.getElementById("user_occupation").value);
            formData.append('member_phone',  document.getElementById("user_phone").value);
            formData.append('member_address',  document.getElementById("user_address").value);
            formData.append('member_email',  document.getElementById("email").value);
            formData.append('member_password',  document.getElementById("pass").value);
            formData.append('member_type',  "Captain");
            formData.append('status', "saveMember");

            // Send AJAX request to save data to server
            $.ajax({
              url: '../backend/gtf_member.php',
              method: 'POST',
              data: formData,
              contentType: false,
              processData: false,
              success: function(response) {
                
                let ob = JSON.parse(response);

                if(ob.success == true){

                    Swal.fire({
                      icon: 'success',
                      title: 'Success',
                      text: 'Profile Creating success.',
                      showCloseButton: true,
                      }).then((result) => {
                    
                          window.location.href = "./captain.php"; 
                    });

                }else{
                  Swal.fire({
                    icon: 'error',
                    title: 'error',
                    text: 'Profile Creating  not success.',
                    showCloseButton: true,
                  });
                }

              }
            });
        
      }
    </script>

    <script>

           

            function check_email(){
                var email = document.getElementById("email").value;
            
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if(emailRegex.test(email)){
                    document.getElementById("email_status").innerHTML = "Valid email";
                    document.getElementById("email_status").style.color = "green";
                }else{
                    document.getElementById("email_status").innerHTML = "Invalid email";
                    document.getElementById("email_status").style.color = "red";
                }

            }

            function pass_match_check(){
                var pass = document.getElementById("pass").value;
                var repass = document.getElementById("cpass").value;

                if(pass == repass){
                    document.getElementById("re_pass_status").innerHTML = "Passwords are matching.";
                    document.getElementById("re_pass_status").style.color = "green";
                }else{
                    document.getElementById("re_pass_status").innerHTML = "Passwords are not matching.";
                    document.getElementById("re_pass_status").style.color = "red";
                }
            }

            function checkPasswordStrength() {
                var password = document.getElementById("pass").value;
                var strength = document.getElementById("password-strength");
                var uppercase = /[A-Z]/;
                var numbers = /[0-9]/;
                var specialChars = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;

                if (password.length < 6) {
                    strength.innerHTML = "Password must be at least 6 characters long.";
                    strength.style.color = "red";
                } else if (!uppercase.test(password)) {
                    strength.innerHTML = "Password must contain at least one uppercase letter.";
                    strength.style.color = "red";
                } else if (!numbers.test(password)) {
                    strength.innerHTML = "Password must contain at least one number.";
                    strength.style.color = "red";
                } else if (!specialChars.test(password)) {
                    strength.innerHTML = "Password must contain at least one special character.";
                    strength.style.color = "red";
                } else {
                    strength.innerHTML = "Password strength: strong!";
                    strength.style.color = "green";
                }
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
