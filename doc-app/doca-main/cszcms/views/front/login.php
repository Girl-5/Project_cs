<section class="fullContainer centerBox signInBox"> <!-- full width -->
    <div class="container"> <!-- container width -->
        <div class="wrapper"> <!-- full width wrapper -->

            <div class="formBox">
                <div class="formWrapper">
                    <?php echo form_open_multipart(base_url(). '/loginCheck'); ?>
                    <?php if($this->session->flashdata('error_message') != ''){ ?>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <?php echo $this->session->flashdata('error_message'); ?>
                            </div>
                        </div>
                        <?php } ?>
                    <h2>Sign In</h2>
                    <!--<div class="formRow">-->
                    <!--    <label>Name:</label>-->
                    <!--    <input type="text" name="name" autocomplete="off"/>-->
                    <!--</div>-->
                    <div class="formRow">
                        <label>Email Address:</label>
                        <?php
                            $data = array(
                                'name' => 'email',
                                'type' => 'email',
                                'required' => 'required',
                                'autofocus' => 'true',
                                'class' => 'form-control',
                                'maxlength' => '255',
                                'value' => set_value('email', '', FALSE)
                            );
                            echo form_input($data);
                            echo form_error('email', '<div style="background-color: #f44336;" class="alert success alert-success" role="alert">', '</div>'); 

                        ?>
                    </div>
                    <div class="formRow">
                        <label>Password:</label>
                        <?php
                            $data = array(
                                'name' => 'password',
                                'id' => 'password',
                                'required' => 'required',
                                'autofocus' => 'true',
                                'class' => 'form-control',
                                'maxlength' => '255',
                                'value' => set_value('password', '', FALSE)
                            );
                            echo form_password($data);
                        ?>
                    </div>
                    <div class="formRow">
                        <label class="text-right"><a href="<?php echo base_url('forgetPassword'); ?>">Forgot Password?</a> &nbsp;|&nbsp; <a href="<?php echo base_url('eligibility_test') ?>">Register</a></label>
                    </div>
                    <div class="footerRow">
                        <button type="submit" class="button">Login</button>
                    </div>
                    <?php echo form_close(); ?>
                </div><!-- form wrapper -->
            </div><!-- form box -->
        </div>
        
    </div>
</section><!-- Sign in -->