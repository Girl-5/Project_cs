
<section class="fullContainer whiteWrapper dashboardPage"> <!-- full width -->
    <div class="container"> <!-- container width -->
        <div class="wrapper"> <!-- full width wrapper -->
        <?php if($this->session->flashdata('error_message') != ''){ ?>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <?php echo $this->session->flashdata('error_message'); ?>
                            </div>
                        </div>
                        <?php } ?>
            <div class="centerTitle"><h2>Welcome to your Dashboard</h2></div>
            
            <div class="contentArea">
                <table class="grayTable">
                    <tr>
                        <th>S.No.</th>
                        <th>Grant Name</th>
                        <th>Applied Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <?php if(!empty($application)){ 
                        $i=0;
                        foreach($application as $vl){
                            $i++
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><a href=""><?php echo $grant[$vl['grant_id']]; ?></a></td>
                        <td><?php echo $vl['addon']; ?></td>
                        <td><?php 
                        if($vl['complete'] == 0){ echo '<a href="/apply/'.$vl["grant_id"].'">Application not Completed</a>'; }else{
                        if($vl['status'] == 0){ echo "Submitted";}else if($vl['status'] == 1){ echo "Shortlisted";}else if($vl['status'] == 2){ echo "Unsuccesful";} } ?></td>
                        
                        <td><?php if(1 == 1 ){ echo '<a href="/apply/'.$vl["grant_id"].'">Edit</a>'; } ?></td>
                    </tr>
                    <?php } }else{ ?>
                   <p> You have not applied for any Grants <a href="/">Click Here to Apply</a> </p>

                    <?php } ?>
                    
                   <!--application not completed link '.base_url().'apply/'.$vl['grant_id'].' -->
                </table>
            </div><!-- content Area -->
        </div>
    </div>
</section><!-- profile information -->