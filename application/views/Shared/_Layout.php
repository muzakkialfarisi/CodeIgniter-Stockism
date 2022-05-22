<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Modern, flexible and responsive Bootstrap 5 admin &amp; dashboard template">
        <meta name="author" content="Bootlab">

        <title><?= $menukey ?></title>
        <link rel="shortcut icon" href="<?= base_url().'assets/img/products/default-product.png';?>">

        <link href="<?= base_url(); ?>/assets/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url(); ?>/assets/css/light.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url(); ?>/assets/css/stockism.css" rel="stylesheet" type="text/css">
        
    </head>

    <body>
        <?php
            if (isset($this->session->userdata['logged_in'])) {
                $email_user = ($this->session->userdata['logged_in']['email']);
                $user_role = ($this->session->userdata['logged_in']['id_usertype']);
                

                if($this->session->userdata['logged_in']['id_usertype'] == "Tenant") { 
                    $account = $this->db->query("SELECT * FROM mastenant where email = '$email_user'")->row();
                }
                else{
                    $account = $this->db->query("SELECT * FROM masemployee where email = '$email_user'")->row();
                }
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
                        <?php if($this->session->userdata['logged_in']['id_usertype'] == "Admin") { ?>
                            <img src="<?= base_url(); ?>assets/img/avatars/admin.png" class="img-fluid rounded-circle mb-2"/>
                            <div class="fw-bold"> Admin </div>
                        <?php } ?>

                        <?php if($this->session->userdata['logged_in']['id_usertype'] != "Admin") { ?>
                            <img src="<?= base_url(); ?>assets/img/avatars/<?= $account->picture ?>" class="img-fluid rounded-circle mb-2"/>
                            <div class="fw-bold"> <?= $account->name; ?></div>
                            <input name="user_id" type="hidden" value="<?= $this->session->userdata['logged_in']['email_tenant']; ?>">
                        <?php } ?>
                        
                        
                        <input name="id_usertype" type="hidden" value="<?= $user_role; ?>">
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

        <script src="<?= base_url(); ?>assets/js/main/app.js?<?= time() ?>"></script>
        <script src="<?= base_url(); ?>assets/sweetalert2/sweetalert2.min.js?<?= time() ?>"></script>
        <script src="<?= base_url(); ?>assets/js/main/main.js?<?= time() ?>"></script>
        <script src="<?= base_url(); ?>assets/js/<?= $javascripts ?>.js?<?= time() ?>"></script>
        <?php $this->load->view("Home/_Notification.php") ?> 

    </body>

</html>