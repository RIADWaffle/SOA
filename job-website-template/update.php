<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/images/favicon.ico">

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">


    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/owl.css">

  </head>

  <body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <header class="">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="index.html"><h2>Job Agency <em>Website</em></h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home
                      <span class="sr-only">(current)</span>
                    </a>
                </li> 
                
                <li class="nav-item"><a class="nav-link" href="job-publish.php">Post a job</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Edit a job</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Delete a job</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <!-- Page Content -->
    <div class="page-heading about-heading header-text" style="background-image: url(assets/images/heading-6-1920x500.jpg);">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>Searching for employees?</h4>

              <h2>Edit Your Chamba</h2>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="products">
      <div class="container">
        <div class="row">
          <div class="col-md-9 col-sm-8">
              <br>
              <br>            
              <div class="contact-form">
                <h4>Edit your job:</h4>
                <br>

                
                <?php
                // Recuperar las variables de $_GET y guardarlas en variables de PHP
                $id = isset($_GET['id']) ? $_GET['id'] : '';
                $img = isset($_GET['img']) ? $_GET['img'] : '';
                $name = isset($_GET['name']) ? $_GET['name'] : '';
                $salary = isset($_GET['salary']) ? $_GET['salary'] : '';
                $type = isset($_GET['type']) ? $_GET['type'] : '';
                $place = isset($_GET['place']) ? $_GET['place'] : '';
                ?>


                <input id="img" class="form-control" type="text" name="img" value="<?php echo $img; ?>" placeholder="Image URL">
                <input id="name" class="form-control" type="text" name="name" value="<?php echo $name; ?>" placeholder="Name of the work">
                <input id="salary" class="form-control" type="text" name="salary" value="<?php echo $salary; ?>" placeholder="Salary on USD">
                <input id="type" class="form-control" type="text" name="type" value="<?php echo $type; ?>" placeholder="Type of work">
                <input id="place" class="form-control" type="text" name="place" value="<?php echo $place; ?>" placeholder="Place of work">
              </div>

              <div class="contact-form"> 
              <div class="form-group">
                <button id="compararBoton" class="filled-button btn-block">Publish work</button>
              </div>
            </div>

              <br>
              <br>
          </div>


          <script>
            document.getElementById("compararBoton").addEventListener("click", function () {
                // Obtener los valores de las variables de PHP y de los inputs
                var variablesPHP = {
                    img: "<?php echo $img; ?>",
                    name: "<?php echo $name; ?>",
                    salary: "<?php echo $salary; ?>",
                    type: "<?php echo $type; ?>",
                    place: "<?php echo $place; ?>"
                };

                var inputs= {};


                var id = <?php echo $id; ?>;
                
                var diferencias = 0;
                var campoCambiado = null;

                for (var campo in variablesPHP) {
                    var valorPHP = variablesPHP[campo];
                    var valorInput = document.querySelector(`input[name="${campo}"]`).value;

                    inputs[campo] = valorInput;

                    if (valorPHP !== valorInput) {
                        diferencias++;
                        campoCambiado = campo;
                        value = valorInput;
                    }
                }

                if (diferencias === 1) {
                    fetch('method.php?id='+ id + '&change=' + campoCambiado + '&value=' + value, {
                        method: 'PATCH',
                    })
                    .then(function(response) {
                        return response.text();
                    })
                    .then(function(data) {
                        document.getElementById('response').textContent = data;
                    })
                    .catch(function(error) {
                        console.error('Error:', error);
                    });
                } else {
                    
                    fetch('method.php?id='+ id + '&img=' + inputs['img'] + '&name=' + inputs['name'] + '&salary=' + inputs['salary'] + '&type=' + inputs['type'] + '&place=' + inputs['place'] , {
                        method: 'PUT',
                    })
                    .then(function(response) {
                        return response.text();
                    })
                    .then(function(data) {
                        document.getElementById('response').textContent = data;
                    })
                    .catch(function(error) {
                        console.error('Error:', error);
                    });
             
                }


            });
        </script>



          <div class="col-md-3 col-sm-4">

            <img src="<?php echo $img; ?>" style="justify-self: center;">
            <br> <br>

            <ul class="social-icons text-center">
            </ul>

            <br>
            <br>
          </div>
        </div>
      </div>
    </div>

   

    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="inner-content">
              <p>Copyright © 2020 Company Name - Template by: <a href="https://www.phpjabbers.com/">PHPJabbers.com</a></p>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Book Now</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="contact-form">
              <form action="#" id="contact">
                  <div class="row">
                       <div class="col-md-6">
                          <fieldset>
                            <input type="text" class="form-control" placeholder="Pick-up location" required="">
                          </fieldset>
                       </div>

                       <div class="col-md-6">
                          <fieldset>
                            <input type="text" class="form-control" placeholder="Return location" required="">
                          </fieldset>
                       </div>
                  </div>

                  <div class="row">
                       <div class="col-md-6">
                          <fieldset>
                            <input type="text" class="form-control" placeholder="Pick-up date/time" required="">
                          </fieldset>
                       </div>

                       <div class="col-md-6">
                          <fieldset>
                            <input type="text" class="form-control" placeholder="Return date/time" required="">
                          </fieldset>
                       </div>
                  </div>
                  <input type="text" class="form-control" placeholder="Enter full name" required="">

                  <div class="row">
                       <div class="col-md-6">
                          <fieldset>
                            <input type="text" class="form-control" placeholder="Enter email address" required="">
                          </fieldset>
                       </div>

                       <div class="col-md-6">
                          <fieldset>
                            <input type="text" class="form-control" placeholder="Enter phone" required="">
                          </fieldset>
                       </div>
                  </div>
              </form>
           </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary">Book Now</button>
          </div>
        </div>
      </div>
    </div>


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    <!-- Additional Scripts -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
  </body>

</html>
