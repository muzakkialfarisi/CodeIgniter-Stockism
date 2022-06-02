<div class="row">
    <div class="col-12 col-lg-5">
        <?php $this->load->view("Piutangs/DetailPiutang.php") ?>
    </div>
    <div class="col-12 col-lg-7">
        <?php $this->load->view("Piutangs/DetailPiutangAngsuran.php") ?>
    </div>
</div>

<form action="<?= site_url('UtangAngsurans/DeletePost') ?>" id="DeletePost" method="post">
    <input type="text" class="form-control" name="id_angsuran" hidden required>
</form>

<?php $this->load->view("Piutangs/ModalAddPayment.php") ?>