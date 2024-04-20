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
        <h2 class="text-white text-center" style="padding-top: 6%; letter-spacing:1px;">WELCOME TO DASHBOARD</h2>
        <h6 class="text-muted text-center" style=" padding-bottom:4%">Home / Dashboard</h6>
    </div>

  <br/>
  <div class="container mt-5" style="margin-bottom: 5%;" >
        <div class="row">
            <div class="col">
                <div class="card" onclick='window.location.href = "./add_incidents.php";' >
                <div class="card-body text-center ">
                    <img src="../img/garbage.png" style="width:30%" class="card-img-top pt-5" alt="...">
                    <h2 class="card-title text-center mt-3">INCIDENTS</h2>
                </div>
                </div>
            </div>
            <div class="col">
                <div class="card" onclick='window.location.href = "./all_incidents.php";' >
                <div class="card-body text-center ">
                    <img src="../img/list.png" style="width:30%" class="card-img-top pt-5" alt="...">
                    <h2 class="card-title text-center mt-3">INCIDENTS LIST</h2>
                </div>
                </div>
            </div>
        </div>
  </div>
    
    <!-- Bootstrap JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  </body>
</html>
