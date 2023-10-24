<section class="fullContainer centerBox projectDesc"> <!-- full width -->
    <div class="container"> <!-- container width -->
        <div class="wrapper"> <!-- full width wrapper -->
            <div class="formBox">
                <div class="formWrapper">
                    <?php echo form_open_multipart(base_url(). 'save_edited_application/'.$this->uri->segment(2)); ?>
                    
                    <h2 style="font-size:16px !important;">Grant Name: <?= $grant[0]['title'] ?></h2>
                    <h2 style="font-size:16px !important;">Application Name: <?= $application['name'] ?></h2>
                   
                    <h2>Project Description:</h2>
                    <?php if ($grant[0]['description_type'] == 1) { ?>
                   
                    <div class="formRow">
                        <label>Director's Statement:</label>
                         <?php
                            $data = array(
                                'name' => 'letter_of_motivation',
                                'autofocus' => 'true',
                                'required' => 'required',
                                'class' => 'form-control',
                                'maxlength' => '2000',
                                'value' => set_value('letter_of_motivation', $application['letter_of_motivation'], FALSE)
                            );
                            if(!empty($application['letter_of_motivation'])){
                                $data['readonly'] = 'readonly';
                            }
                            echo form_textarea($data);
                            echo form_error('letter_of_motivation', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    </div>
                    <div class="formRow">
                        <label>PRODUCER’S NOTE:</label>
                         <?php
                            $data = array(
                                'name' => 'representation',
                                'autofocus' => 'true',
                                'class' => 'form-control',
                                'maxlength' => '2000',
                                'value' => set_value('representation', $application['representation'], FALSE)
                            );
                            if($grant[0]['id'] != 17 ){
                                 $data['required'] = 'required';
                            }
                            if(!empty($application['representation'])){
                                $data['readonly'] = 'readonly';
                            }
                            echo form_textarea($data);
                            echo form_error('representation', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    </div>
                   <div class="formRow">
                        <label>KINDLY PROVIDE ANY RELEVANT STATUS UPDATES ON YOUR PROJECT. (IF
NECESSARY)</label>
                         <?php
                            $data = array(
                                'name' => 'rel_status_update',
                                'autofocus' => 'true',
                                'required' => 'required',
                                'class' => 'form-control',
                                'maxlength' => '2000',
                                'value' => set_value('rel_status_update', $application['rel_status_update'], FALSE)
                            );
                            if(!empty($application['rel_status_update'])){
                                $data['readonly'] = 'readonly';
                            }
                            echo form_textarea($data);
                            echo form_error('rel_status_update', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    </div>

                    

                    <h2>Contract:</h2>
                    <div class="formRow">
                        <table>
                        <?php if(!empty($contract)){   //contract_save
                                $pt = 1;
                                foreach($contract as $kk => $vl){ if($pt ==1){ ?>
                                    <tr>
                                        <td><?php echo $vl['title']; ?></td>
                                        <td style="width: 24%;">
                                            <label><input type="hidden" name="contract_id[]"  value="<?php echo $vl['id']; ?>">
                                            </label>
                                            <label></label>
                                            <input type="hidden" name="answer<?php echo $vl['id']; ?>" value="1">
                                        </td>
                                        <td>
                                        <?php if($vl['upload_file']==1){ ?>
                                        <input style="width: 100%; <?php if($vl['hide_box'] == 0){ ?> display:none;<?php } ?>" <?php if($vl['hide_box'] == 1 && $vl['upload_optional'] == 0 && empty($contract_save[$kk]['upload_file'])){ echo "required"; } ?> id="file<?php echo $vl['id']; ?>" type="file" name="file<?php echo $vl['id']; ?>"><?php } ?>
                                        </td>
                                        <td>
                                        <?php if(!empty($contract_save[$kk]['upload_file'])){ ?>
                                            
                                            <input type="hidden" value="<?= $contract_save[$kk]['upload_file'] ?>" name="contractfile11">
                                            <a target="_blank" href="<?php echo base_url('photo/image/'.$contract_save[$kk]['upload_file']); ?>" >
                                             <i style="font-size: 38px;" class="fa fa-file" aria-hidden="true"></i> </a>
                                        <?php } ?>
                                        </td>
                                    </tr>
                       <?php }  $pt++; } } ?>
                        </table>
                    </div>
                     
                <?php } else if ($grant[0]['description_type'] == 2) {?>

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
                            if(!empty($application['representation'])){
                                $data['readonly'] = 'readonly';
                            }
                            echo form_textarea($data);
                            echo form_error('representation', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    </div>
                     <div class="formRow">
                        <label>KINDLY PROVIDE ANY RELEVANT STATUS UPDATES ON YOUR PROJECT. (IF
NECESSARY)</label>
                         <?php
                            $data = array(
                                'name' => 'rel_status_update',
                                'autofocus' => 'true',
                                'required' => 'required',
                                'class' => 'form-control',
                                'maxlength' => '2000',
                                'value' => set_value('rel_status_update', $application['rel_status_update'], FALSE)
                            );
                            if(!empty($application['rel_status_update'])){
                                $data['readonly'] = 'readonly';
                            }
                            echo form_textarea($data);
                            echo form_error('rel_status_update', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    </div>

                    

                <?php } else if ($grant[0]['description_type'] == 3) { ?>

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
                                if(!empty($application['representation'])){
                                    $data['readonly'] = 'readonly';
                                }
                                echo form_textarea($data);
                                echo form_error('representation', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                            ?>
                        </div>
                        
                         <div class="formRow">
                        <label>KINDLY PROVIDE ANY RELEVANT STATUS UPDATES ON YOUR PROJECT. (IF
NECESSARY)</label>
                         <?php
                            $data = array(
                                'name' => 'rel_status_update',
                                'autofocus' => 'true',
                                'required' => 'required',
                                'class' => 'form-control',
                                'maxlength' => '2000',
                                'value' => set_value('rel_status_update', $application['rel_status_update'], FALSE)
                            );
                            if(!empty($application['rel_status_update'])){
                                $data['readonly'] = 'readonly';
                            }
                            echo form_textarea($data);
                            echo form_error('rel_status_update', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    </div>

                 <?php } ?> 
                    
                    
                                            
                    <div class="footerRow">
                        <button type="submit" class="button">Update</a>
                    </div>
                     <?php echo form_close(); ?>
    
                </div><!-- form wrapper -->
            </div><!-- form box -->
        </div>
    </div>
</section><!-- project Description -->


<script>
    $(".hideShow").on("click", function(){
        var data = $(this).attr('data');
        var id = $(this).val();
        if(id==1){
            $("#file"+data).slideDown();
            $("#file"+data).attr('required','required');
        }else{
            $("#file"+data).slideUp();
            $("#file"+data).removeAttr('required');

        }
    });
</script>
