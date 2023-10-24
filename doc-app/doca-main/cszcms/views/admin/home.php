<style>
.card {
  position: relative;
  display: flex;
  flex-direction: column;
  min-width: 0;
  word-wrap: break-word;
  background-color: #fff;
  background-clip: border-box;
  border: 1px solid rgba(0, 0, 0, 0.125);
  border-radius: 0.25rem;
}
.card > hr {
  margin-right: 0;
  margin-left: 0;
}
.card > .list-group {
  border-top: inherit;
  border-bottom: inherit;
}
.card > .list-group:first-child {
  border-top-width: 0;
  border-top-left-radius: calc(0.25rem - 1px);
  border-top-right-radius: calc(0.25rem - 1px);
}
.card > .list-group:last-child {
  border-bottom-width: 0;
  border-bottom-right-radius: calc(0.25rem - 1px);
  border-bottom-left-radius: calc(0.25rem - 1px);
}
.card > .card-header + .list-group,
.card > .list-group + .card-footer {
  border-top: 0;
}

.card-body {
  flex: 1 1 auto;
  min-height: 1px;
  padding: 1.25rem;
}

.card-footer {
  padding: 0.75rem 1.25rem;
  background-color: rgba(0, 0, 0, 0.03);
  border-top: 1px solid rgba(0, 0, 0, 0.125);
}
.card-footer:last-child {
  border-radius: 0 0 calc(0.25rem - 1px) calc(0.25rem - 1px);
}

.bg-primary {
    background-color: #007bff !important;
}
.bg-info{
    background-color: #5bc0de !important;
}
.text-white {
    color: #fff !important;
}
.bg-warning {
    background-color: #ffc107 !important;
}
.bg-success {
    background-color: #28a745 !important;
}
.bg-danger {
    background-color: #dc3545 !important;
}
.row{
    display: flex;
}
.small{
    font-size: 30px !important;
}
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h2 class="box-title"><b>Welcome</b></h2>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            
            <div class="box-body">
               
             <?php echo form_open($this->Csz_model->base_link(). '/admin'); ?>
                <div class="row"> 
                    <div class="col-md-2">  
                        <select name="years" class="form-control">
                            <option value="<?php echo date('Y'); ?>"   <?php if($_POST['years'] == date('Y')) { ?> selected <?php } ?> ><?= date("Y"); ?></option>
                            <option value="<?php echo date('Y')-1; ?>" <?php if($_POST['years'] == (date('Y')-1)) { ?>selected <?php } ?> ><?= date("Y")-1; ?></option>
                            <option value="<?php echo date('Y')-2; ?>" <?php if($_POST['years'] == (date('Y')-2)) { ?>selected <?php } ?> ><?= date('Y')-2; ?></option>
                        </select>
                    </div>
                    <div class="col-md-2">       
                        <button type="submit" name="searchdata" value="Search" class="btn btn-primary btn-sm" >Search</button>
                    </div>
                </div>
                  <?php echo form_close(); ?>
                <p><?php //echo $this->lang->line('dash_message') ?></p>
                 <div class="row">
                     
                    <div class="col-xl-2 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">Total</div>
                            <a class="small text-white stretched-link" href="<?php echo $this->Csz_model->base_link()?>/admin/application/viewallapplications/all">
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <?= $all_applications; ?>
                            </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">Incomplete</div>
                            <a class="small text-white stretched-link" href="<?php echo $this->Csz_model->base_link()?>/admin/application/viewallapplications/inprogress">
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <?= $incomplete_applications; ?>
                            </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">Submitted</div>
                            <a class="small text-white stretched-link" href="<?php echo $this->Csz_model->base_link()?>/admin/application/viewallapplications/submitted">
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <?= $submitted_applications; ?>
                            </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-xl-2 col-md-6">
                        <div class="card bg-info text-white mb-4">
                            <div class="card-body">Shortlisted</div>
                            <a class="small text-white stretched-link" href="<?php echo $this->Csz_model->base_link()?>/admin/application/viewallapplications/accepted">
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <?= $shortlisted_applications; ?>
                            </div>
                            </a>
                        </div>
                    </div>
                     <div class="col-xl-2 col-md-6">
                         <div class="card bg-success text-white mb-4">
                             <div class="card-body">Pre-selected</div>
                             <a class="small text-white stretched-link" href="<?php echo $this->Csz_model->base_link()?>/admin/application/viewallapplications/inprogress">
                                 <div class="card-footer d-flex align-items-center justify-content-between">
                                     <?= $preselected_applications; ?>
                                 </div>
                             </a>
                         </div>
                     </div>
                     <div class="col-xl-2 col-md-6">
                        <div class="card bg-danger text-white mb-4">
                            <div class="card-body">Awarded</div>
                            <a class="small text-white stretched-link" href="<?php echo $this->Csz_model->base_link()?>/admin/application/viewallapplications/rejected">
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <?= $accepted_applications; ?>
                            </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!--<div class="box-footer">-->
            <!--    <p><b><a href="https://www.cszcms.com" target="_blank"><?php echo $this->lang->line('dash_cszcms_link') ?></a></b></p>-->
            <!--</div>-->
        </div>
        <!-- /.box -->
    </div>
