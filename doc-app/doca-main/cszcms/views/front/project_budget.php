<section class="fullContainer centerBox budgetScreen"> <!-- full width -->
    <div class="container"> <!-- container width -->
        <div class="wrapper"> <!-- full width wrapper -->
            <div class="formBox">
                <div class="formWrapper">
                    <?php echo form_open_multipart(base_url(). 'save_project_budget/'.$this->uri->segment(2)); ?>
                    <?php if($this->session->flashdata('error_message') != ''){ ?>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <?php echo $this->session->flashdata('error_message'); ?>
                            </div>
                        </div>
                        <?php } ?>
                    <div class="progressBarBox">
                        <span>Your Progress</span>
                        <label>70% to complete</label>
                        <div class="progressBar">
                            <div class="selection progress7"></div>
                        </div><!-- progress bar -->
                    </div><!-- progress bar box -->
                    <h2>BUDGET:(Amts in USD)</h2>
											                       

                    <div class="formRow">

                        <label>Project Budget:(USD)</label>
                         <?php
                            $data = array(
                                'name' => 'projectBudget',
                                'autofocus' => 'true',
                                'class' => 'form-control',
                                'id' => 'projectBudget',
                                'maxlength' => '255',
                                'value' => set_value('projectBudget', $application['projectBudget'], FALSE)
                            );
                            echo form_input($data);
                            echo form_error('projectBudget', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    </div>
                    <div class="formRow">
                        <label>Financial Plan:</label>
                       
                    <div>
                        <div id="budget">
                            <?php if(empty($budget)){ ?>
                            <div class="newFormSection" id="div1">
                                <div class="formRow">
                                    <label>Funding Source:</label>
                                    <input type="text" name="fundingSource[]" autocomplete="off"/>
                                </div>
                                <div class="formRow">
                                    <label>Status:</label>
                                    <select class="getamount" id="status1" data="1" name="status[]">
                                        <option value="0">Select</option>
                                        <option value="1">Received</option>
                                        <option value="2">Applied</option>
                                        <!--<option value="3">Pending Application</option>-->
                                    </select>
                                </div>
                                <div class="formRow">
                                    <label>Amount:(USD)</label>
                                    <input class="getamount" data="1" id="amount1" type="number" name="amount[]" autocomplete="off"/>
                                </div>
                            </div>
                            <?php }else{ 
                                $id= 0;
                            foreach($budget as $vl){
                            $id = $id + 1;
                            ?>
                                <div class="newFormSection" id="div<?php echo $id; ?>">
                                <div class="formRow">
                                    <label>Funding Source:</label>
                                    <input type="text" name="fundingSource[]" value="<?php echo $vl['fundingSource']; ?>" autocomplete="off"/>
                                </div>
                                <div class="formRow">
                                    <label>Status:</label>
                                    <select class="getamount" id="status<?php echo $id; ?>" data="<?php echo $id; ?>" name="status[]">
                                        <option <?php echo ($vl['status']==0) ? "selected" : ''; ?> value="0">Select</option>
                                        <option <?php echo ($vl['status']==1) ? "selected" : ''; ?> value="1">Received</option>
                                        <option <?php echo ($vl['status']==2) ? "selected" : ''; ?> value="2">Applied</option>
                                        <!--<option <?php //echo ($vl['status']==3) ? "selected" : ''; ?> value="3">Pending Application</option>-->
                                    </select>
                                </div>
                                <div class="formRow">
                                    <label>Amount:(USD)</label>
                                    <input class="getamount" data="<?php echo $id; ?>" id="amount<?php echo $id; ?>" value="<?php echo $vl['amount']; ?>" type="number" name="amount[]" autocomplete="off"/>
                                </div>
                                <?php if($id!=1){ ?>
                                    <div class="formRow">
                                        <a href="javascript:;" onclick="remove(<?php echo $id; ?>)" class="button" style="float: right;background: #df4759;width: fit-content;"><i class="fa fa-times" aria-hidden="true"></i></a>
                                    </div>
                                <?php } ?>
                            </div>
                            
                            <?php } ?>
                            <?php } ?>
                        </div>
                        <a href="javascript:;" onclick="add()" class="button" ><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                    </div>
                    <div class="formRow">
                            <label>Total Secured:(USD)</label>
                            <input type="text" readonly id="totalSecured" value="<?php echo $application['totalSecured']; ?>" name="totalSecured" autocomplete="off" />
                        </div>
                        <div class="formRow">
                            <label>Total Applied:(USD)</label>
                            <input type="text" readonly id="totalApplied" value="<?php echo $application['totalApplied']; ?>" name="totalApplied" autocomplete="off" />
                        </div>
                        <div class="formRow" style="display:none;">
                            <label>Total Pending:(USD)</label>
                            <input type="text" readonly id="totalPening" value="<?php echo $application['totalPening']; ?>" name="totalPening" autocomplete="off" />
                        </div>
                        <div class="formRow">
                            <label>Budget Deficit:(USD)</label>
                            <input type="text" readonly id="BudgetDeficit" value="<?php echo $application['BudgetDeficit']; ?>" name="BudgetDeficit" autocomplete="off" />
                        </div>
                    <div class="formRow">
                        <label>UPLOAD PROOF OF FUNDING SECURED AS ONE PDF | TÉLÉCHARGER DES PREUVES DE FINANCEMENT ACQUIS EN UN SEUL PDF:</label>
                        <input accept="application/pdf" <?php if(empty($application['proofFile'])){ echo "required"; } ?> type="file" name="proofFile" />

                        <input type="hidden" name="proofFile_data" value="<?php echo $application['proofFile']; ?>" />
                    </div>
                    <?php if(!empty($application['proofFile'])){ ?>
                        <div class="formRow">
                           <a target="_blank" href="<?php echo base_url('photo/image/'.$application['proofFile']); ?>" > <i style="font-size: 38px;" class="fa fa-file" aria-hidden="true"></i> </a>
                        </div>
                                            <?php } ?>

                            <div class="formRow">
                        <label>UPLOAD BUDGET AND FINANCIAL PLAN AS ONE PDF TÉLÉCHARGER LE BUDGET ET LE PLAN DE FINANCEMENT EN UN SEUL PDF:</label>
                        <input <?php /* if(empty($application['budgetFile'])){ echo "required"; } */ ?> type="file" name="budgetFile" />
                        <input type="hidden" name="budgetFile_data" value="<?php echo $application['budgetFile']; ?>" />
                    </div>
                    <?php if(!empty($application['budgetFile'])){ ?>
                        <div class="formRow">
                           <a target="_blank" href="<?php echo base_url('photo/image/'.$application['budgetFile']); ?>" > <i style="font-size: 38px;" class="fa fa-file" aria-hidden="true"></i> </a>
                        </div>
                        
                    <?php } ?>
                    
                    <div class="footerRow">
                        <a href="<?php echo base_url('project_description/'.$this->uri->segment(2)); ?>" class="button btnBack">Back</a>
                        <button type="submit" class="button">Save & Continue</button></a>
                    </div>
                </div><!-- form wrapper -->
            </div><!-- form box -->
        </div>
    </div>
</section><!-- budget information -->


<script>

$(".getamount").focusout(function(){
 countAmount();
});

function countAmount(){
       var rowId = $(this).attr('data');
    var rowNumbers = $(".newFormSection").length;
    var Secured = 0;
    var Applied = 0;
    var Pending = 0;
    var amountStore = 0;
    for(var i=1;i<=(rowNumbers);i++){
        var status = $("#status"+i).val();
         amountStore = $("#amount"+i).val();
        console.log(amountStore);
        if(status==1){
            Secured = Secured + Number(amountStore);
        }else if(status==2){
            Applied = Applied + Number(amountStore);
        }else if(status==3){
            Pending = Pending + Number(amountStore);
        }
    }
    $("#totalSecured").val(Secured);
    $("#totalApplied").val(Applied);
    $("#totalPening").val(Pending);
    var budget = Number($("#projectBudget").val()) - Secured;
    $("#BudgetDeficit").val(budget);
}
    function add(){
        var rowId = $(".newFormSection").length;
        rowId = rowId + 1;
        var data = '<div class="newFormSection" id="div'+rowId+'">'+
                        '<div class="formRow">'+
                            '<label>Funding Source:</label>'+
                            '<input type="text" name="fundingSource[]" autocomplete="off"/>'+
                        '</div>'+
                        '<div class="formRow">'+
                            '<label>Status:</label>'+
                                    '<select data="'+rowId+'" class="getamount" id="status'+rowId+'" name="status[]">'+
                                        '<option value="0">Select</option>'+
                                        '<option value="1">Received</option>'+
                                        '<option value="2">Applied</option>'+
                                        // '<option value="3">Pending Application</option>'+
                                    '</select>'+
                        '</div>'+
                        '<div class="formRow">'+
                            '<label>Amount:</label>'+
                            '<input class="getamount" data="'+rowId+'" id="amount'+rowId+'" type="number" name="amount[]" autocomplete="off"/>'+
                        '</div>'+
                        '<div class="formRow">'+
                            '<a href="javascript:;" onclick="remove('+rowId+')" class="button" style="float: right;background: #df4759;width: fit-content;"><i class="fa fa-times" aria-hidden="true"></i></a>'+
                        '</div>'+
                    '</div>';
        
        $("#budget").append(data).ready(function(){
            $(".getamount").focusout(function(){
             countAmount();
            });
        });
    }
    
    function remove(id){
       $("#div"+id).remove(); 
       countAmount();
    }
    
</script>