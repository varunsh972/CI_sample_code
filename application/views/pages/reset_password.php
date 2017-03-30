<body class="texture">

    <div id="cl-wrapper" class="login-container">

        <div class="middle-login">
            <div class="block-flat">
                <div class="header">							
                    <h3 class="text-center"><img class="logo-img" src="<?php echo base_url(PUBLIC_URL_PATH) ?>/images/logo.png" alt="logo"/>Forgot Password</h3>
                </div>
                <div>
                    <?php
                    $attributes = array('name' => 'reset_pass', 'id' => 'reset_form', 'class' => 'form-horizontal', 'style' => 'margin-bottom: 0px !important;');
                    echo form_open('user_account/update_password', $attributes);
                    ?>

                    <div class="content">
                        <h4 class="title">Reset Password</h4>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <?php
                                    $password = array(
                                        'name' => 'password',
                                        'id' => 'password',
                                        'placeholder' => 'New Password',
                                        'class' => 'form-control',
                                    );
                                    echo form_password($password);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <?php
                                    $cpassword = array(
                                        'name' => 'cpassword',
                                        'id' => 'cpassword',
                                        'placeholder' => 'Confirm Password',
                                        'class' => 'form-control',
                                    );
                                    echo form_password($cpassword);
                                    ?>
                                     <?php
                                    
                                    echo form_hidden('token', $token);
                                    ?>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="foot">
                        <?php if ($this->session->flashdata('error')) { ?>
                            <div class="alert alert-danger alert-white rounded">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <div class="icon"><i class="fa fa-times-circle"></i></div>
                                <span style="float: left"><?php echo $this->session->flashdata('error'); ?></span>
                            </div>
                        <?php } ?>

                        <button class="btn btn-primary" data-dismiss="modal" type="submit">Update</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>

        </div> 

    </div>