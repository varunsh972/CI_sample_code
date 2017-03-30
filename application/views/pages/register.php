<body class="texture">

    <div id="cl-wrapper" class="sign-up-container">

        <div class="middle-sign-up">
            <div class="block-flat">
                <div class="header">							
                    <h3 class="text-center"><img class="logo-img" src="<?php echo base_url(PUBLIC_URL_PATH) ?>/images/logo.png" alt="logo"/></h3>
                </div>
                <div>
                    <?php
                    $attributes = array('name' => 'signup_form', 'id' => 'signup_form', 'class' => 'form-horizontal', 'style' => 'margin-bottom: 0px !important;');
                    echo form_open('user_account/signUp', $attributes);
                    ?>

                    <div class="content">
                        <h5 class="title text-center"><strong>Sign Up</strong></h5>
                        <hr/>
                        <!--div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-6">
                            <button class="btn btn-block btn-trans btn-facebook bg btn-rad" type="button"><i class="fa fa-facebook"></i> Sign in with Facebook</button>
                          </div>
                          <div class="col-md-6 col-sm-6 col-xs-6">
                            <button class="btn btn-block btn-trans btn-twitter bg btn-rad" type="button"><i class="fa fa-twitter"></i> Sign in with Twitter</button>
                          </div>
                        </div>
                        <p class="text-center">Or</p-->

                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <?php
                                    $username = array(
                                        'name' => 'user_name',
                                        'id' => 'user_name',
                                        'placeholder' => 'Username',
                                        'class' => 'form-control',
                                    );
                                    echo form_input($username);
                                    ?>
                                </div>
                                <div id="nick-error"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    <?php
                                    $email = array(
                                        'name' => 'email',
                                        'id' => 'email',
                                        'placeholder' => 'Email',
                                        'class' => 'form-control',
                                    );
                                    echo form_input($email);
                                    ?>
                                </div>
                                <div id="email-error"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6 col-xs-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <?php
                                    $pass = array(
                                        'name' => 'password',
                                        'id' => 'password',
                                        'placeholder' => 'Password',
                                        'class' => 'form-control',
                                    );
                                    echo form_password($pass);
                                    ?>
                                </div>
                                <div id="password-error"></div>
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <?php
                                    $cpass = array(
                                        'name' => 'cpassword',
                                        'id' => 'cpassword',
                                        'placeholder' => 'Confirm Password',
                                        'class' => 'form-control',
                                    );
                                    echo form_password($cpass);
                                    ?>
                                </div>
                                <div id="confirmation-error"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-taxi"></i></span>
                                    <?php
                                    $company = array(
                                        'name' => 'company',
                                        'id' => 'company',
                                        'placeholder' => 'Company',
                                        'class' => 'form-control',
                                    );
                                    echo form_input($company);
                                    ?>
                                </div>
                                <div id="email-error"></div>
                            </div>
                        </div>
                        <p class="spacer">By creating an account, you agree with the <a href="#">Terms</a> and <a href="#">Conditions</a>.</p>
                        <button class="btn btn-block btn-success btn-rad btn-lg" type="submit">Sign Up</button>

                    </div>
                    </form>
                </div>
            </div>
            <div class="text-center out-links"><a href="#">&copy; <?php echo date('Y'); ?> Your Company</a></div>
        </div> 

    </div>