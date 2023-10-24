<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">
                <i><span class="glyphicon glyphicon-user"></span></i> <?php echo  $this->lang->line('applicant') ?>
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12 col-md-12">      
        
        <div class="h2 sub-header"><?php 
            if($this->uri->segment(4) == "completed_profile" ){    ///===  COMPLETED PROFILES
            $title = ' Completed Profiles';
            }
            if($this->uri->segment(4) == "activated_profiles" ){    ///===  ACTIVATED PROFILES
                $title = ' Active Profiles';
            }
            if($this->uri->segment(4) == "inactive_profile" ){    ///=== IN-ACTIVE PROFILES
                $title = ' In-Active Profiles';
            }
            if($this->uri->segment(4) == ""){
                $title = ' All Applicants';
            }
            echo $title;
        ?></div>  
        
        <div>
           <a class="btn btn-default btn-sm" <?php if($this->uri->segment(4) == "completed_profile"){ ?> style="background:#3c8dbc; color: white;" <?php } ?>
           href='<?= $this->Csz_model->base_link().'/admin/applicant/applicant_profile/completed_profile'; ?>'>Completed Profiles</a>&nbsp;
           <a class="btn btn-default btn-sm" <?php if($this->uri->segment(4) == "activated_profiles"){ ?> style="background:#3c8dbc; color: white;" <?php } ?> 
           href='<?= $this->Csz_model->base_link().'/admin/applicant/applicant_profile/activated_profiles'; ?>'>Active Profiles</a>&nbsp;
           <a class="btn btn-default btn-sm" <?php if($this->uri->segment(4) == "inactive_profile"){ ?> style="background:#3c8dbc; color: white;" <?php } ?> 
           href='<?= $this->Csz_model->base_link().'/admin/applicant/applicant_profile/inactive_profile'; ?>'>In-Active Profiles</a>&nbsp;
        </div>
        <br><br>
        <div class="box box-body table-responsive no-padding">
            <table class="table table-bordered table-hover table-striped" id="dynamic_table">
                <thead>
                    <tr>
                        <th width="10%" class="text-center"><?php echo "No"; ?></th>
                        <th width="10%" class="text-center"><?php echo $this->lang->line('user_status'); ?></th>
                        <th width="20%" class="text-center"> Name</th>
                        <th width="30%" class="text-center">Phone</th>
                        <th width="30%" class="text-center">Email</th>
                        <th width="30%" class="text-center">Nationality</th>
                        <th width="30%" class="text-center">Country of Residence</th>
                        <th width="30%" class="text-center">Grants Applied</th>
                        <th width="30%" class="text-center">Registered</th>
                        <th width="25%" class="not-export-col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($applicant === FALSE) { ?>
                        <tr>
                            <td colspan="5" class="text-center"><span class="h6 error"><?php echo  $this->lang->line('data_notfound') ?></span></td>
                        </tr>                           
                    <?php } else { ?>
                        <?php
                        $id=0;
                        foreach ($applicant as $u) {
                            $id=++$id;
                            if(!$u['status']){
                                $inactive = ' style="vertical-align: middle;color:red;text-decoration:line-through;"';
                                $status = '<span style="color:red;">Deactivated</span>';
                            }else{
                                $inactive = '';
                                $status = '<span style="color:green;">Activated</span>';
                            }
                            
                            if(isset($country[$u['nationality']])){
                               $nationality  =  $country[$u['nationality']];
                		    }else{ $nationality = ""; }
                		    
                		    if(isset($country[$u['country_of_birth']])){
                               $country_of_birth  =  $country[$u['country_of_birth']];
                		    }else{ $country_of_birth = ""; }
                		    
                		    if($u['grant_name']){
                		        $grant_name = $u['grant_name'];
                		    }else{
                		        $grant_name = "NULL";
                		    }
                           
                            echo '<tr>';
                            echo '<td class="text-center" style="vertical-align: middle;">' . $id . '</td>';
                            echo '<td class="text-center" style="vertical-align: middle;">' . $status . '</td>';
                            echo '<td'.$inactive.' class="text-center" style="vertical-align: middle;">' . $u['name']. '</td>';
                            echo '<td'.$inactive.' class="text-center" style="vertical-align: middle;">' . $u['phone'] . '</td>';
                            echo '<td'.$inactive.' class="text-center" style="vertical-align: middle;">' . $u['email'] . '</td>';
                            
                            echo '<td'.$inactive.' class="text-center" style="vertical-align: middle;">' . $nationality . '</td>';
                            echo '<td'.$inactive.' class="text-center" style="vertical-align: middle;">' . $country_of_birth . '</td>';
                            
                            echo '<td'.$inactive.' class="text-center" style="vertical-align: middle;">' . $grant_name . '</td>';
                             
                            echo '<td'.$inactive.' class="text-center" style="vertical-align: middle;">' . $u['addon'] . '</td>';
                              echo '<td class="text-center" style="vertical-align: middle;"><a target="_blank" href="'.$this->Csz_model->base_link().'/userView/' . $u['id'] . '" class="btn btn-default btn-sm" role="button"><i class="glyphicon glyphicon-eye-open"></i> View</a> </td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php echo $this->pagination->create_links(); ?> <b><?php echo $this->lang->line('total').' '.$total_row.' '.$this->lang->line('records');?></b>
        <!-- /widget-content --> 
        <br><br>
        <span class="warning">
            <i class="glyphicon glyphicon-lock"></i> <?php echo  $this->lang->line('default_data_remark') ?>
        </span>
    </div>
</div>
<!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>-->
<!--        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>-->
<!--        <script src="js/scripts.js"></script>-->
<!--        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>-->
<!--        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>-->
<!--        <script src="assets/demo/datatables-demo.js"></script>-->