</div>

<div class="row" style="display: flex;">
	<div class="col-md-6">
		<div id="chartContainer" style="height: 400px; width: 100%;"></div>		
	</div>

	<div class="col-md-6">
		<div id="chartContainer1" style="height: 400px; width: 100%;"></div>		

	</div>
</div>

<div class="row" style="display: flex; margin-top: 20px;">
	<div class="col-md-6">
		<div id="chartContainer2" style="height: 400px; width: 100%;"></div>	
	</div>

	<div class="col-md-6">
		<div id="chartContainer3" style="height: 400px; width: 100%;"></div>		
	</div>
</div>


<!--========== DATA TABLE FOR TOTAL COUNTS ============================-->
<br><br>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h2 class="box-title"><b>Applications and Applicants Summaries</b></h2>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box box-body table-responsive no-padding">
                
                <div style="margin-top:20px; margin-bottom:20px; margin-left:20px;">
                    <span class="btn btn-default btn-sm" onclick="hideShow('1')" >All Details</span>&nbsp;
                    <span class="btn btn-default btn-sm" onclick="hideShow('2')" >Applications Info</span>&nbsp;
                    <span class="btn btn-default btn-sm" onclick="hideShow('3')" >Applicants Info</span>&nbsp;
                    <span class="btn btn-default btn-sm" onclick="hideShow('4')" >Distribution per Country</span>&nbsp; 
                </div>
            
            <div class="all_details" style="display:block;">
                <center><h2 class="box-title"><b>All Details</b></h2></center>
                <table class="table table-bordered table-hover table-striped" id="all_details_datatable">
                    <thead>
                        <tr>
                            <th width="30%" class="text-center">Title</th>
                            <th width="30%" class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>All Applicants</td>
                            <td><?= $all_applicant; ?></td>
                        </tr>
                        <tr>
                            <td>Completed Profile of Applicants</td>
                            <td><?= $completed_profile; ?></td>
                        </tr>
                        <tr>
                            <td>Activated Profiles of Applicants</td>
                            <td><?= $activated_profiles; ?></td>
                        </tr>
                        <tr>
                            <td>In Active Profiles of Applicants</td>
                            <td><?= $inactive_profile; ?></td>
                        </tr>
                        <tr>
                            <td>Male</td>
                            <td><?= $male_g; ?></td>
                        </tr>
                        <tr>
                            <td>Female</td>
                            <td><?= $female_g; ?></td>
                        </tr>
                        <tr>
                            <td>Non Binary</td>
                            <td><?= $non_binary; ?></td>
                        </tr>
                        <tr>
                            <td>Rather not Say </td>
                            <td><?= $rather_not_say; ?></td>
                        </tr>
                        
                        
                        <tr>
                            <td>Submitted Applications</td>
                            <td><?= $submitted_applications; ?></td>
                        </tr>
                        <tr>
                            <td>Incomplete Applications</td>
                            <td><?= $application_in_progress; ?></td>
                        </tr>
                        <tr>
                            <td>Shortlisted Applications</td>
                            <td><?= $accepted_application; ?></td>
                        </tr>
                        <tr>
                            <td>Unsuccesful Applications</td>
                            <td><?= $rejected_application; ?></td>
                        </tr>
                        
                        <?php foreach($country as $key => $countryname){ 
                        
                            if($nationality_names[$key]){  ?>
                            <tr>
                                <td><?= $countryname; ?></td>
                                <td><?= $nationality_names[$key] ? $nationality_names[$key] : 0 ; ?></td>
                            </tr>
                        
                        <?php } } ?>
                    </tbody>
                </table>
            </div>
            <!--==============================================-->
            
            <!--========== COUNTRY WISE INFO DATATABLE ========================-->
            <div class="country_info" style="display:none;">
                <center><h2 class="box-title"><b>Distribution per Country</b></h2></center>
                <table class="table table-bordered table-hover table-striped" id="countrywise_datatable" style="width: 100% !important;">
                    <thead>
                        <tr>
                            <th width="30%" class="text-center">Title</th>
                            <th width="30%" class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($country as $key => $countryname){ 
                        
                            if($nationality_names[$key]){  ?>
                            <tr>
                                <td><?= $countryname; ?></td>
                                <td><?= $nationality_names[$key] ? $nationality_names[$key] : 0 ; ?></td>
                            </tr>
                        
                        <?php } } ?>
                    </tbody>
                </table>
            </div>
            <!--==============================================-->
            
            <!--========== APPLICATION WISE INFO DATATABLE ========================-->
            <div class="application_infod" style="display:none;">
                <center><h2 class="box-title"><b>Applications Info</b></h2></center>
                <table class="table table-bordered table-hover table-striped" id="applicationwise_datatable" style="width: 100% !important;">
                    <thead>
                        <tr>
                            <th width="30%" class="text-center">Title</th>
                            <th width="30%" class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                       <tr>
                            <td>Submitted Applications</td>
                            <td><?= $submitted_applications; ?></td>
                        </tr>
                        <tr>
                            <td>Incomplete Applications</td>
                            <td><?= $application_in_progress; ?></td>
                        </tr>
                        <tr>
                            <td>Shortlisted Applications</td>
                            <td><?= $accepted_application; ?></td>
                        </tr>
                        <tr>
                            <td>Unsuccesful Applications</td>
                            <td><?= $rejected_application; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!--==============================================-->
            
            <!--========== APPLICANTS WISE INFO DATATABLE ========================-->
            <div class="applicant_infod" style="display:none;">
                <center><h2 class="box-title"><b>Applicants Info</b></h2></center>
                <table class="table table-bordered table-hover table-striped" id="applicant_infod_datatable" style="width: 100% !important;">
                    <thead>
                        <tr>
                            <th width="30%" class="text-center">Title</th>
                            <th width="30%" class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                       <tr>
                            <td>All Applicants</td>
                            <td><?= $all_applicant; ?></td>
                        </tr>
                        <tr>
                            <td>Completed Profiles of Applicants</td>
                            <td><?= $completed_profile; ?></td>
                        </tr>
                        <tr>
                            <td>Activated Profiles of Applicants</td>
                            <td><?= $activated_profiles; ?></td>
                        </tr>
                        <tr>
                            <td>In Active Profiles of Applicants</td>
                            <td><?= $inactive_profile; ?></td>
                        </tr>
                        <tr>
                            <td>Male</td>
                            <td><?= $male_g; ?></td>
                        </tr>
                        <tr>
                            <td>Female</td>
                            <td><?= $female_g; ?></td>
                        </tr>
                        <tr>
                            <td>Non Binary</td>
                            <td><?= $non_binary; ?></td>
                        </tr>
                        <tr>
                            <td>Rather not Say </td>
                            <td><?= $rather_not_say; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!--==============================================-->
            
        </div>
           
            
        </div>
        <!-- /.box -->
    </div>
