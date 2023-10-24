<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">
               <i><span class="glyphicon glyphicon-user"></span></i>Applications Review List </li>
        </ol>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="h2 sub-header">Reviewed Applications</div>  
               
        <br><br>
        <div class="box box-body table-responsive no-padding">
            <table class="table table-bordered table-hover table-striped" id="dynamic_table_1">
                <thead>
                    <tr>
                        <th width="5%" class="text-center"><?php echo "No"; ?></th>
                        <th width="5%" class="text-center">Rank</th>
                         <th width="20%" class="text-center">Status</th>
                        <th width="20%" class="text-center">Name of Applicant</th>
                        <th width="20%" class="text-center">Application Name</th>
                        <th width="20%" class="text-center">Type of Grant</th>                                       

                        <th width="20%" class="text-center">Date-time</th>
                        <th width="5%" class="text-center">Comments</th>      
                    </tr>
                </thead>
                <tbody>
                    <?php if ($reviews === FALSE) { ?>
                        <tr>
                            <td colspan="5" class="text-center"><span class="h6 error"><?php echo  $this->lang->line('data_notfound') ?></span></td>
                        </tr>                           
                    <?php } else { ?>
                        <?php
                        $id=0;
                        foreach ($reviews as $review) {

                            $id=++$id;  
                            
                            if($review['status']==2){
                                $inactive = ' style="vertical-align: middle;color:red;text-decoration:line-through;"';
                                $status = '<span style="color:red;">Rejected</span>';
                            }else if($review['status']==1){
                                $inactive = '';
                                $status = '<span class="text-info">Shortlisted</span>';
                            }
                            else if($review['status']==3){
                                $inactive = '';
                                $status = '<span style="color:orange;">Preselected</span>';
                            }
                            else if($review['status']==4){
                                $inactive = '';
                                $status = '<span style="color:green;">Awarded</span>';
                            }
                            else{
                                $inactive = '';
                                $status = '<span style="color:orange;"></span>';
                            }
                            
                            ?>
                            <input type="hidden" value="<?= $review['id']  ?>">
                            <?php
                            
                            echo '<tr>';
                            echo '<td class="text-center" style="vertical-align: middle;">' . $id . '</td>';

                            echo '<td class="text-center" style="vertical-align: middle;">' . $review['rank'] . '</td>';
                            echo '<td class="text-center" style="vertical-align: middle;">' . $status . '</td>';
                            echo '<td'.$inactive.' class="text-center" style="vertical-align: middle;">' . $review['applicant_name']. '</td>';
                            echo '<td'.$inactive.' class="text-center" style="vertical-align: middle;">' . $review['application_name'] . '</td>';
                            echo '<td'.$inactive.' class="text-center" style="vertical-align: middle;">' . $review['grant_name'] . '</td>';
                            

                             
                            echo '<td'.$inactive.' class="text-center" style="vertical-align: middle;">' . $review['addon'] . '</td>';
                            echo '<td class="text-center" style="vertical-align: middle;"><a href="'.$this->Csz_model->base_link().'/admin/getreviewcomments/'. $review['id'].'" class="btn btn-default btn-sm" role="button"><i class="glyphicon glyphicon-eye-open"></i> Comments</a></td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>       
        <!-- /widget-content --> 
        <br><br>
        <span class="warning">
            <i class="glyphicon glyphicon-lock"></i> <?php echo  $this->lang->line('default_data_remark') ?>
        </span>
    </div>
</div>
