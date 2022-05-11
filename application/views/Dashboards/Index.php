<?php if($this->session->userdata['logged_in']['id_usertype'] != "Admin"){ ?>
	<?php $this->load->view("Dashboards/DashboardTenant.php") ?>
<?php } ?>

<?php if($this->session->userdata['logged_in']['id_usertype'] == "Admin"){ ?>
	<?php $this->load->view("Dashboards/DashboardAdmin.php") ?>
<?php } ?>