</div>
<!--===================================================================-->
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<?php 


//=============SUBMITTED GRANT APPLICATION COUNT ARRAY ===============
$submitted =[];
foreach ($grantnameArray as $kes => $value2) {
 	$submitted[] = array("label"=>$value2["title"], "y"=>$submitted_grant_application[$value2['id']]);
}
//============== GRANT APPLICATION IN PROGRESS DATA ====================


//=============SUBMITTED GRANT APPLICATION COUNT ARRAY ===============
$in_progress=[];
foreach ($grantnameArray as $kes => $value2) {
 	$in_progress[] = array("label"=>$value2["title"], "y"=>$inprogress_grant_application[$value2['id']]);
}

//================ NATIONALITY COUNT ARRAY ========================
$nationalitydata = [];
$maxXvalue = 10;
if($nationality_names){
 $maxvalue1 = max($nationality_names);    
}
$maxvalue = max($maxXvalue, $maxvalue1); 
foreach ($nationality_names as $keys => $value) {
 	$nationalitydata[] = array("label"=>$keys, "y"=>$value);
}

// ========GENDER ARRAY DATA ============================
$piechartdata = array( 
  	array("label"=>"Female", "y"=>$female_g),
  	array("label"=>"Male", "y"=>$male_g),
    array("label"=>"Non Binary", "y"=>$non_binary),
	array("label"=>"Rather not Say", "y"=>$rather_not_say),
);
 
 ?>
 <!--=============================script section ===========================-->
