<div class="row">
    <div class="col-12 col-lg-5">
        <?php $this->load->view("Utangs/DetailUtang.php") ?>
    </div>
    <div class="col-12 col-lg-7">
        <?php $this->load->view("Utangs/DetailUtangAngsuran.php") ?>
    </div>
</div>

<form action="<?= site_url('UtangAngsurans/DeletePost') ?>" id="DeletePost">
    <input type="text" class="form-control" name="id_angsuran" readonly required>
</form>