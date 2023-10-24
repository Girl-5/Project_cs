<!-- Page Heading -->
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
</style>
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">
                <i><span class="glyphicon glyphicon-user"></span></i> Reviewed Applications Details
            </li>
        </ol>
    </div>
</div>

<!-- /.row -->
<div class="row" >    
        <div class="col-lg-12 col-md-12">      
        
        <?php if($next_id){ ?>
        <a style="float: right;" href="<?= $this->Csz_model->base_link().'/admin/getreviewcomments/'.$next_id ?>" class="btn btn-info btn-sm" role="button">Next<i class="glyphicon glyphicon-chevron-right"></i></a>
        <?php } ?>
        
        <?php if($previous_id){ ?>
         <a style="float: left;" href="<?= $this->Csz_model->base_link().'/admin/getreviewcomments/'.$previous_id ?>" class="btn btn-info btn-sm" role="button"><i class="glyphicon glyphicon-chevron-left"></i>Previous</a>
        <?php } ?>
        
            <div class="h2 sub-header"><center>Submitted Application Review(s) </center></div>
        </div>       

        <?php if ($reviews_comments === FALSE) { ?>
            <center><h2>No Review Found for this Application!</h2></center>
        <?php }else{          
            $i=0; foreach($reviews_comments as $reviews_comment){   ?>

            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
    
                        <h4><b><?= "Comments by :".$reviews_comment['admin_name']. " (".$reviews_comment['admin_group_name'].")"; ?></b>&nbsp;&nbsp;<b style="float:right;"><?= "Applicant Name: ".$reviews_comment['applicant_name'] ; ?></b></h4>
                        <h4><b style="float:right;"><?= "Application Name: ".$reviews_comment['application_name'] ; ?></b></h4><br>
                        <h4><b style="float:right;" style="float:left;"><?= "Grant: ".$reviews_comment['grant_name'] ; ?></b></h4><br>
                        
                        <?php $$status = "";
                            if($reviews_comment['status']==2){
                                $inactive = ' style="vertical-align: middle;color:red;text-decoration:line-through;"';
                                $status = '<span style="color:red;">Rejected</span>';
                            }else if($reviews_comment['status']==1){
                                $inactive = '';
                                $status = '<span class="text-info" >Shortlisted</span>';
                            }else if($reviews_comment['status']==3){
                                $inactive = '';
                                $status = '<span class="text-warning">Pre-Selected</span>';
                            }else if($reviews_comment['status']==4){
                                $inactive = '';
                                $status = '<span class="text-success">Awarded</span>';
                            } ?>
                            <h4><b style="float:right;" style="float:left;"><?= "Status: ".$status; ?></b></h4><br>
                        <?php  
                        //==========IS ADMIN GIVING THE REVIEW =================
                        if($is_admin &&  $is_1st_grant){ ?>


                             <!--===================================-->
                             <div class="control-group reviewclass">         
                                <label class="control-label" for="name">NOTES</label><br>
                                <textarea name="<?= $i ?>_twelth_ques" row="6" col="5" class="form-control"><?= $reviews_comment['twelth_ques'] ?></textarea>
                            </div> <!-- /control-group -->

                        <?php }else if( $is_editor && $is_1st_grant){
                            //=== DO NOTHING  FOR FIRST GRANT ID AND EIDTOR CASE
                            echo "<h3>You might not have permission to access this section!</h3>";
                        }else{  ?>

                            <!-- ======== ADMIN OR EDITOR GIVING REVIEW ===================== -->
                            <!-- //===SHOWING THE FORM AS IT IS SHOWING.... -->
                            <?php if($reviews_comment['is_this_admin'] != 2){ ?>

                             <!--===================================-->
                             <div class="control-group reviewclass">         
                                <label class="control-label" for="name">NOTES</label><br>
                                <textarea name="<?= $i ?>_twelth_ques" row="6" col="5" class="form-control"><?= $reviews_comment['twelth_ques'] ?></textarea>
                            </div> <!-- /control-group -->
                             <?php }else{?>
                             <!--===================================-->

                             <!--===================================-->
                             <div class="control-group reviewclass">         
                                <label class="control-label" for="name">NOTES</label><br>
                                <textarea name="<?= $i ?>_twelth_ques" row="6" col="5" class="form-control"><?= $reviews_comment['twelth_ques'] ?></textarea>
                            </div> <!-- /control-group -->
                            
                             <?php } ?>

                        <?php } ?>
                        <!--===================================-->
                        <div class="control-group reviewclass">
                            <label class="control-label" for="name">RANK</label><br>
                            <input name="rank" value="<?= $reviews_comment['rank'] ?>" class="form-control">
                        </div>
                       
                    </div>  <!--box-body  -->
                </div>   <!--box box-primary -->
            </div>      <!--col-md12 close here -->

     <?php  $i++; } } ?>
</div>

<div class="row">
      <div class="col-md-12">
          <td class="text-center" style="vertical-align: middle;">
                <a role="button" class="btn btn-danger btn-sm" role="button" onclick="return confirm(`Do you want to reject`)" 
                  href="<?= $this->Csz_model->base_link().'/admin/application/status/'.$this->uri->segment(3).'?status=2&from_view=1' ?>">
                  <i class="glyphicon glyphicon-remove"></i> Reject</a>&nbsp;&nbsp;
                  
                <a role="button" class="btn btn-info btn-sm" role="button" onclick="return confirm(`Do you want to shortlist`)" 
                href="<?= $this->Csz_model->base_link().'/admin/application/status/'.$this->uri->segment(3).'?status=1&from_view=1' ?>">
                      <i class="glyphicon glyphicon-ok"></i> Shortlist</a>
              <a role="button" class="btn btn-warning btn-sm" role="button" onclick="return confirm(`Do you want to pre-select`)"
                 href="<?= $this->Csz_model->base_link().'/admin/application/status/'.$this->uri->segment(3).'?status=3&from_view=1' ?>">
                  <i class="glyphicon glyphicon-ok"></i> Pre-select</a>
              <a role="button" class="btn btn-success btn-sm" role="button" onclick="return confirm(`Do you want to award`)"
                 href="<?= $this->Csz_model->base_link().'/admin/application/status/'.$this->uri->segment(3).'?status=4&from_view=1' ?>">
                  <i class="glyphicon glyphicon-ok"></i> Awarded</a>
                      
                

            </td>
      </div>
    </div>
