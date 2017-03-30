<body class="texture">

    <div id="cl-wrapper" class="login-container">

        <div class="middle-login">
            <div class="block-flat">
                <div class="header">							
                    <h3 class="text-center"><img class="logo-img" src="<?php echo base_url(PUBLIC_URL_PATH) ?>/images/logo.png" alt="logo"/>Login</h3>
                </div>
                <div>
                    <?php
                    $attributes = array('name' => 'login_form', 'id' => 'login_form', 'class' => 'form-horizontal', 'style' => 'margin-bottom: 0px !important;');
                    echo form_open('user_account/login', $attributes);
                    ?>

                    <div class="content">
                        <h4 class="title">Login Access</h4>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <?php
                                    $username = array(
                                        'name' => 'username',
                                        'id' => 'username',
                                        'placeholder' => 'Username',
                                        'class' => 'form-control',
                                    );
                                    echo form_input($username);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <?php
                                    $password = array(
                                        'name' => 'password',
                                        'id' => 'password',
                                        'placeholder' => 'Password',
                                        'class' => 'form-control',
                                    );
                                    echo form_password($password);
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

                        <button class="btn btn-primary" data-dismiss="modal" type="submit">Log me in</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>

        </div> 

    </div>