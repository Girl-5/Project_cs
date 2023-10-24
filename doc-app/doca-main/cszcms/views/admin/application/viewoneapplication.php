<!-- Page Heading -->
<script>
// the selector will match all input controls of type :radio
// and attach a click event handler 
// $("input:radio").on('click', function() {
//   // in the handler, 'this' refers to the box clicked on
//   var $box = $(this);
//   if ($box.is(":checked")) {
//     // the name of the box is retrieved using the .attr() method
//     // as it is assumed and expected to be immutable
//     var group = "input:radio[name='" + $box.attr("name") + "']";
//     // the checked state of the group/box on the other hand will change
//     // and the current value is retrieved using .prop() method
//     $(group).prop("checked", false);
//     $box.prop("checked", true);
//   } else {
//     $box.prop("checked", false);
//   }
// });

</script>
<style>
    .control-group{
            margin-top: 10px;
    }
    p{
    	text-align: justify;
    }
    .reviewclass{
         margin-top: 20px;
    }
    a{
        word-break: break-all;
    }
    .plss{
      word-wrap: break-word;
    }
</style>
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
<div class="row" style="display: flex;">
    
    <div class="col-lg-6 col-md-6">
    <div class="container">
<div id="google_translate_element"></div>
</div>


<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        
        <div class="h2 sub-header"><center>View Application Info  </center></div>
        
        <?php if($previous_id){ ?>
         <a style="float: left;margin-bottom:10px;" href="<?= $this->Csz_model->base_link().'/admin/application/viewoneapplication/'.$previous_id ?>" class="btn btn-info btn-sm" role="button"><i class="glyphicon glyphicon-chevron-left"></i>Previous</a>
        <?php }else{ echo "<br><br>";} ?>
        
        <?php if ($application === FALSE) { ?>
            <center><h2>No Record Found for this Application!</h2></center>
         <?php }else{          
            $id=0;   ?>  
            <!--========= APPLICANT DATA WILL COME HERE =================================-->
             <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <!--<h2 class="box-title"><b>APPLICANT DATA</b></h2>-->
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            
                            <table class="table table-bordered table-hover table-striped" id="dynamic_table_3">
                                <thead>
                                    <tr>
                                        <th width="30%" class="text-center">Fields</th>
                                        <th width="50%" class="text-center">Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Type of Grant</td>
                                        <td><p><?= $application['title']; ?></p></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Applicant Name</td>
                                        <td><p><?= $application['applicant_name']; ?></p></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>DOB</td>
                                        <td><p><?= $application['dob']; ?></p></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Nationality</td>
                                        <td><p>
                                            <?php 
                                		     if(isset($country[$application['nationality']])){
                                                echo $country[$application['nationality']];
                                		     }else{ echo ""; } ?>
                                        </p></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>City</td>
                                        <td><p><?= $application['city']; ?></p></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Country of Residence</td>
                                        <td><p>
                                            <?php
                                		     if(isset($country[$application['country_of_birth']])){
                                                echo $country[$application['country_of_birth']];
                                		     }else{ echo ""; } ?>
                                        </p></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>View CV</td>
                                        <td>
                                            <?php  if ($application['uploadCv'] != "" &&  $application['uploadCv'] != NULL) { ?>
                                		        <p><a href=" <?= base_url().'photo/image/'.$application['uploadCv']; ?>"  target="_blank">view cv</a></p>
                                			<?php } ?>
                                        </td>
                                    </tr>
                                  
                                    <tr>
                                        <td>Previous Work link</td>
                                        <td>
                                            <?php if(strpos($application['work_link'], 'http') !== false ||  strpos($application['work_link'], 'https') !== false){ ?>
                                			<p> <a href="<?= $application['work_link']; ?>" target="_blank"><?= $application['work_link']; ?></a></p>
                                			<?php }else{ echo $application['work_link']; } ?>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Previous Password link</td>
                                        <td><p><?= $application['password_link']; ?></p></td>
                                    </tr>
                                    
                                    <!--========= PROJECT DETAILS DATA WILL COME HERE =================================-->
                                    <tr>
                                        <td><b>PROJECT DETAILS</b></td>
                                        <td></td>
                                    </tr>
                                    <?php foreach ($project_details_form_fields as $project_details_form_field): ?>
                                    <tr>
                                        <td><?= $project_details_form_field['field_label'] ?></td>
                                        <td><p><?= $project_details_form_field['form_field_value'] ?></p></td>
                                    </tr>
                                    <?php endforeach; ?>

                                    
                                     <!--=============ORGANISATION SECTION HERE =============================-->
                                    
                                   
                                    
                                        <!-- <tr>-->
                                        <!--    <td>PRODUCER</td>-->
                                        <!--    <td><p><?= $application['producer']; ?></p></td>-->
                                        <!--</tr> -->
                                        <!--<tr>-->
                                        <!--    <td>FILM MAKER</td>-->
                                        <!--    <td><p><?= $application['filmmanker']; ?></p></td>-->
                                        <!--</tr>-->
                                        
                                        <!--<tr>-->
                                        <!--    <td>PROJECT CO-ORDINATOR</td>-->
                                        <!--    <td><p><?= $application['project_co_ordinator']; ?></p></td>-->
                                        <!--</tr>-->
                                        
                                        <!-- <tr>-->
                                        <!--    <td>PROJECT ROLE</td>-->
                                        <!--    <td><p><?= $application['project_role2']; ?></p></td>-->
                                        <!--</tr>-->
                                        <!--@@@@@@@@@@@@@@@@@@-->
                                    
                                    <!--=================================================================================-->
                                    
                                    
                                    <!--=========START PROJECT DESCRIPTION DATA WILL COME HERE =================================-->
                                    <!--<tr>-->
                                    <!--    <td><b>PROJECT DESCRIPTION</b></td>-->
                                    <!--    <td></td>-->
                                    <!--</tr>-->
                                    
                                    
                                    <!--==========description_type == 1  =================================================-->
                                    
                                    <!--==========description_type == 1 end here ==========================================-->
                                    
                                    
                                    
                                    <!--==========description_type == 2 start  =================================================-->
                                   
                                    <!--==========description_type == 2 end here=================================================-->
                                    
                                    <!--==========description_type == 3 start  =================================================-->
                                  
                                    <!--==========description_type == 3 end here=================================================-->
                                    
                                    
                                    
                                    <!--==============================END PROJECT DETAILS SECTION===================================================-->
                                    
                                    
                                    <!--==============START TEAM DETAILS SECTION===================================================-->
                                    
                                        <tr>
                                            <td><b>TEAM DETAILS</b></td>
                                            <td></td>
                                        </tr>
                                        
                                        
                                        <?php if($team_data){ 
                                            $cntt = 1;
                                            foreach($team_data as $teamdata){ ?>
                                            
                                                <tr>
                                                    <td><?php echo "Assembled Professionals:-".$cntt ?></td>
                                                    <td></td>
                                                </tr>
                                                
                                                <tr>
                                                    <td>Role</td>
                                                    <td><p><?= $teamdata['project_role']; ?></p></td>
                                                </tr>
                                                <tr>
                                                    <td>Name</td>
                                                    <td><p><?= $teamdata['name']; ?></p></td>
                                                </tr>
                                                <tr>
                                                    <td>Phone</td>
                                                    <td><p><?= $teamdata['phone']; ?></p></td>
                                                </tr>
                                                
                                                <tr>
                                                   <td>Nationality</td>
                                        <td><p>
                                            <?php
                                		     if(isset($country[$teamdata['country']])){
                                                echo $country[$teamdata['country']];
                                		     }else{ echo ""; } ?>
                                        </p></td>
                                                </tr>
                                                
                                                
                                                
                                                <tr>
                                                    <td>Email</td>
                                                    <td><p><?= $teamdata['email']; ?></p></td>
                                                </tr>
                                                
                                                <tr>
                                                    <td>Project Link</td>
                                                    <td>
                                                        <?php if(strpos($teamdata['project_link'], 'http') !== false ||  strpos($teamdata['project_link'], 'https') !== false){ ?>
                                            			<p> <a href="<?= $teamdata['project_link']; ?>" target="_blank"><?= $teamdata['project_link']; ?></a></p>
                                            			<?php }else{ echo $teamdata['project_link']; } ?>
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td>Proof</td>
                                                    <td>
                                                       <?php  if ($teamdata['proof'] != "" &&  $teamdata['proof'] != NULL) { ?>
        	                            		        <p><a href=" <?= base_url().'photo/image/'.$teamdata['proof']; ?>"  target="_blank">Proof</a></p>
        	                            			    <?php } ?>
                                                    </td>
                                                </tr>
                                                 <tr>
                                                    <td>CV</td>
                                                    <td>
                                                      <?php  if ($teamdata['cv'] != "" &&  $teamdata['cv'] != NULL) { ?>
        	                            		        <p><a href=" <?= base_url().'photo/image/'.$teamdata['cv']; ?>"  target="_blank">CV</a></p>
        	                            			    <?php } ?>
                                                    </td>
                                                </tr>
                                        
                                        <?php $cntt++;  }  } ?> 
                                    
                                        <!--========START CREW MEMBERS NAME AND ROLW===========================================-->
                                         <?php if($crew_member){ 
                                            $cntt = 1;
                                            foreach($crew_member as $crewmember){ ?>
                                            
                                                <tr>
                                                    <td><b><?php echo "Crew Member-".$cntt ?></b></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Name</td>
                                                    <td><p><?= $crewmember['name']; ?></p></td>
                                                </tr>
                                                <tr>
                                                    <td>Role</td>
                                                    <td><p><?= $crewmember['role']; ?></p></td>
                                                </tr>
                                             <?php  $cntt++; } }  ?>
                                        <!--========END CREW MEMBERS NAME AND ROLW===========================================-->
                                        
                                    <!--==============================END TEAM DETAILS SECTION=====================================-->
                                    <tr>
                                        <td><b>PROJECT DESCRIPTION V2</b></td>
                                        <td></td>
                                    </tr>
                                    <?php foreach ($project_description_form_fields as $project_description_form_field): ?>
                                        <tr>
                                            <td><?= $project_description_form_field['field_label'] ?></td>
                                            <?php if($project_description_form_field['field_type'] == 'file'){ ?>
                                                <td><a target="_blank" href="<?php echo base_url('photo/image/'.$project_description_form_field['form_field_value']); ?>" >View File</a></td>
                                                <?php }else{ ?>
                                            <td><p><?= $project_description_form_field['form_field_value'] ?></p></td>
                                        <?php } ?>
                                        </tr>
                                    <?php endforeach; ?>
                                    
                                    <!--======== START BUDGET DETAILS DATA WILL COME HERE =================================-->
                                        <tr>
                                            <td><b>BUDGET (AMTS IN USD) </b></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Project Budget (USD)</td>
                                            <td><p><?= $application['projectBudget']; ?></p></td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Financial Plan</td>
                                            <td><p><?= $application['financialPlan']; ?></p></td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Budget And Financial Plan</td>
                                            <td>
                                                <?php  if ($application['budgetFile'] != "" &&  $application['budgetFile'] != NULL) { ?>
                                                    <p><a href=" <?= base_url().'photo/image/'.$application['budgetFile']; ?>"  target="_blank">Budget plan</a></p>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Proof of Funding File</td>
                                            <td>
                                                <?php  if ($application['proofFile'] != "" &&  $application['proofFile'] != NULL) { ?>
                                                    <p><a href=" <?= base_url().'photo/image/'.$application['proofFile']; ?>"  target="_blank">Proof of Funding</a></p>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                         <tr>
                                            <td>Total Secured(USD)</td>
                                            <td> <p><?= $application['totalSecured']; ?></p></td>
                                        </tr>
                                         <tr>
                                            <td>Total Applied(USD)</td>
                                            <td><p><?= $application['totalApplied']; ?></p></td>
                                        </tr>
                                        
                                         <tr>
                                            <td>Total Pending(USD)</td>
                                            <td><p><?= $application['totalPening']; ?></p></td> 
                                        </tr>

                                         <tr>
                                            <td>Budget Deficit(USD)</td>
                                            <td><p><?= $application['BudgetDeficit']; ?></p></td>
                                        </tr style="margin-bottom:40px;">
                                        <!--//===================================-->
                                        <?php if($budget_data){ 
                                            $cntt = 1;
                                            foreach($budget_data as $budgetdata){ ?>
                                                
                                                <tr>
                                                    <td><?php echo "Financial Plan-".$cntt ?></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Funding Source</td>
                                                    <td> <p><?= $budgetdata['fundingSource']; ?></p></td>
                                                </tr>
                                                <tr>
                                                    <td>Status</td>
                                                    <td> 
                                                    <?php if($budgetdata['status']==2){ 
                                                        $status = "Applied";
                                                    }else if($budgetdata['status']==1){ 
                                                        $status = "Received";
                                                    }else{ 
                                                        $status = "";
                                                    } ?>
                                                        <p><?= $status; ?></p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Amount(USD)</td>
                                                    <td> <p><?= $budgetdata['amount']; ?></p></td>
                                                </tr>
                                        <?php $cntt++;  } } ?> 
                                        <!--//=========================================-->
                                    <!--========= END BUDGET DETAILS DATA WILL COME HERE =================================-->
                                    
                                    <!--========= CONTRACTS DETAILS DATA WILL COME HERE =================================-->
                                     <tr>
                                        <td><b>CONTRACTS</b></td>
                                        <td></td>
                                    </tr>
                                    
                                    <?php if($contracts){ 
                                        $cntt = 1;
                                        foreach($contracts as $contract){ ?>
                                            
                                            <tr>
                                                <td>
                                                    <?= $cntt." ".$contract["title"] ?>
                                                </td>
                                                <td>
                                                    <?php if($cntt == 1 && $contract['upload_file'] == "" ){ echo $contract["answeris"]; }else{ echo $contract[" "]; } ?>&nbsp;&nbsp;
                                                    <?php  if ($contract['upload_file'] != "" &&  $contract['upload_file'] != NULL) { ?>
                                        		        <p><a href=" <?= base_url().'photo/image/'.$contract['upload_file']; ?>"  target="_blank">uploaded file</a></p>
                                        			<?php } ?>
                                                </td>
                                            </tr>
                                    <?php $cntt++;  } } ?> 
                                    <!--========= CONTRACTS DETAILS DATA WILL COME HERE =================================-->
                                </tbody>
                            </table>
    
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
            </div>
            
            <!--=====accept/reject====== -->
            <!--=====accept/reject====== -->
        <?php 
       
       } // else closed ?>

    </div>

    <div class="col-lg-6 col-md-6">
        
        <div class="h2 sub-header"><center> <small>(Application <?= $total_applications_reviewed ? $total_applications_reviewed : 0 ?> of <?= $total_applications_to_review ?> ) </small> <br> User Review Pane </center> </div>
        
        <?php if($next_id){ ?>
        <a style="float: right; margin-bottom:10px;" href="<?= $this->Csz_model->base_link().'/admin/application/viewoneapplication/'.$next_id ?>" class="btn btn-info btn-sm" role="button">Next<i class="glyphicon glyphicon-chevron-right"></i></a>
        <?php }else{ echo "<br><br>";} ?>
        
        <?php echo form_open($this->Csz_model->base_link(). '/admin/application/savereview/'.$application['id'].'/'.$this->uri->segment(5)); ?>
         
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">

                        <?php  
                        //==========IS ADMIN GIVING THE REVIEW =================
                        if($is_admin &&  $is_1st_grant){ ?>

                             <!--===================================-->
                             <div class="control-group reviewclass">         
                                <label class="control-label" for="name">NOTES</label><br>
                                <textarea name="twelth_ques" id="twelth_ques" row="6" col="5" class="form-control"><?= $review_data[0]['twelth_ques'] ?></textarea>
                            </div> <!-- /control-group -->
                            <div class="control-group reviewclass">
                                <label>Rank the application</label>
                                <input type="number" name="rank" class="form-control" required value="<?= $review_data[0]['rank'] ?>">
                            </div>
                            <br>
                            <input type="submit" name="submit" id="submit" onclick="return checkvalidation();" class="btn btn-info" value="Save & Continue">

                        <?php }else if( $is_editor && $is_1st_grant){
                            //=== DO NOTHING  FOR FIRST GRANT ID AND EIDTOR CASE
                           echo "<h3>You might not have permission to access this section!</h3>";
                        }else{  ?>

                            <!-- ======== ADMIN OR EDITOR GIVING REVIEW ===================== -->
                            <!-- //===SHOWING THE FORM AS IT IS SHOWING.... -->
                            <?php if($is_admin){ ?>

                             <!--===================================-->
                             <div class="control-group reviewclass">         
                                <label class="control-label" for="name">NOTES</label><br>
                                <textarea name="twelth_ques" id="twelth_ques" row="6" col="5" class="form-control"><?= $review_data[0]['twelth_ques'] ?></textarea>
                            </div> <!-- /control-group -->
                            <?php }else if($is_editor){?>

                                 <!--===================================-->
                                 <div class="control-group reviewclass">         
                                    <label class="control-label" for="name">NOTES</label><br>
                                    <textarea name="twelth_ques" id="twelth_ques"  row="6" col="5" class="form-control"><?= $review_data[0]['twelth_ques'] ?></textarea>
                                </div> <!-- /control-group -->


                             <?php } ?>
                                <div class="control-group reviewclass">
                                    <label>Rank the application</label>
                                    <input type="number" name="rank" class="form-control" required value="<?= $review_data[0]['rank'] ?>">
                                </div>
                                <br>
                                <input type="submit" name="submit" onclick="return checkvalidation(); " id="submit" class="btn btn-info" value="Save & Continue">
                           
                        <?php } ?>
                        <!--===================================-->
                        
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
          <?php echo form_close(); ?>
    </div>
</div>
