<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Modern, flexible and responsive Bootstrap 5 admin &amp; dashboard template">
        <meta name="author" content="Bootlab">

        <title>Spark - Bootstrap 5 Admin &amp; Dashboard Template</title>

        <link href="<?= base_url(); ?>/assets/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url(); ?>/assets/css/light.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url(); ?>/assets/css/stockism.css" rel="stylesheet" type="text/css">
        
    </head>

    <body>
        <?php
            if (isset($this->session->userdata['logged_in'])) {
                $email_user = ($this->session->userdata['logged_in']['email_user']);
                $user_role = ($this->session->userdata['logged_in']['id_usertype']);
                $name = ($this->session->userdata['logged_in']['name']);
            } else {
                header("location: Home");
            }
        ?>

        <div class="wrapper">
            <nav id="sidebar" class="sidebar">
                <a class="sidebar-brand" href="<?= site_url('Dashboards'); ?>">
                    <svg>
                    <use xlink:href="#ion-ios-pulse-strong"></use>
                    </svg>
                    STOCKISM
                </a>
                
                <div class="sidebar-content">
                    <div class="sidebar-user">

                        <img src="<?= base_url(); ?>/assets/img/avatars/<?= $this->session->userdata['logged_in']['photo'] ?>" class="img-fluid rounded-circle mb-2"/>
                        
                        <div class="fw-bold"><?php if($name == null){ echo ucfirst($email_user); }else{ echo ucfirst($name); }?></div>
                        <small><?= ucfirst($user_role) ?></small>
                    </div>

                    <!-- Sidebar -->
                    <?php $this->load->view("Shared/_Menu.php") ?>
                </div>
            </nav>

            <div class="main">
                <!-- NavBar -->
                <?php $this->load->view("Shared/_NavBar.php") ?>

                <!-- Body -->
                    <div class="container-fluid" style="font-size: 13px;">
                        
                        <?php $this->load->view($content) ?>
                    </div>

                <!-- Footer -->
                <footer class="footer pt-5">
                    <div class="container-fluid">
                        <div class="row text-muted">
                            <div class="col-8 text-start">
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a class="text-muted" href="Home">Contact</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-4 text-end">
                                <p class="mb-0">
                                    &copy; 2022 - <a href="<?= site_url('Dashboards'); ?>" class="text-muted">Stockism</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>

        </div>

        <script src="<?= base_url(); ?>assets/js/main/app.js"></script>
        <script src="<?= base_url(); ?>assets/sweetalert2/sweetalert2.min.js"></script>
        <script src="<?= base_url(); ?>assets/jquery-validation-unobtrusive/jquery.validate.unobtrusive.min.js"></script>
        <script src="<?= base_url(); ?>assets/jquery-validation/dist/jquery.validate.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/main/main.js"></script>
        <script src="<?= base_url(); ?>assets/js/<?= $javascripts?>.js"></script>
        <?php $this->load->view("Home/_Notification.php") ?> 

    </body>

</html>