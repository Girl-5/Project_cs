<section class="fullContainer centerBox budgetScreen"> <!-- full width -->
    <div class="container"> <!-- container width -->
        <div class="wrapper"> <!-- full width wrapper -->
            <div class="formBox" style="max-width: 678px;">
                <div class="formWrapper">
                    <?php echo form_open_multipart(base_url(). 'save_project_contract/'.$this->uri->segment(2)); ?>
                    <?php if($this->session->flashdata('error_message') != ''){ ?>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <?php echo $this->session->flashdata('error_message'); ?>
                            </div>
                        </div>
                        <?php } ?>
                    <div class="progressBarBox">
                        <span>Your Progress</span>
                        <label>90% to complete</label>
                        <div class="progressBar">
                            <div class="selection progress9"></div>
                        </div><!-- progress bar -->
                    </div><!-- progress bar box -->
                    <h2>Contract:</h2>
                    <?php //if($grant[0]['description_type'] != 4){ ?>
                    <div class="formRow">
                        <table>
                            <?php if(!empty($contract)){ 
                                
                            foreach($contract as $vl){
                            ?>
                            <tr>
                                <td><?php echo $vl['title']; ?></td>
                                <td style="width: 24%;">
					<label><input type="hidden" name="contract_id[]"  value="<?php echo $vl['id']; ?>">
<?php if($vl['hide_box'] == 0){ ?>
<input class="hideShow" data="<?php echo $vl['id']; ?>" type="radio" name="answer<?php echo $vl['id']; ?>" value="1">Yes</label>
<label>
    <input data="<?php echo $vl['id']; ?>" class="hideShow" type="radio" name="answer<?php echo $vl['id']; ?>" value="0">No</label>
<?php } ?>
</td>
<td>
 <?php if($vl['upload_file']==1){ ?><input style="width: 100%; <?php if($vl['hide_box'] == 0){ ?> display:none;<?php } ?>" <?php if($vl['hide_box'] == 1 && $vl['upload_optional'] == 0){ echo "required"; } ?> id="file<?php echo $vl['id']; ?>" type="file" name="file<?php echo $vl['id']; ?>"><?php } ?>
</td>
                            </tr>
                            <?php } } ?>
                        </table>
                    </div>
                   <?php //} ?>
                    <div class="formRow">
                     
                    </div>
                    <div class="formRow">
                        <label>Submitted By:</label>
                        <?php
                            $data = array(
                                'name' => 'submittedBy',
                                'autofocus' => 'true',
                                'readonly'  => 'readonly',
                                'class' => 'form-control',
                                'maxlength' => '255',
                                'value' => set_value('submittedBy', $user['name'], FALSE)
                            );
                            echo form_input($data);
                            echo form_error('submittedBy', '<div style="background-color: #f44336;line-height: 25px;text-align: center;color: white;" class="alert success alert-success" role="alert">', '</div>'); 
                        ?>
                    </div>
                    <div class="formRow">
                        <label>
                        <input type="checkbox" required name="confirm" />
                        I hereby assert that I have full authority to make this application and certify that to the best of my knowledge, this application in its entirety contains only true and current information.
                        </label>
                    </div>
                    <div class="footerRow">
                        <a href="<?php echo base_url('project_budget/'.$this->uri->segment(2)); ?>" class="button btnBack">Back</a>
                        <button type="submit" class="button">Save & Finish</a>
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
                                        '<option value="3">Pending Application</option>'+
                                    '</select>'+
                        '</div>'+
                        '<div class="formRow">'+
                            '<label>Amount:</label>'+
                            '<input class="getamount" data="'+rowId+'" id="amount'+rowId+'" type="text" name="amount[]" autocomplete="off"/>'+
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

<script>
    $(".hideShow").on("click", function(){
        var data = $(this).attr('data');
        var id = $(this).val();
        if(id==1){
            $("#file"+data).slideDown();
            $("#file"+data).attr('required','required');
        }else{
            $("#file"+data).slideUp();
            $("#file"+data).removeAttr('required');

        }
    });
</script>