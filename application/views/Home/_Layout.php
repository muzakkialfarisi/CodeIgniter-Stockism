<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Modern, flexible and responsive Bootstrap 5 admin &amp; dashboard template">
        <meta name="author" content="Bootlab">

        <title>Stockism</title>
        <link rel="shortcut icon" href="<?= base_url().'assets/img/products/default-product.png';?>">

        <link href="<?= base_url(); ?>/assets/css/light.css" rel="stylesheet">
        <style>
            body {
                opacity: 0;
            }
        </style>
        <link href="<?= base_url(); ?>/assets/css/stockism.css" rel="stylesheet">
    </head>

    <body>
        <?php $this->load->view("Home/Header.php") ?>
        <?php $this->load->view("Home/UserAuthentications/Signin.php") ?>
        <?php $this->load->view($content) ?>
        <?php $this->load->view("Home/Footer.php") ?>

        <script src="<?= base_url(); ?>/assets/js/main/app.js?<?= time() ?>"></script>
        <script src="<?= base_url(); ?>assets/js/<?= $javascripts ?>.js?<?= time() ?>"></script>

        <?php $this->load->view("Home/_Notification.php") ?>    
    </body>
</html>