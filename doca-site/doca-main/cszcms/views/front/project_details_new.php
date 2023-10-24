<section class="fullContainer centerBox projectDetail"> <!-- full width -->
    <div class="container"> <!-- container width -->
        <div class="wrapper"> <!-- full width wrapper -->
            <div class="formBox">
                <div class="formWrapper">
                    <?php echo form_open_multipart(base_url(). 'saveProject/'.$this->uri->segment(2).'/'.$form['form_main_id'].'/'.$application['id']); ?>
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
                    <h2><?= strtoupper(str_replace('_', ' ', $form['form_name'])) ?></h2>
                        <?php foreach ($form_fields as $field): ?>
                        <div class="formRow">
                            <label><?= $field['field_label'] ?></label>
                            <?php

                            $data = array(
                                'name' => $field['field_name'],
                                'autocomplete'  => 'off',
                                'autofocus' => 'true',
                                'required' => 'required',
                                'placeholder' => $field['field_placeholder'],
                                'class' => 'form-control',
                                'type' => $field['field_type'] == 'number' ? 'number' : $field['field_type'],
                                'maxlength' => $field['max_length'],
                                'value' => set_value($field['field_name'], $field['form_field_value'], FALSE)
                            );
                            if($field['field_required'] == 1){
                                $require_data = array(
                                    'required' => 'required',
                                );
                                array_merge($data,$require_data );
                            }
                            if($field['field_type'] == 'selectbox'){
                                $array = array();
                                foreach (explode(', ', $field['sel_option_val']) as $item) {
                                    $parts = explode('=>', $item);
                                    $array = array_merge($array, array($parts[0] => $parts[1]));
                                }
                                $opts = $array;
                                echo form_dropdown($field['field_name'],$opts,$field['form_field_value'],$data);
                            }else if($field['field_type'] == 'textarea'){
                                echo form_textarea($data,$field['form_field_value']);
                            }else if($field['field_type'] == 'file'){
                            echo form_upload($data,$field['form_field_value']);
                            if(!is_null($field['form_field_value'])){ ?>

                            <small> <a target="_blank" href="<?php echo base_url('photo/image/'.$field['form_field_value']); ?>" > <i style="" class="fa fa-file" aria-hidden="true"></i> Current File </a>

                                <?php }
                                } else {
                                    echo form_input($data);
                                }
                                echo form_error($field['field_name'], '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>');
                                endforeach;
                                ?>
                        </div>

                    <div class="footerRow">
                        <button type="submit" class="button">Save & Continue</button>
                    </div>
                </div><!-- form wrapper -->
            </div><!-- form box -->
        </div>
    </div>
</section><!-- project details -->