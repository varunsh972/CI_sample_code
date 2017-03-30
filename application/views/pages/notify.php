<body class="texture">

    <div id="cl-wrapper" class="login-container">

        <div class="middle-login">
            <div class="block-flat">
                <div class="header">							
                    <h3 class="text-center">
                        <img class="logo-img" src="<?php echo base_url(PUBLIC_URL_PATH) ?>/images/logo.png" alt="logo"/>
                        Message
                    </h3>
                </div>
                <div>

                    <div class="content">
                        <div class="foot">
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
                            <a href="<?php echo base_url('user_account/login'); ?>">Back to login</a>
                        </div>
                    </div>
                </div>
            </div>

        </div> 

    </div>