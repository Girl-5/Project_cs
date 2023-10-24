<section class="fullContainer centerBox resetPass"> <!-- full width -->
    <div class="container"> <!-- container width -->
        <div class="wrapper"> <!-- full width wrapper -->
        <?php echo form_open_multipart(base_url(). 'resetPassword/'); ?>
                    <?php if($this->session->flashdata('error_message') != ''){ ?>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <?php echo $this->session->flashdata('error_message'); ?>
                            </div>
                        </div>
                        <?php } ?>
            <div class="formBox">
                <div class="formWrapper">
                    <h2>Reset Password</h2>
                    <div class="formRow">
                        <label>Email Address:</label>
                        <?php
                            $data = array(
                                'name' => 'email',
                                'autofocus' => 'true',
                                'type' => 'email',
                                'placeholder'  => 'Email',
                                'class' => 'form-control',
                                'maxlength' => '255',
                                'value' => set_value('email', '', FALSE)
                            );
                            echo form_input($data);
                            echo form_error('email', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    </div>
                    <div class="formRow">
                       <label class="text-right"><a href="<?php echo base_url('login'); ?>">Sign In?</a> &nbsp;|&nbsp; <a href="<?php echo base_url('register'); ?>">Register</a></label>
                    </div>
                    <div class="footerRow">
                        <button type="submit" class="button"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp; Reset Password</button>
                    </div>
                </div><!-- form wrapper -->
            </div><!-- form box -->
            <?php echo form_close(); ?>
        </div>
    </div>
</section><!-- reset password -->