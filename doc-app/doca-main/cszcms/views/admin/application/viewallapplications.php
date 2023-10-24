<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">
                <i><span class="glyphicon glyphicon-user"></span></i> <?php echo  $this->lang->line('application') ?>
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="h2 sub-header"><?php 
            if($this->uri->segment(4) == "submitted" ){    ///===  SUBMITTED
            $title = ' Submitted Applications';
            }
            if($this->uri->segment(4) == "inprogress" ){    ///===  IN PROGRESSS
                $title = ' Incomplete Applications';
            }
            if($this->uri->segment(4) == "accepted" ){    ///=== ACCEPTED  
                $title = ' Shortlisted Applications';
            }
            if($this->uri->segment(4) == "rejected" ){    ///==== REJECTED 
                $title = ' Unsuccessful Applications';  
            }
            if($this->uri->segment(4) == ""){
                
                $title = ' All Applications';
            }
            echo $title;
        
        ?></div>  
        
        <div>
            <?php if($grants){ 
                foreach($grants as $grantvl){ ?>
                    <a class="btn btn-default btn-sm" <?php if($this->uri->segment(5) == $grantvl['id']){ ?> style="background:#3c8dbc; color: white;" <?php } ?> href='<?= $this->Csz_model->base_link().'/admin/application/viewallapplicationsbygrant/'.$this->uri->segment(4).'/'.$grantvl['id'] ?>'><?= $grantvl['title']; ?></a>&nbsp;
                <?php }
                
            } ?>
        </div>
        <br><br>
        <div class="box box-body table-responsive no-padding">
            <table class="table table-bordered table-hover table-striped" id="dynamic_table_1">
                <thead>
                    <tr>
                        <th width="10%" class="text-center"><?php echo "No"; ?></th>
                        <th width="10%" class="text-center"><?php echo $this->lang->line('user_status'); ?></th>
                        <th width="20%" class="text-center"> Grant Name</th>
                        <th width="30%" class="text-center">Applicant Name</th>
                        <th width="30%" class="text-center">Project title</th>
                        <th width="30%" class="text-center">Country</th>
                        <th width="30%" class="text-center">Date-time</th>
                        <!--<th width="30%" class="text-center">Action</th>-->
                        <th width="25%"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($application === FALSE) { ?>
                        <tr>
                            <td colspan="5" class="text-center"><span class="h6 error"><?php echo  $this->lang->line('data_notfound') ?></span></td>
                        </tr>                           
                    <?php } else { ?>
                        <?php
                        $id=0;
                        foreach ($application as $u) {
                            
                            if(isset($country[$country_aplcnt[$u['user_id']]])){
                                $countryy =  $country[$country_aplcnt[$u['user_id']]];
                		    }else{ 
                		        $countryy = ""; 
                		    }
                		    
                            $id=++$id;
                            if($u['status']==2){
                                $inactive = ' style="vertical-align: middle;color:red;text-decoration:line-through;"';
                                $status = '<span style="color:red;">Rejected</span>';
                            }else if($u['status']==1){
                                $inactive = '';
                                $status = '<span class="text-info">Shortlisted</span>';
                            }else if($u['complete']==0){
                                $inactive = '';
                                $status = '<span style="color:blue;">Incomplete</span>';
                            }else if($u['status']==3){
                                $inactive = '';
                                $status = '<span style="color:orange;">Pre-selected</span>';
                            }
                            else if($u['status']==4){
                                $inactive = '';
                                $status = '<span style="color:green;">Awarded</span>';
                            }
                            else{
                                $inactive = '';
                                $status = '<span style="color:orange;">Submitted</span>';
                            }
                            
                            if($u['grant_id'] == "23"){
                                if($u['project_category']==1){ 
                                    $name1 = "Workshop/Residencies";
                                }else if($u['project_category']==2){ 
                                    $name1 = "Labs";
                                }else if($u['project_category']==3){ 
                                    $name1 = "Screenings";
                                }else if($u['project_category']==4){
                                    $name1 = "Festivals";
                                }else{ 
                                    $name1 = "";
                                }
                            }else{
                                $name1 = $u['name'];
                            }
                           
                            echo '<tr>';
                            echo '<td class="text-center" style="vertical-align: middle;">' . $id . '</td>';
                            echo '<td class="text-center" style="vertical-align: middle;">' . $status . '</td>';
                            echo '<td'.$inactive.' class="text-center" style="vertical-align: middle;">' . $u['grant_title']. '</td>';
                            echo '<td'.$inactive.' class="text-center" style="vertical-align: middle;">' . $u['applicant_name'] . '</td>';
                           // echo '<td'.$inactive.' class="text-center" style="vertical-align: middle;">' . $phone[$u['user_id']] . '</td>';
                           
                            echo '<td'.$inactive.' class="text-center" style="vertical-align: middle;">' . $name1 . '</td>';
                            echo '<td'.$inactive.' class="text-center" style="vertical-align: middle;">' . $country[$u['nationality']] . '</td>';
                           
                            echo '<td'.$inactive.' class="text-center" style="vertical-align: middle;">' . $u['addon'] . '</td>';
                            echo '<td class="text-center" style="vertical-align: middle;"><a href="'.$this->Csz_model->base_link().'/admin/application/viewoneapplication/'. $u['id'].'/for_all" class="btn btn-default btn-sm" role="button"><i class="glyphicon glyphicon-eye-open"></i> View</a></td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php // echo $this->pagination->create_links(); ?> <b><?php echo $this->lang->line('total').' '.$total_row.' '.$this->lang->line('records');?></b>
        <!-- /widget-content --> 
        <br><br>
        <span class="warning">
            <i class="glyphicon glyphicon-lock"></i> <?php echo  $this->lang->line('default_data_remark') ?>
        </span>
    </div>
</div>
