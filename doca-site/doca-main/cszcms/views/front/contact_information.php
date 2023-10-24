<?php //print_r($data); die; ?>
<section class="fullContainer centerBox contactInfo"> <!-- full width -->
    <div class="container"> <!-- container width -->
        <div class="wrapper"> <!-- full width wrapper -->
            <div class="formBox">
                <div class="formWrapper">
                    <!--<div class="progressBarBox">-->
                    <!--    <span>Your Progress</span>-->
                    <!--    <label>10% to complete</label>-->
                    <!--    <div class="progressBar">-->
                    <!--        <div class="selection progress1"></div>-->
                    <!--    </div><!-- progress bar -->
                    <!--</div>-->
                    <?php echo form_open_multipart(base_url(). '/saveContact'); ?>
                    <?php if($this->session->flashdata('error_message') != ''){ ?>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <?php echo $this->session->flashdata('error_message'); ?>
                            </div>
                        </div>
                        <?php } ?>
                    <h2>Contact Information</h2>
                    
                    <div class="formRow">
                        <label>Name:</label>
                         <?php
                            $data = array(
                                'name' => 'name',
                                'autofocus' => 'true',
                                'class' => 'form-control',
                                'maxlength' => '255',
                                'value' => set_value('name', $user['name'], FALSE)
                            );
                            echo form_input($data);
                            echo form_error('name', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 

                        ?>
                    </div>
                    <div class="formRow">
                        <label>Phone Number (with country code):</label>
                         <?php
                            $data = array(
                                'name' => 'phone',
								'required' => "required",
                                'autofocus' => 'true',
								'placeholder' => "254 722000000",
                                'class' => 'form-control',
                                'maxlength' => '255',
                                'value' => set_value('phone', $user['phone'], FALSE)
                            );
                            echo form_input($data);
                            echo form_error('phone', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 

                        ?>
                    </div>
                    <div class="formRow">
                        <label>WhatsApp Number (If different from the phone
number) [OPTIONAL].</label>
                         <?php
                            $data = array(
                                'name' => 'whatsapp_number',
                                'autofocus' => 'true',
								'placeholder' => "254 722000000",
                                'class' => 'form-control',
                                'maxlength' => '255',
                                'value' => set_value('whatsapp_number', $user['whatsapp_number'], FALSE)
                            );
                            echo form_input($data);
                            echo form_error('whatsapp_number', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 

                        ?>
                    </div>
                    <div class="formRow">
                        <label>Email Address:</label>
                         <?php
                            $data = array(
                                'name' => 'email',
                                'type' => 'email',
                                'readonly' => 'readonly',
                                'autofocus' => 'true',
                                'class' => 'form-control',
                                'maxlength' => '255',
                                'value' => set_value('email', $user['email'], FALSE)
                            );
                            echo form_input($data);
                            echo form_error('email', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 

                        ?>
                    </div>
                   <!-- <div class="formRow">-->
                        <!-- <label>Password:</label>
                       // <?php
                           // $data = array(
                             //   'name' => 'password',
                               // 'autofocus' => 'true',
                              //  'autocomplete' => 'off',
                              //  'class' => 'form-control',
                              //  'maxlength' => '255',
                              //  'value' => set_value('password', '', FALSE)
                         //   );
                            //echo form_password($data);
                           // echo form_error('password', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 

                       // ?>
                    </div>
                    <div class="formRow">
                        <label>Confirm Password:</label>
                        // <?php
                          //  $data = array(
                               // 'name' => 'con_password',
                               // 'autofocus' => 'true',
                               // 'class' => 'form-control',
                               // 'maxlength' => '255',
                                //'value' => set_value('con_password', '', FALSE)
                          //  );
                         //   echo form_password($data);
                         //   echo form_error('con_password', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 

                       // ?>
                    <!--</div>-->
                    <div class="footerRow">
						<a href="<?php echo base_url('profile_info/'); ?>" class="button btnBack">Back</a>
                        <button type="submit" class="button">Save & Finish</button>
                    </div>
                    <?php echo form_close(); ?>
                </div><!-- form wrapper -->
            </div><!-- form box -->
        </div>
    </div>
</section><!-- contact information -->