<script>
window.onload = function() {
 
 var maxvalue = "<?php echo $maxvalue ?>";
 CanvasJS.addColorSet("pinkShades",["pink"]);
 CanvasJS.addColorSet("blueShades",["#6666FF"]);
var chart = new CanvasJS.Chart("chartContainer", {
	colorSet: "pinkShades",	
	dataPointWidth: 40,
	animationEnabled: true,
	// theme: "light2",
	title:{
		text: "Submitted Grant Application",
		fontFamily: "Arial",
        fontWeight: "normal",
        fontSize: 20,
	},
	axisX:{
        title: "",
        labelAngle: -45,
        labelFontSize: 10
      },      
	data: [{
		type: "column",
     	
		yValueFormatString: "#",
		dataPoints: <?php echo json_encode($submitted, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
 var chart2 = new CanvasJS.Chart("chartContainer1", {
	colorSet: "blueShades",	
	dataPointWidth: 40,
	animationEnabled: true,
	// theme: "light2",
	title:{
		text: "Grant Application in Progress",
		fontFamily: "Arial",
        fontWeight: "normal",
        fontSize: 20,
	},

	axisX:{
        title: "",
        labelAngle: -45,
        labelFontSize: 10
      },  
	data: [{
		type: "column",
		yValueFormatString: "##",
		dataPoints: <?php echo json_encode($in_progress, JSON_NUMERIC_CHECK); ?>
	}]
});
chart2.render();


// ======================= START SPLINE AREA CHART HERE ===============================
var chart3 = new CanvasJS.Chart("chartContainer2", {
	animationEnabled: true,  
	title:{
		text: "Nationalities Distribution",
		fontFamily: "Arial",
        fontWeight: "normal",
        fontSize: 20,
	},


	data: [{
		type: "splineArea",
		color: "rgba(54,158,173,.7)",
		markerSize: 5,
		xValueFormatString: "YY",
		yValueFormatString: "##",
		dataPoints: <?php echo json_encode($nationalitydata, JSON_NUMERIC_CHECK); ?>
	}]
	});
chart3.render();
// =================== END SPLINE AREA CHART HERE ==============================

// =============== PIE CHART START HERE =======================================
var chart4 = new CanvasJS.Chart("chartContainer3", {
	animationEnabled: true,
	title: {
		text: "Gender Distribution",
        fontFamily: "Arial",
        fontWeight: "normal",
        fontSize: 20,
	},
	data: [{
		type: "pie",
		yValueFormatString: "###",
		radius: 100,
		indexLabel: "{label} ({y})",
		dataPoints: <?php echo json_encode($piechartdata, JSON_NUMERIC_CHECK); ?>
	}]
});
chart4.render();
// =============== END HERE ===================================================
}
</script>
<!-- Page Heading -->
<div class="row" style="display:none;">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title"><i><span class="fa fa-rss"></span></i> <?php echo $this->lang->line('dashboard_rssnews') ?></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12" style="word-wrap:break-word;">
                        <?php echo $rss; /* get rss feed */?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box -->
    </div>
</div>