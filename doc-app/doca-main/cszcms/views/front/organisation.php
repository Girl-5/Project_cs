<section class="fullContainer centerBox projectDesc"> <!-- full width -->
    <div class="container"> <!-- container width -->
        <div class="wrapper"> <!-- full width wrapper -->
            <div class="formBox">
                <div class="formWrapper">
                    <?php echo form_open_multipart(base_url(). 'save_organisation/'.$this->uri->segment(2)); ?>
                    <?php if($this->session->flashdata('error_message') != ''){ ?>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <?php echo $this->session->flashdata('error_message'); ?>
                            </div>
                        </div>
                        <?php } ?>
                         <div class="progressBarBox">
                        <span>Your Progress</span>
                        <label>80% to complete</label>
                        <div class="progressBar">
                            <div class="selection progress8"></div>
                        </div><!-- progress bar -->
                    </div><!-- progress bar box -->
                    <h2>Organisation:</h2>
                    
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
                                'class' => 'form-control',
                                'maxlength' => '500',
                                'value' => set_value('project_timeline', $application['project_timeline'], FALSE)
                            );
                            echo form_input($data);
                            echo form_error('project_timeline', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    </div>
                    
                    <div class="formRow">
                        <label>In detail describe the background of your project identifying the issue/problem your organisation seeks to address with your initiative:</label>
                         <?php
                            $data = array(
                                'name' => 'project_describe',
                                'autofocus' => 'true',
                                'class' => 'form-control',
                                'maxlength' => '2000',
                                'value' => set_value('project_describe', $application['project_describe'], FALSE)
                            );
                            echo form_textarea($data);
                            echo form_error('project_describe', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    </div>
                    <div class="formRow">
                        <label>Describe in detail how your organisation has designed your initiative to effectively address the issue/problem in your proposed project.</label>
                         <?php
                            $data = array(
                                'name' => 'organisation',
                                'autofocus' => 'true',
                                'class' => 'form-control',
                                'maxlength' => '2000',
                                'value' => set_value('organisation', $application['organisation'], FALSE)
                            );
                            echo form_textarea($data);
                            echo form_error('organisation', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    </div>
                    <div class="formRow">
                        <label>In detail explain why your organisation is best suited to execute the above project. Ensure to list any successful projects that your organisation has undertaken prior to this application.:</label>
                         <?php
                            $data = array(
                                'name' => 'explain_organisation',
                                'autofocus' => 'true',
                                'class' => 'form-control',
                                'maxlength' => '2000',
                                'value' => set_value('explain_organisation', $application['explain_organisation'], FALSE)
                            );
                            echo form_textarea($data);
                            echo form_error('explain_organisation', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    </div>
                    <div class="formRow">
                        <label>List and briefly explain your organisation’s Key Performance Indicators regarding project success:</label>
                         <?php
                            $data = array(
                                'name' => 'briefly_explain',
                                'autofocus' => 'true',
                                'class' => 'form-control',
                                'maxlength' => '2000',
                                'value' => set_value('briefly_explain', $application['briefly_explain'], FALSE)
                            );
                            echo form_textarea($data);
                            echo form_error('briefly_explain', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    </div>
                    <div class="formRow">
                        <label>Outline the projected socio-economic impact of your proposed programme/project on documentary filmmakers, producers & stakeholders within your region of operations:</label>
                         <?php
                            $data = array(
                                'name' => 'socio_economic',
                                'autofocus' => 'true',
                                'class' => 'form-control',
                                'maxlength' => '2000',
                                'value' => set_value('socio_economic', $application['socio_economic'], FALSE)
                            );
                            echo form_textarea($data);
                            echo form_error('socio_economic', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    </div>
                    <div class="formRow">
                        <label>Motivation Video: (Minimum 3 minutes):</label>
                         <?php
                            $data = array(
                                'name' => 'video_link',
                                'autofocus' => 'true',
                                'class' => 'form-control',
                                'maxlength' => '2000',
                                'value' => set_value('video_link', $application['video_link'], FALSE)
                            );
                            echo form_input($data);
                            echo form_error('video_link', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    </div>
                    
                    <div class="formRow">
                        <label>Upload a well-written proposal document:</label>
                        <input type="file" name="file_upload" />
                        <input type="hidden" name="uploadId" value="<?php echo $application['proposal_upload']; ?>" />
                    </div>
                    
                    <?php if(!empty($application['proposal_upload'])){ ?>
                        <div class="formRow">
                           <a target="_blank" href="<?php echo base_url('photo/image/'.$application['proposal_upload']); ?>" > <i style="font-size: 38px;" class="fa fa-file" aria-hidden="true"></i> </a>
                        </div>
                    <?php } ?>
                    
                    <div class="footerRow">
                        <a href="<?php echo base_url('project_budget/'.$this->uri->segment(2)); ?>" class="button btnBack">Back</a>
                        <button type="submit" class="button">Save & Continue</button>
                    </div>
                    <?php echo form_close(); ?>
                </div><!-- form wrapper -->
            </div><!-- form box -->
        </div>
    </div>
</section><!-- project Description -->

<script>
       function add(){
        var rowId = $(".tbl").length;
        rowId = rowId + 1;
        var data = '<tr class="tbl" id="div'+rowId+'">'+
'                        <td><input type="text" placeholder="Link" name="project_link[]" class="form-control"></td>'+
                        '<td><input type="text" placeholder="Password" name="project_password[]" class="form-control"></td>'+
                        '<td><a style="background: #e62551;" href="javascript:;" onclick="remove('+rowId+')" class="button">X</a></td>'+
                    '</tr>';
        
        $("#member").append(data);
    }
    
    function remove(id){
       $("#div"+id).remove(); 
    }
</script>