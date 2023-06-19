<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>/public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/assets/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Musk Process Services</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark mynav">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url(); ?>">Musk Process Services</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?= base_url(); ?>">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url(); ?>/home/about">About</a>
                    </li>

                    <?php if (session()->has('user_id')): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url(); ?>/inspection">Inspection</a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url(); ?>/home/contact">Contact Us</a>
                    </li>

                    <?php if (session()->has('user_id')){ ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url("/logout"); ?>">Log out</a>
                        </li>
                        <li class="nav-item">
                            <p class="nav-link" style="color:white;height: 0px;">Hello <?= esc(current_user()->name) ?>
                                <?php if (current_user()->role_id == 0){ ?>
                                    (Admin)
                                <?php }else if (current_user()->role_id == 1){ ?>
                                    (Enginner)
                                <?php }else if (current_user()->role_id == 2){ ?>
                                    (Manager)
                                <?php } ?>
                            </p>

                        </li>
                    <?php }else{ ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url(); ?>/signup">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url(); ?>/login">Login</a>
                        </li>
                    <?php } ?>

                </ul>

            </div>
        </div>
    </nav>

    <!-- entering render section method -->
    <?= $this->renderSection('content'); ?>
<br>
    <footer class="bg-primary text-white px-2 py-2 ">
        <div>
            <p class="text-center">&copy; Musk Process Services 2022 All Copy Rights Reserved</p>
        </div>
    </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?= base_url(); ?>/public/assets/js/jquery-3.2.1.slim.min.js"></script>
    <script src="<?= base_url(); ?>/public/assets/js/popper.min.js"></script>
    <script src="<?= base_url(); ?>/public/assets/js/bootstrap.min.js"></script>
</body>

</html>