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
        <div class="h2 sub-header"><?php echo  $this->lang->line('grant_addnew') ?>  <a role="button" href="<?php echo  $this->Csz_model->base_link() ?>/admin/grant/new" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus"></span> <?php echo  $this->lang->line('grant_addnew') ?></a></div>
        <?php echo form_open_multipart($this->Csz_model->base_link(). '/admin/grant/new/add'); ?>
        <div class="control-group">
            <?php echo form_error('title', '<div class="alert alert-danger text-center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
            <label class="control-label" for="name"><?php echo "Grant Name"; ?>*</label>
            <?php
            $data = array(
                'name' => 'title',
                'id' => 'title',
                'required' => 'required',
                'autofocus' => 'true',
                'class' => 'form-control',
                'maxlength' => '255',
                'value' => set_value('title', '', FALSE)
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
                'value' => set_value('grant_type', '', FALSE)
            );
            $option = array('1'=>'Production Grant','2'=>'Development Grant','3'=>'Mentorship Grant');
            echo form_dropdown('grant_type',$option,'',$data);
            echo form_error('grant_type', '<div class="alert alert-danger text-center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
        </div> <!-- /control-group -->
        
        <div class="control-group">
            
            <label class="control-label" for="description">Grant Description </label>
            <?php
             $data = array(
                'name' => 'description',
                'id' => 'description',
                'required' => 'required',
                'autofocus' => 'true',
                'class' => 'form-control',
                'value' => set_value('description', '', FALSE)
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
                'value' => set_value('eligibility', '', FALSE)
            );
            echo form_textarea($data);
            echo form_error('eligibility', '<div class="alert alert-danger text-center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
        </div> <!-- /control-group -->
        
         <div class="control-group">
            <label class="control-label" for="ans"><?php echo "Image"; ?>*</label>
            <div class="controls">
                <?php
                $data = array(
                    'name' => 'file_upload',
                    'id' => 'file_upload',
                    'class' => 'span5'
                );
                echo form_upload($data); ?>
            </div> <!-- /controls -->
            </div> <!-- /control-group -->
        <div class="control-group">										
            <label class="form-control-static" for="active">
            <?php
            $data = array(
                'name' => 'active',
                'id' => 'active',
                'value' => '1'
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
