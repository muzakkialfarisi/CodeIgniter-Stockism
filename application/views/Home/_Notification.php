<?php if($this->session->flashdata('success') != null){ ?>
    <script type="text/javascript">
		toastr.success('<?= $this->session->flashdata('success') ?>','', {
            positionClass: 'toast-top-right',
            closeButton: false,
            progressBar: false,
            newestOnTop: true,
            rtl: $("body").attr("dir") === "rtl" || $("html").attr("dir") === "rtl",
            timeOut: 3000
        });
	</script>
<?php } ?>

<?php  if($this->session->flashdata('error') != null){ ?>
    <script type="text/javascript">
		toastr.error('<?= $this->session->flashdata('error') ?>','', {
            positionClass: 'toast-top-right',
            closeButton: false,
            progressBar: false,
            newestOnTop: true,
            rtl: $("body").attr("dir") === "rtl" || $("html").attr("dir") === "rtl",
            timeOut: 3000
        });
	</script>
<?php } ?>