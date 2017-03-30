<?php if ($this->session->flashdata('error')) { ?>
    <div class="alert alert-danger alert-white rounded">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <div class="icon"><i class="fa fa-times-circle"></i></div>
        <span style="float: left"><?php echo $this->session->flashdata('error'); ?></span>
    </div>
<?php } ?>
<?php if ($this->session->flashdata('success')) { ?>
    <div class="alert alert-success alert-white rounded">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <div class="icon"><i class="fa fa-check"></i></div>
        <span style="float: left"><?php echo $this->session->flashdata('success'); ?></span>
    </div>
<?php } ?>