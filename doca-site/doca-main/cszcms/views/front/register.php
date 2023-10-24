<section class="fullContainer centerBox welcomeScreen"> <!-- full width -->
    <div class="container"> <!-- container width -->
        <div class="wrapper"> <!-- full width wrapper -->
                    <?php if($this->session->flashdata('error_message') != ''){ ?>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <?php echo $this->session->flashdata('error_message'); ?>
                            </div>
                        </div>
                        <?php } ?>      
            <div class="formBox">
                <div class="formWrapper">
                    <h2>Welcome to DOCA</h2>
                            <?php echo form_open_multipart($this->Csz_model->base_link(). '/saveRegister'); ?>

                    <div class="formRow">
                        <label>Name:</label>
                        <?php
                            $data = array(
                                'name' => 'name',
                                'required' => 'required',
                                'autofocus' => 'true',
                                'class' => 'form-control',
                                'maxlength' => '255',
                                'value' => set_value('name', '', FALSE)
                            );
                            echo form_input($data);
                            echo form_error('name', '<div style="background-color: #f44336;" class="alert success alert-success" role="alert">', '</div>'); 

                        ?>
                    </div>
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
                        <p style="text-align: center;">By registering for a DocA profile, you accept our <a href="https://documentaryafrica.org">policies and terms of use</a>.</p>
                    </div>
                    <div class="footerRow">
                        <button type="submit" class="button">Submit</button>
                    </div>
                     <?php echo form_close(); ?>
                </div><!-- form wrapper -->
            </div><!-- form box -->
        </div>
    </div>
</section><!-- welcome screen -->


