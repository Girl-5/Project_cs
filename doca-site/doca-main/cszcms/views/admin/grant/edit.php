<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">
                <i><span class="glyphicon glyphicon-user"></span></i> <?php echo  $this->lang->line('grant') ?>
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="h2 sub-header"><?php echo  $this->lang->line('grant_edit') ?>  <a role="button" href="<?php echo  $this->Csz_model->base_link() ?>/admin/grant/new" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus"></span> <?php echo  $this->lang->line('grant_addnew') ?></a></div>
        <?php echo form_open_multipart($this->Csz_model->base_link(). '/admin/grant/edited/'.$this->uri->segment(4)); ?>
        <div class="control-group">
            <?php echo form_error('title', '<div class="alert alert-danger text-center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
            <label class="control-label" for="name">Grant Name*</label>
            <?php
            $data = array(
                'name' => 'title',
                'id' => 'title',
                'required' => 'required',
                'autofocus' => 'true',
                'class' => 'form-control',
                'maxlength' => '255',
                'value' => set_value('title', $grant->title, FALSE)
            );
            echo form_input($data);
            ?>			
        </div> <!-- /control-group -->
        
        <div class="control-group">
            <label class="control-label" for="description">Grant Type </label>
            <?php
             $data = array(
                'name' => 'grant_type',
                'id' => 'grant_type',
                'required' => 'required',
                'autofocus' => 'true',
                'class' => 'form-control',
                'value' => set_value('grant_type', $grant->grant_type, FALSE)
            );
            $option = array('1'=>'Production Grant','2'=>'Development Grant','3'=>'Mentorship Grant');
            echo form_dropdown('grant_type',$option,$grant->grant_type,$data);
            echo form_error('grant_type', '<div class="alert alert-danger text-center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
        </div> <!-- /control-group -->
        <div class="control-group">
            <label class="control-label" for="description">Project Summary Form </label>
            <select class="form-control" id="exampleFormControlSelect1" name="project_summary_form">

            <?php foreach($form_main as $form): ?>
                <option <?php if($grant->project_summary_form_id == $form['form_main_id']){ echo 'selected'; } ?> value="<?= $form['form_main_id'] ?>"><?= strtoupper(str_replace('_', ' ', $form['form_name']))  ?></option>
            <?php endforeach ?>
            </select>

            <?php echo form_error('grant_type', '<div class="alert alert-danger text-center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
        </div> <!-- /control-group -->
        <div class="control-group">
            <label class="control-label" for="description">Project Description Form </label>
            <select class="form-control" id="exampleFormControlSelect1" name="project_description_form">

            <?php foreach($form_main as $form): ?>
                <option <?php if($grant->project_description_form_id == $form['form_main_id']){ echo 'selected'; } ?> value="<?= $form['form_main_id'] ?>"><?= strtoupper(str_replace('_', ' ', $form['form_name']))  ?></option>
            <?php endforeach ?>
            </select>
            <?php echo form_error('grant_type', '<div class="alert alert-danger text-center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
        </div> <!-- /control-group -->

        <div class="control-group">
            <label class="control-label" for="description">Contract Type </label>
            <?php
             $data = array(
                'name' => 'contract',
                'id' => 'contract',
                'required' => 'required',
                'autofocus' => 'true',
                'class' => 'form-control',
                'value' => set_value('contract', $grant->contract, FALSE)
            );
            $option = array('1'=>'FG- Impact','2'=>'DEV & PRD','3'=>'FG-Postproduction');
            echo form_dropdown('contract',$option,$grant->contract,$data);
            echo form_error('contract', '<div class="alert alert-danger text-center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
        </div> <!-- /control-group -->
        
        <div class="control-group">
            <label class="control-label" for="description">Project Description Type </label>
            <?php
             $data = array(
                'name' => 'description_type',
                'id' => 'description_type',
                'required' => 'required',
                'autofocus' => 'true',
                'class' => 'form-control',
                'value' => set_value('description_type', '', FALSE)
            );
            $option = array('1'=>'DEVELOPMENT & PRODUCTION','2'=>'FINISHING GRANT: IMPACT','3'=>'FINISHING GRANT: POSTPRODUCTION', '4'=>'DOC-ORGANISATIONS');
            echo form_dropdown('description_type',$option,$grant->description_type,$data);
            echo form_error('description_type', '<div class="alert alert-danger text-center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
        </div> <!-- /control-group -->
        
         <div class="control-group">
            <label class="control-label" for="startDate">Start Date </label>
            <input type="date" value="<?php echo $grant->startDate; ?>" class="form-control" name="startDate">
        </div>  
        
        <div class="control-group">
            <label class="control-label" for="startDate">End Date </label>
            <input type="date" value="<?php echo $grant->endDate; ?>" class="form-control" name="endDate">
        </div>  
       
        <div class="control-group">
            
            <label class="control-label" for="description"><?php echo $this->lang->line('description'); ?></label>
            <?php
             $data = array(
                'name' => 'description',
                'id' => 'description',
                'required' => 'required',
                'autofocus' => 'true',
                'class' => 'form-control',
                'value' => set_value('description', $grant->description, FALSE)
            );
            echo form_textarea($data);
            echo form_error('description', '<div class="alert alert-danger text-center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
        </div> <!-- /control-group -->
        
                <div class="control-group">
            <label class="control-label" for="description">Eligibility </label>
            <?php
             $data = array(
                'name' => 'eligibility',
                'id' => 'eligibility',
                'required' => 'required',
                'autofocus' => 'true',
                'class' => 'form-control',
                'value' => set_value('eligibility', $grant->eligibility, FALSE)
            );
            echo form_textarea($data);
            echo form_error('eligibility', '<div class="alert alert-danger text-center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
        </div> <!-- /control-group -->
      
        <div class="control-group">
            <label class="control-label" for="ans"><?php echo "Image"; ?>*</label>
        <div class="controls">
                <div><img class="img-thumbnail img-responsive" src="<?php
                              if ($grant->image != "" && $grant->image != NULL) {
                                  echo base_url() . 'photo/image/' . $grant->image;
                              }
                              ?>" <?php
                    if ($grant->image == "" || $grant->image == NULL) {
                        echo "style='display:none;'";
                    }
                    ?> width="50%"></div>
                    <?php if ($grant->image != "" && $grant->image != NULL) { ?><label for="del_file"><input type="checkbox" name="del_file" id="del_file" value="<?php echo $grant->image?>"> <span class="remark">Delete File</span></label><?php } ?>
                    <?php
                    $data = array(
                        'name' => 'file_upload',
                        'id' => 'file_upload',
                        'class' => 'span5'
                    );
                    echo form_upload($data);
                    ?>
                <input type="hidden" id="image" name="image" value="<?php echo $grant->image?>"/>
            </div> <!-- /controls -->
           <!--<div class="control-group">-->
           <!-- <label class="control-label" for="ans"><?php echo "image"; ?>*</label>-->
</div> <!-- /control-group --> 
        
        <div class="control-group">										
            <label class="form-control-static" for="<?php echo $grant->active; ?>">
            <?php
            if($grant->active ==1){
                $checked = 'checked';
            }else{
                $checked = '';
            }
            $data = array(
                'name' => 'active',
                'id' => 'active',
                'value' => '1',
                'checked' => $checked
            );
           
            echo form_checkbox($data);
            ?> <?php echo $this->lang->line('user_new_active'); ?></label>	
        </div> <!-- /control-group -->
        <div class="form-actions">
            <?php
            $data = array(
                'id' => 'submit',
                'class' => 'btn btn-lg btn-primary',
                'value' => $this->lang->line('btn_save'),
            );
            echo form_submit($data);
            ?> 
            <a class="btn btn-lg" href="<?php echo $this->csz_referrer->getIndex(); ?>"><?php echo $this->lang->line('btn_cancel'); ?></a>
        </div> <!-- /form-actions -->
        <?php echo form_close(); ?>
        <!-- /widget-content --> 
    </div>
</div>
