<?php

session_start();

if (isset($_SESSION['username']) && isset($_SESSION['id'])) {

require_once "../controladores/especialidades.controlador.php";
require_once "../controladores/sucursales.controlador.php";
require_once "../controladores/pacientes.controlador.php";  

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
  <title>
    Marketing
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.5" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <!-- Select 2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
  
  <style type="text/css">
    
    .select2-selection__rendered {
          line-height: 33px !important;
    }
    .select2-container .select2-selection--single {
        height: 37px !important;
    }
    .select2-selection__arrow {
        height: 36px !important;
    }
  </style>
</head>

<body class="g-sidenav-show  bg-gray-200">
  <?php
  require_once 'menu.php';
  ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Páginas</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Inicio</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Inicio</h6>
        </nav>
    <?php
      require_once 'navbar.php';
    ?>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Búsqueda de Datos</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <form action="excel_tabla.php" target="_blank" method="POST">
              <div class="container-fluid">
                <div class="row" id="columnas">
                  <label for="exampleFormControlSelect1">Seleccione Datos de Tabla Pacientes</label>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="text-center">Columna</label>                      
                      <select class="columna js-states custom-select" id="columna" name="columna" required>
                        <option value="">Seleccione Columna</option>
                        <option value="t">Todos</option>
                        <?php
   
                          $especialidades = ControladorPacientes::ctrMostrarPacientes();
                          
                          foreach ($especialidades as $key => $value) {
                            
                            echo '<option value="'.$value["columna"].'">'.$value["columna"].'</option>';
                          }

                        ?>
                      </select>
                    </div>
                  </div>            
                </div>
                <div class="row text-right">
                  <input type="hidden" name="numero_id" id="numero_id" value="">
                  <div class="col-md-12">
                    <div class="form-group">                      
                      <button type="button" class="btn btn-success mt-5" onclick="agregar()">Agregar Columna</button>
                      <button type="button"  class="btn btn-danger mt-5" onclick="eliminar_columna()">Eliminar Columna</button>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label for="exampleFormControlSelect1">Seleccione rango de fecha</label>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="text-center">Fecha Inicial</label>                     
                      <input type="date" class="form-control" name="fechai" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="text-center">Fecha Final</label>                      
                      <input type="date"  class="form-control" name="fechaf" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="text-center">Especialidad</label>                      
                      <select class="especialidades js-states custom-select" id="especialidad" name="especialidad" required>
                        <option value="t">Todos</option>
                        <?php
   
                          $especialidades = ControladorEspecialidades::ctrMostrarEspecialidades();
                          
                          foreach ($especialidades as $key => $value) {
                            
                            echo '<option value="'.$value["option_id"].'">'.$value["title"].'</option>';
                          }

                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="text-center">Sucursal</label>                      
                      <select class="custom-select" name="sucursal" id="sucursal" required>
                        <option value="t">Todos</option>
                        <?php
   
                          $sucursales = ControladorSucursales::ctrMostrarSucursales();
                          
                          foreach ($sucursales as $key => $value) {
                            
                            echo '<option value="'.$value["id"].'">'.$value["name"].'</option>';
                          }

                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row text-right">
                  <div class="col-md-12">
                    <div class="form-group">                      
                      <button type="submit" class="btn btn-info" onclick="loading(this)">Buscar</button>
                    </div>
                  </div>
                </div>
              </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <?php

        require_once 'footer.php';

        ?>
    </div>
  </main>
  
  <!--   Core JS Files   -->
  <script src="js/funciones.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js"
  integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
  crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <script>
    var informe = document.getElementById("crear_tabla").className = "nav-link text-white active bg-gradient-primary"
    //console.log(atencion);
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.0.5"></script>
  <script>
    $(document).ready(function() {
        $('.columna').select2();
    });

    $(document).ready(function() {
        $('.especialidades').select2();
    });
  </script>
</body>

</html>

<?php

    }else{

        header('location:../index.php');

    }

?>