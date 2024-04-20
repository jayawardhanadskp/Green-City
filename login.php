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

    <?php include './nav.php'  ?>
    <div style="background-color: #403B4A;">
        <h2 class="text-white text-center" style="padding-top: 6%; letter-spacing:1px;">LOGIN PAGE</h2>
        <h6 class="text-muted text-center" style=" padding-bottom:4%">Home / Login</h6>
    </div>

  <br/>
  <div class="container mt-5" style="margin-bottom: 5%;" >
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card rounded">
         
          <div class="card-body p-4">
            <form>
            
              <div class="form-group mt-4">
                <label for="user_name">User Name:</label>
                <input type="text" class="form-control" id="user_name" name="user_name" >
              </div>
              <div class="form-group mt-4">
                <label for="name">Password:</label>
                <input type="password" class="form-control" id="pass" name="pass" >
              </div>
              
              <div class="d-grid gap-2 mt-4">
                <button type="button" class="btn btn-dark" onclick="login_action()">LOGIN</button>
              </div>
              <div class="text-end pt-2" style="cursor:pointer;"  onclick="reg()">
                <h6>I Don't have an account.</h6>
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

    <script>

        function reg(){
          window.location.href = "./register.php";
        }
          
        function login_action(){

            var user_name = document.getElementById("user_name").value;
            var password = document.getElementById("pass").value;

            // Create form data object
            var formData = new FormData();
           
            formData.append('user_name',  user_name);
            formData.append('pass',  password);
            formData.append('status_action', "user_login");

            // Send AJAX request to save data to server
            $.ajax({
              url: './backend/gtf_member.php',
              method: 'POST',
              data: formData,
              contentType: false,
              processData: false,
              success: function(response) {
                let ob = JSON.parse(response);

                if(ob.success == true){
                  if(ob.user_type == "GTF_Member"){
                    Swal.fire({
                      icon: 'success',
                      title: 'Success',
                      text: 'Login is success.',
                      showCloseButton: true,
                      }).then((result) => {
                        window.location.href = "./gtf/dashboard.php";

                        
                        var today = new Date();
                        var expire = new Date();
                        expire.setTime(today.getTime() + 3600000*24*15);
                        document.cookie = "username="+email_Address+";path=/" + ";expires="+expire.toUTCString();
                    });
                  }else if(ob.user_type == "Admin"){
                    Swal.fire({
                      icon: 'success',
                      title: 'Success',
                      text: 'Login is success.',
                      showCloseButton: true,
                      }).then((result) => {
                        window.location.href = "./admin/dashboard.php";

                        
                        var today = new Date();
                        var expire = new Date();
                        expire.setTime(today.getTime() + 3600000*24*15);
                        document.cookie = "username="+email_Address+";path=/" + ";expires="+expire.toUTCString();
                    });
                  }else if(ob.user_type == "Captain"){
                    Swal.fire({
                      icon: 'success',
                      title: 'Success',
                      text: 'Login is success.',
                      showCloseButton: true,
                      }).then((result) => {
                        window.location.href = "./green captan/dashboard.php";

                        
                        var today = new Date();
                        var expire = new Date();
                        expire.setTime(today.getTime() + 3600000*24*15);
                        document.cookie = "username="+email_Address+";path=/" + ";expires="+expire.toUTCString();
                    });
                  }else{

                  }
                 
                }else{
                  Swal.fire({
                    icon: 'error',
                    title: 'error',
                    text: 'Login is not success.',
                    showCloseButton: true,
                  });
                }

              }
            });
        }

    </script>
  </body>
</html>
