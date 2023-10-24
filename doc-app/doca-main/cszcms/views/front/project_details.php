<section class="fullContainer centerBox projectDetail"> <!-- full width -->
    <div class="container"> <!-- container width -->
        <div class="wrapper"> <!-- full width wrapper -->
            <div class="formBox">
                <div class="formWrapper">
                    <?php echo form_open_multipart(base_url(). 'saveProject/'.$this->uri->segment(2)); ?>
                    <?php if($this->session->flashdata('error_message') != ''){ ?>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <?php echo $this->session->flashdata('error_message'); ?>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="progressBarBox">
                        <span>Your Progress</span>
                        <label>0% to complete</label>
                        <div class="progressBar">
                            <div class="selection progress0"></div>
                        </div><!-- progress bar -->
                    </div><!-- progress bar box -->
                    <h2>PROJECT DETAILS:</h2>
                   <?php if($grant[0]['description_type'] != 4){ ?>
					<div class="formRow">
                        <label>TITLE:</label>
                         <?php
                            $data = array(
                                'name' => 'name',
								'required' => 'required',
                                'autofocus' => 'true',
                                'class' => 'form-control',
                                'maxlength' => '255',
                                'value' => set_value('name', $application['name'], FALSE)
                            );
                            echo form_input($data);
                            echo form_error('name', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 

                        ?>
                    </div>
                    <div class="formRow">
                        <label>ESTIMATED LENGTH (in minutes):</label>
                         <?php
                            $data = array(
                                'name' => 'p_date',
                                'autofocus' => 'true',
                               'required' => 'required',
                                'class' => 'form-control',
                                'maxlength' => '255',
                                'value' => set_value('p_date', $application['p_date'], FALSE)
                            );
                            echo form_input($data);
                            echo form_error('p_date', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 

                        ?>
                    </div>
                    <!--<div class="formRow">-->
                    <!--    <label>Description:</label>-->
                         <?php
                            // $data = array(
                            //     'name' => 'description',
                            //     'autofocus' => 'true',
                            //     'class' => 'form-control',
                            //     'maxlength' => '255',
                            //     'value' => set_value('description', $application['description'], FALSE)
                            // );
                            // echo form_textarea($data);
                            // echo form_error('description', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    <!--</div>-->
                    <div class="formRow">
                       <label>FORM</label>
                       <?php
                            $data = array(
                                'name' => 'e_length',
                                'autocomplete'  => 'off',
                                'autofocus' => 'true',
                                'class' => 'form-control',
                                'maxlength' => '255',
                                'value' => set_value('e_length', $application['e_length'], FALSE)
                            );
                            $option = array('9-20'=>'Short (9-20min)', '21-59'=>'Mid-length (21-59min)', '60+'=>'Full length (60+min)');
                            echo form_dropdown('e_length',$option,$application['e_length'],$data);
                            echo form_error('e_length', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    </div>
					
					<?php }else{ ?>
						        <div class="formRow">
                        <label>Project Category:</label>
                        <?php
                            $data = array(
                                'name' => 'project_category',
                                'autocomplete'  => 'off',
                                'autofocus' => 'true',
                                'class' => 'form-control',
                                'maxlength' => '255',
                                'value' => set_value('project_category', $application['project_category'], FALSE)
                            );
                            
                            $project_category = array('1' => "Workshop/Residencies", '2'=>'Labs', '3' => 'Screenings', '4' => 'Festivals');
                            echo form_dropdown('project_category',$project_category,$application['project_category'],$data);
                            echo form_error('project_category', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    </div>
                    
                    <div class="formRow">
                        <label>Briefly describe your project:</label>
                         <?php
                            $data = array(
                                'name' => 'project_brief',
                                'autofocus' => 'true',
                                'required' => 'required',
                                'class' => 'form-control',
                                'maxlength' => '500',
                                'value' => set_value('project_brief', $application['project_brief'], FALSE)
                            );
                            echo form_textarea($data);
                            echo form_error('project_brief', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    </div>
                    
                    <div class="formRow">
                        <label>Project Timeline (IN WEEKS):</label>
                         <?php
                            $data = array(
                                'name' => 'project_timeline',
                                'autofocus' => 'true',
                                'placeholder'=> "2",
                                'required' => 'required',
                                'class' => 'form-control',
                                'maxlength' => '500',
                                'value' => set_value('project_timeline', $application['project_timeline'], FALSE)
                            );
                            echo form_input($data);
                            echo form_error('project_timeline', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    </div>
                    
					<?php } ?>
                    <div class="footerRow">
                        <button type="submit" class="button">Save & Continue</button>
                    </div>
                </div><!-- form wrapper -->
            </div><!-- form box -->
        </div>
    </div>
</section><!-- project details -->