<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Modern, flexible and responsive Bootstrap 5 admin &amp; dashboard template">
        <meta name="author" content="Bootlab">

        <title>Spark - Bootstrap 5 Admin &amp; Dashboard Template</title>

        <link href="<?= base_url(); ?>/css/light.css" rel="stylesheet">
        <style>
            body {
                opacity: 0;
            }
        </style>
        <link href="<?= base_url(); ?>/css/stockism.css" rel="stylesheet">
    </head>

    <body>
        <?php $this->load->view("Home/Header.php") ?>

        <?php $this->load->view("UserAuthentications/Signin.php") ?>

        <?php $this->load->view($content) ?>

        <?php $this->load->view("Home/Footer.php") ?>

        <script src="<?= base_url(); ?>/js/app.js"></script>

        <?php $this->load->view("Home/_Notification.php") ?>    
    </body>
</html>