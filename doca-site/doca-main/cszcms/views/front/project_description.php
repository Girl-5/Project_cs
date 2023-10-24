<section class="fullContainer centerBox projectDesc"> <!-- full width -->
    <div class="container"> <!-- container width -->
        <div class="wrapper"> <!-- full width wrapper -->
            <div class="formBox">
                <div class="formWrapper">
                    <?php echo form_open_multipart(base_url(). 'save_project_description/'.$this->uri->segment(2)); ?>
                    <?php if($this->session->flashdata('error_message') != ''){ ?>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <?php echo $this->session->flashdata('error_message'); ?>
                            </div>
                        </div>
                        <?php } ?>
                         <div class="progressBarBox">
                        <span>Your Progress</span>
                        <label>50% to complete</label>
                        <div class="progressBar">
                            <div class="selection progress5"></div>
                        </div><!-- progress bar -->
                    </div><!-- progress bar box -->
                    <h2>Project Description:</h2>
                    <?php if ($grant['description_type'] == 1) { ?>
                    <div class="formRow">
                        <label>Logline:</label>
                         <?php
                            $data = array(
                                'name' => 'logline',
                                'required' => 'required',
                                'autofocus' => 'true',
                                'class' => 'form-control',
                                'maxlength' => '200',
                                'value' => set_value('logline', $application['logline'], FALSE)
                            );
                            echo form_textarea($data);
                            echo form_error('logline', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    </div>
                    <div class="formRow">
                        <label>Background and story structure:</label>
                         <?php
                            $data = array(
                                'name' => 'story_structure',
                                'autofocus' => 'true',
                                'required' => 'required',
                                'class' => 'form-control',
                                'maxlength' => '2000',
                                'value' => set_value('story_structure', $application['story_structure'], FALSE)
                            );
                            echo form_textarea($data);
                            echo form_error('story_structure', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    </div>
                    <div class="formRow">
                        <label>Characters' Description:</label>
                         <?php
                            $data = array(
                                'name' => 'characters_description',
                                'autofocus' => 'true',
                                'required' => 'required',
                                'class' => 'form-control',
                                'maxlength' => '2000',
                                'value' => set_value('characters_description', $application['characters_description'], FALSE)
                            );
                            echo form_textarea($data);
                            echo form_error('characters_description', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    </div>
                    <div class="formRow">
                        <label>Artistic Approach:</label>
                         <?php
                            $data = array(
                                'name' => 'artistic_approach',
                                'autofocus' => 'true',
                                'required' => 'required',
                                'class' => 'form-control',
                                'maxlength' => '2000',
                                'value' => set_value('artistic_approach', $application['artistic_approach'], FALSE)
                            );
                            echo form_textarea($data);
                            echo form_error('artistic_approach', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    </div>
                    <div class="formRow">
                        <label>Director's Statement:</label>
                         <?php
                            $data = array(
                                'name' => 'director_motivation',
                                'autofocus' => 'true',
                                'required' => 'required',
                                'class' => 'form-control',
                                'maxlength' => '2000',
                                'value' => set_value('director_motivation', $application['director_motivation'], FALSE)
                            );
                            echo form_textarea($data);
                            echo form_error('director_motivation', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    </div>
                    <div class="formRow">
                        <label>PRODUCER’S NOTE:</label>
                         <?php
                            $data = array(
                                'name' => 'representation',
                                'required' => 'required',
                                'autofocus' => 'true',
                                'class' => 'form-control',
                                'maxlength' => '2000',
                                'value' => set_value('representation', $application['representation'], FALSE)
                            );
                            echo form_textarea($data);
                            echo form_error('representation', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    </div>
                   
					
                    <div class="formRow">
                        <label>VISUAL REPRESENTATION (POSTERS AND PICTURES):</label>
                        <input <?php if(empty($application['representation_upload'])){ echo "required"; } ?> type="file" name="file_upload" />
                        <input type="hidden" value="<?php echo $application['representation_upload']; ?>" name="uploadId" />

                    </div>
                    <?php if(!empty($application['representation_upload'])){ ?>
                        <div class="formRow">
                           <a target="_blank" href="<?php echo base_url('photo/image/'.$application['representation_upload']); ?>" > <i style="font-size: 38px;" class="fa fa-file" aria-hidden="true"></i> </a>
                        </div>
                    <?php } ?>
					
                     <div class="formRow">
                         <label>ROUGH FOOTAGE OF THE PROJECTS (MINIMUM 10 MIN):</label>
                         <table id="member">
                            <?php if(!empty($project)){ 
                                $id = 0;
                                foreach($project as $vl){
                                    $id++;
                            ?>
                             <tr class="tbl" id="div<?php echo $id; ?>">
                                 <td><input type="text" placeholder="Link" value="<?php echo $vl['project_link']; ?>" name="project_link[]" class="form-control"></td>
                                 <td><input type="text" placeholder="Password" value="<?php echo $vl['project_password']; ?>" name="project_password[]" class="form-control"></td>
                                 <?php if($id==1){ ?><td><a href="javascript:;" onclick="add()" class="button">+</a></td> <?php }else{ ?>
                                 <td><a style="background: #e62551;" href="javascript:;" onclick="remove(<?php echo $id; ?>)" class="button">X</a></td> <?php } ?>
                             </tr>
                            <?php } }else{ ?>
                                 <tr class="tbl" id="div1">
                                 <td><input type="text" placeholder="Link" name="project_link[]" class="form-control"></td>
                                 <td><input type="text" placeholder="Password" name="project_password[]" class="form-control"></td>
                                 <td><a href="javascript:;" onclick="add()" class="button">+</a></td>
                             </tr>
                            <?php } ?>
                         </table>
                    </div>
                <?php } else if ($grant['description_type'] == 2) {?>

                    <div class="formRow">
                        <label>Logline:</label>
                         <?php
                            $data = array(
                                'name' => 'logline',
                                'required' => 'required',
                                'autofocus' => 'true',
                                'class' => 'form-control',
                                'maxlength' => '200',
                                'value' => set_value('logline', $application['logline'], FALSE)
                            );
                            echo form_textarea($data);
                            echo form_error('logline', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    </div>
                    <div class="formRow">
                        <label>Synopsis:</label>
                         <?php
                            $data = array(
                                'name' => 'synopsis',
                                'required' => 'required',
                                'autofocus' => 'true',
                                'class' => 'form-control',
                                'maxlength' => '2000',
                                'value' => set_value('synopsis', $application['synopsis'], FALSE)
                            );
                            echo form_textarea($data);
                            echo form_error('synopsis', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    </div>
                    <div class="formRow">
                        <label>IMPACT PRODUCER’S NOTE:</label>
                         <?php
                            $data = array(
                                'name' => 'representation',
                                'required' => 'required',
                                'autofocus' => 'true',
                                'class' => 'form-control',
                                'maxlength' => '1000',
                                'value' => set_value('representation', $application['representation'], FALSE)
                            );
                            echo form_textarea($data);
                            echo form_error('representation', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    </div>
                    <div class="formRow">
                        <label>DESCRIBE YOUR VISION FOR THE PERCEIVED IMPACT YOU EXPECT YOUR PROJECT
TO HAVE ON YOUR INTENDED AUDIENCE.:</label>
                         <?php
                            $data = array(
                                'name' => 'characters_description',
                                'required' => 'required',
                                'autofocus' => 'true',
                                'class' => 'form-control',
                                'maxlength' => '1000',
                                'value' => set_value('characters_description', $application['characters_description'], FALSE)
                            );
                            echo form_textarea($data);
                            echo form_error('characters_description', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    </div>
                    <div class="formRow">
                        <label>DESCRIBE HOW YOU INTEND TO EXECUTE YOUR IMPACT STRATEGY AND 
ULTIMATELY HOW YOU WILL MEASURE THE SUCCESS OF YOUR IMPACT 
STRATEGY.:</label>
                         <?php
                            $data = array(
                                'name' => 'artistic_approach',
                                'required' => 'required',
                                'autofocus' => 'true',
                                'class' => 'form-control',
                                'maxlength' => '2000',
                                'value' => set_value('artistic_approach', $application['artistic_approach'], FALSE)
                            );
                            echo form_textarea($data);
                            echo form_error('artistic_approach', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    </div>
                    
                    
                    <div class="formRow">
                         <label>Link to the Rough cut of the film (Minimum 60 Min):</label>
                         <table id="member">
                            <?php if(!empty($project)){ 
                                $id = 0;
                                foreach($project as $vl){
                                    $id++;
                            ?>
                             <tr class="tbl" id="div<?php echo $id; ?>">
                                 <td><input required type="text" placeholder="Link" value="<?php echo $vl['project_link']; ?>" name="project_link[]" class="form-control"></td>
                                 <td><input required type="text" placeholder="Password" value="<?php echo $vl['project_password']; ?>" name="project_password[]" class="form-control"></td>
                                
                             </tr>
                            <?php } }else{ ?>
                                 <tr class="tbl" id="div1">
                                 <td><input required type="text" placeholder="Link" name="project_link[]" class="form-control"></td>
                                 <td><input required type="text" placeholder="Password" name="project_password[]" class="form-control"></td>
                             </tr>
                            <?php } ?>
                         </table>
                    </div>
                    
                    

                    <div class="formRow">
                        <label>UPLOAD VISUAL IMPACT PRODUCTION TOOLKIT:</label>
                        <input <?php if(empty($application['visual_upload'])){ echo "required"; } ?> type="file" name="visual_upload" />
                        <input type="hidden" value="<?php echo $application['visual_upload']; ?>" name="visual_upload_data" />
                    </div>
                    <?php if(!empty($application['visual_upload'])){ ?>
                        <div class="formRow">
                           <a target="_blank" href="<?php echo base_url('photo/image/'.$application['visual_upload']); ?>" > <i style="font-size: 38px;" class="fa fa-file" aria-hidden="true"></i> </a>
                        </div>
                    <?php } ?>


                <?php } else if ($grant['description_type'] == 3) { ?>

                    <div class="formRow">
                        <label>Logline:</label>
                         <?php
                            $data = array(
                                'name' => 'logline',
                                'required' => 'required',
                                'autofocus' => 'true',
                                'class' => 'form-control',
                                'maxlength' => '200',
                                'value' => set_value('logline', $application['logline'], FALSE)
                            );
                            echo form_textarea($data);
                            echo form_error('logline', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    </div>
                    <div class="formRow">
                        <label>Synopsis:</label>
                         <?php
                            $data = array(
                                'name' => 'synopsis',
                                'required' => 'required',
                                'autofocus' => 'true',
                                'class' => 'form-control',
                                'maxlength' => '2000',
                                'value' => set_value('synopsis', $application['synopsis'], FALSE)
                            );
                            echo form_textarea($data);
                            echo form_error('synopsis', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    </div>

                    <div class="formRow">
                        <label>TREATMENT:</label>
                        <input <?php if(empty($application['representation_upload'])){ echo "required"; } ?> type="file" name="file_upload" />
                        <input type="hidden" value="<?php echo $application['representation_upload']; ?>" name="uploadId" />
                    </div>
                    <?php if(!empty($application['representation_upload'])){ ?>
                        <div class="formRow">
                           <a target="_blank" href="<?php echo base_url('photo/image/'.$application['representation_upload']); ?>" > <i style="font-size: 38px;" class="fa fa-file" aria-hidden="true"></i> </a>
                        </div>
                    <?php } ?>

                    <div class="formRow">
                        <label>EDITING NOTE: (Director + Editor if Necessary)</label>
                         <?php
                            $data = array(
                                'name' => 'representation',
                                'required' => 'required',
                                'autofocus' => 'true',
                                'class' => 'form-control',
                                'maxlength' => '1000',
                                'value' => set_value('representation', $application['representation'], FALSE)
                            );
                            echo form_textarea($data);
                            echo form_error('representation', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    </div>

                    <div class="formRow">
                        <label>UPLOAD TECHNICAL FILE:</label>
                        <input <?php if(empty($application['visual_upload'])){ echo "required"; } ?> type="file" name="visual_upload" />
                        <input type="hidden" value="<?php echo $application['visual_upload']; ?>" name="visual_upload_data" />
                    </div>
                    <?php if(!empty($application['visual_upload'])){ ?>
                        <div class="formRow">
                           <a target="_blank" href="<?php echo base_url('photo/image/'.$application['visual_upload']); ?>" > <i style="font-size: 38px;" class="fa fa-file" aria-hidden="true"></i> </a>
                        </div>
                    <?php }  ?>

                    <div class="formRow">
                         <label>LINK TO THE ROUGH CUT OF THE FILM (MINIMUM. 60MIN):</label>
                         <table id="member">
                            <?php if(!empty($project)){ 
                                $id = 0;
                                foreach($project as $vl){
                                    $id++;
                            ?>
                             <tr class="tbl" id="div<?php echo $id; ?>">
                                 <td><input type="text" placeholder="Link" value="<?php echo $vl['project_link']; ?>" name="project_link[]" class="form-control"></td>
                                 <td><input type="text" placeholder="Password" value="<?php echo $vl['project_password']; ?>" name="project_password[]" class="form-control"></td>
                                 <?php if($id==1){ ?><td><a href="javascript:;" onclick="add()" class="button">+</a></td> <?php }else{ ?>
                                 <td><a style="background: #e62551;" href="javascript:;" onclick="remove(<?php echo $id; ?>)" class="button">X</a></td> <?php } ?>
                             </tr>
                            <?php } }else{ ?>
                                 <tr class="tbl" id="div1">
                                 <td><input type="text" placeholder="Link" name="project_link[]" class="form-control"></td>
                                 <td><input type="text" placeholder="Password" name="project_password[]" class="form-control"></td>
                                 <td><a href="javascript:;" onclick="add()" class="button">+</a></td>
                             </tr>
                            <?php } ?>
                         </table>
                    </div>

                    <div class="formRow">
                        <label>UPLOAD ARTISTIC REFERENCES OR MATERIALS TO HELP YOUR CASE. (OPTIONAL) :</label>
                        <input  type="file" name="artistic_upload" />
                        <input type="hidden" value="<?php echo $application['artistic_upload']; ?>" name="artistic_upload_data" />
                    </div>
                    <?php if(!empty($application['artistic_upload'])){ ?>
                        <div class="formRow">
                           <a target="_blank" href="<?php echo base_url('photo/image/'.$application['artistic_upload']); ?>" > <i style="font-size: 38px;" class="fa fa-file" aria-hidden="true"></i> </a>
                        </div>
                    <?php }  ?>

                    <?php } else if ($grant['description_type'] == 4) {?>

                     
                    <div class="formRow">
                        <label>In detail describe the background of your project identifying the issue/problem your organisation seeks to address with your initiative:</label>
                         <?php
                            $data = array(
                                'name' => 'project_describe',
                                'required' => 'required',
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
                                'required' => 'required',
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
                                'required' => 'required',
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
                                'required' => 'required',
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
                                'required' => 'required',
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
                        <table>
							<tr class="tbl" id="div1">
                              <td><input required type="text" required placeholder="Link" name="description_link" class="form-control"></td>
                              <td><input required type="text" required placeholder="Password" name="description_password" class="form-control"></td>
                                 
                             </tr>
						</table>	
                    </div>
                    
                    <div class="formRow">
                        <label>Upload a well-written proposal document:</label>
                        <input <?php if(empty($application['representation_upload'])){ echo "required"; } ?> type="file" name="file_upload" />
                        <input type="hidden" name="uploadId" value="<?php echo $application['representation_upload']; ?>" />
                    </div>
                    
                    <?php if(!empty($application['representation_upload'])){ ?>
                        <div class="formRow">
                           <a target="_blank" href="<?php echo base_url('photo/image/'.$application['representation_upload']); ?>" > <i style="font-size: 38px;" class="fa fa-file" aria-hidden="true"></i> </a>
                        </div>
                    <?php } ?>

                <?php } ?>
                    <div class="footerRow">
                        <a href="<?php echo base_url('project_director/'.$this->uri->segment(2)); ?>" class="button btnBack">Back</a>
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