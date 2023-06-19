<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Welcome <?= esc(current_user()->name) ?></title>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Musk Process Services</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?= base_url('/inspection'); ?>">Home</a>
          </li>

          <!-- dropdown-1 -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Welcome <?= esc(current_user()->name) ?>
              <?php if (current_user()->role_id == 0){ ?>
                  (Admin)
              <?php }else if (current_user()->role_id == 1){ ?>
                  (Engineer)
              <?php }else if (current_user()->role_id == 2){ ?>
                  (Manager)
              <?php } ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="<?= base_url("/user/edit/".current_user()->user_id); ?>">Edit Profile</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="<?= base_url("/logout"); ?>">Logout</a></li>
            </ul>
          </li>

          <!-- ENGINEER SECTION -->
          <?php if (current_user()->role_id == 1){ ?>
            <!-- dropdown-2 -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Inspection
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="<?= site_url("/inspection/newinspection") ?>">New Site Inspection</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="<?= site_url("/inspection/inspectionlist") ?>">Site Inspection List</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="<?= site_url("/inspection/newinspection") ?>">Inspection Action List</a></li>
              </ul>
            </li>
          <?php } ?>


          <!-- MANAGER SECTION -->
          <?php if (current_user()->role_id == 2){ ?>
            <!-- dropdown-2 -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Manager
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="<?= site_url("/inspection/inspectionlist") ?>">Inspections</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="<?= site_url("/intervention/interventionlist") ?>">Interventions</a></li>
              </ul>
            </li>

            
          <?php } ?>

          <!-- ADMIN SECTION -->
          <?php if (current_user()->role_id == 0){ ?>
            <!-- dropdown-3 -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Admin
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="<?= site_url("/user/index") ?>">Users</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="<?= site_url("/inspection/inspectionlist") ?>">Inspections</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="<?= site_url("/intervention/interventionlist") ?>">Interventions</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="<?= site_url("/site/sitelist") ?>">Sites</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="<?= site_url("/inspectiontype/inspectiontypelist") ?>">Inspection Types</a></li>
                <li> 
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="<?= site_url("/type/typelist") ?>">Types</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="<?= site_url("/category/categorylist") ?>">Categories</a></li>
              </ul>
            </li>
          <?php } ?>

          <li class="nav-item">
              <a class="nav-link" href="<?= base_url(); ?>">Back to index</a>
          </li>

        </ul>
      </div>
    </div>
  </nav>

  <style>
    .menu {
      margin-top: 5%;
    }

    .menu_insp {
      margin-bottom: 3%;
    }

    .div-box1 {
      border: 5px solid black;
      width: 500px;
      margin: auto;
      text-align: center;
    }

    h3 {
      margin-top: 2%;
      
    }

    .div-box2 {
      width: 500px;
      border: 5px solid black;
      padding-left: 6px;
      text-align: center;
      margin: auto;
    }
  </style>

  <br>
  <?= $this->renderSection('content'); ?>


  <!-- footer -->
  <footer class="bg-dark text-white px-2 py-2 ">
    <div>
      <p class="text-center">&copy; Musk Process Services 2022 All Copy Rights Reserved</p>
    </div>
  </footer>

  <!-- Option 2: Separate Popper and Bootstrap JS -->

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>

</html>