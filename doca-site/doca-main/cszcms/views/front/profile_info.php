<section class="fullContainer centerBox profileInfo"> <!-- full width -->
    <div class="container"> <!-- container width -->
        <div class="wrapper"> <!-- full width wrapper -->
            <div class="formBox">
                <div class="formWrapper">
                    <?php echo form_open_multipart(base_url(). 'saveProfile_info'); ?>
                    <?php if($this->session->flashdata('error_message') != ''){ ?>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <?php echo $this->session->flashdata('error_message'); ?>
                            </div>
                        </div>
                        <?php } ?>
                    <h2>Professional Information</h2>
                    <div class="formRow">
                        <label>Primary Occupation:</label>
                        <?php
                            $data = array(
                                'name' => 'occupation',
                                'autocomplete'  => 'off',
                                'autofocus' => 'true',
                                'class' => 'form-control',
                                'maxlength' => '255',
                                'value' => set_value('occupation', $user['occupation'], FALSE)
                            );
                            $option = array('filmmanker'=>'Filmmaker', 'producer'=>'Producer', 'project_co_ordinator'=>'CoProducer');
                            echo form_dropdown('occupation',$option,$user['occupation'],$data);
                            echo form_error('occupation', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    </div>
                        <!--<div class="formRow">-->
                        <!--<label>Country:</label>-->
                        <?php
                            // $data = array(
                            //     'name' => 'country',
                            //     'autocomplete'  => 'off',
                            //     'autofocus' => 'true',
                            //     'class' => 'form-control',
                            //     'maxlength' => '255',
                            //     'value' => set_value('country', $user['country'], FALSE)
                            // );
                            // $option = array('africa'=>'Africa');
                            // echo form_dropdown('country',$option,$user['country'],$data);
                            // echo form_error('country', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    <!--</div>-->
                    
                    <div class="formRow">
                        <label>Organisation:</label>
                        <?php
                            $data = array(
                                'name' => 'organisation',
                                'autofocus' => 'true',
                                'class' => 'form-control',
                                'maxlength' => '255',
                                'value' => set_value('organisation', $user['organisation'], FALSE)
                            );
                            echo form_input($data);
                            echo form_error('organisation', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    </div>
                    <div class="formRow">
                        <label>Office Number:</label>
                        <?php
                            $data = array(
                                'name' => 'office_number',
                                'autofocus' => 'true',
								'placeholder' => "254 722000000",
                                'class' => 'form-control',
                                'maxlength' => '255',
                                'value' => set_value('office_number', $user['office_number'], FALSE)
                            );
                            echo form_input($data);
                            echo form_error('office_number', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
						
					
                        ?>
                    </div>
                    <div class="formRow">
                        <label>Office Email:</label>
                        <?php
                            $data = array(
                                'name' => 'office_email',
                                'autofocus' => 'true',
                                'type'      => 'email',
                                'class' => 'form-control',
                                'maxlength' => '255',
                                'value' => set_value('office_email', $user['office_email'], FALSE)
                            );
                            echo form_input($data);
                            echo form_error('office_email', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    </div>
                    <div class="formRow">
                        <label>Website:</label>
                        <?php
                            $data = array(
                                'name' => 'website',
                                'autofocus' => 'true',
                                'class' => 'form-control',
                                'maxlength' => '255',
                                'value' => set_value('website', $user['website'], FALSE)
                            );
                            echo form_input($data);
                            echo form_error('website', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    </div>
					<?php 
					$required = "required";
					if(!empty($user['uploadCv'])){ $required = ''; } ?>
                    <div class="formRow">
                        <label>Upload Your CV/BIO-Filmo:</label>
                        <input <?php echo $required; ?> type="file" name="file_upload" />
                        <input type="hidden" value="<?php echo $user['uploadCv']; ?>" name="uploadCv" />
                    </div>
                    <?php if(!empty($user['uploadCv'])){ ?>
                        <div class="formRow">
                           <a target="_blank" href="<?php echo base_url('photo/image/'.$user['uploadCv']); ?>" > <i style="font-size: 38px;" class="fa fa-file" aria-hidden="true"></i> </a>
                        </div>
                    <?php } ?>
                    <div class="formRow">
                        <label>Link To Past Work:</label>
                        <div class="formRow">
                            <!--<label>Rough Footage of the projects:</label>-->
                            <table>
                                <tr>
                                    <td>
                                        <?php
                                            $data = array(
                                                'name' => 'work_link',
                                                'autofocus' => 'true',
												'required' => 'required',
                                                'class' => 'form-control',
                                                'placeholder' => 'Project Link',
                                                'maxlength' => '255',
                                                'value' => set_value('work_link', $user['work_link'], FALSE)
                                            );
                                            echo form_input($data);
                                            echo form_error('work_link', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                                        ?>
                                    </td>
                                    <td>
                                         <?php
                                            $data = array(
                                                'name' => 'password_link',
                                                'autofocus' => 'true',
												'required' => 'required',
                                                'class' => 'form-control',
                                                'placeholder' => 'Password',
                                                'maxlength' => '255',
                                                'value' => set_value('password_link', $user['password_link'], FALSE)
                                            );
                                            echo form_input($data);
                                            echo form_error('password_link', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="footerRow">
						<a href="<?php echo base_url('profile/'); ?>" class="button btnBack">Back</a>
                        <button type="submit" class="button">Save & Continue</button>
                    </div>
                     <?php echo form_close(); ?>
                </div><!-- form wrapper -->
            </div><!-- form box -->
        </div>
    </div>
</section><!-- profile information -->