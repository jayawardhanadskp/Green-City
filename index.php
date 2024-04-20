<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GREEN CITY</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body>
    <?php include './nav.php'  ?>
    <div style="background: linear-gradient(to right, #efefbb, #d4d3dd);  height:100vh;">
        <div class="container">
            <div class="row" style="padding-top: 10%;">
                <div class="col" style="padding-top: 1%;">
                    <center>
                        <img src="./img/Colombo_Municipal_Council_Logo.png"  style="width:10%;"/>
                        <h1 style="font-weight:800; font-size:95px;" class="m-0 p-0 text-decoration-underline">GREEN CITY</h1>
                        <span style="font-size: 16px; letter-spacing:3px;" class="pl-2">GARBAGE COLLECTING WEB SITE OF THE COLOMBO CITY</span><br/>
                    </center>
                    <p style="text-align: justify;" class="pt-4">If you recycle your waste as much as possible, you contribute to a better environment and lower processing costs. In Utrecht, we collect glass, paper, textile and garden waste (including vegetables and fruit) separately. You are also required to keep any kind of chemical waste separate and deposit it at the closest municipal recycling center. Do you want to know when your waste is collected? Look at the Afvalwijzer, a website with all the information.</p>
                    <br/>
                    <hr/>
                    <button class="btn  btn-outline-dark btn-lg" onclick="login()">Become A Member</button>
                </div>
                <div class="col text-center">
                    <img src="./img/1.png" class="rounded" style="width:90%;"/>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script>
        function login(){
            window.location.href="./register.php";
        }
    </script>
</body>
</html>