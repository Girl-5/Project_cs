<section class="fullContainer centerBox welcomeScreen"> <!-- full width -->
    <div class="container" style="align-items:baseline;"> <!-- container width -->
        <div class="wrapper"> <!-- full width wrapper -->
                    
            <div class="formBox">
                <div class="formWrapper">
                    <h2>Eligibility Test</h2>
                    <h4>All questions must be YES to go to next step</h4>

                    <div class="formRow">
                        <label>1: IS THE FILM SET IN AFRICA?</label>
                        <div class="row">
                            <input type="radio" class="form-control" onclick="check_eligibility()" name="first_ques" value="1">&nbsp;&nbsp;Yes
                            <input type="radio" class="form-control" onclick="check_eligibility()" name="first_ques" checked="" value="0">&nbsp;&nbsp;No
                        </div>
                    </div>
                    <div class="formRow">
                        <label>2: ARE THE PROTAGONISTS AFRICAN CITIZENS AND RESIDENTS?</label>
                        <div class="row">
                            <input type="radio" class="form-control" onclick="check_eligibility()" name="second_ques" value="1">&nbsp;&nbsp;Yes
                            <input type="radio" class="form-control" onclick="check_eligibility()" name="second_ques" checked="" value="0">&nbsp;&nbsp;No
                        </div>
                    </div>
                    <div class="formRow">
                        <label>3: IS THE FILM BASED ON AN AFRICAN SUBJECT MATTER OR AN UNDERLYING ISSUE?</label>
                        <div class="row">
                            <input type="radio" class="form-control" onclick="check_eligibility()"  name="third_ques" value="1">&nbsp;&nbsp;Yes
                            <input type="radio" class="form-control" onclick="check_eligibility()"  name="third_ques" checked=""  value="0">&nbsp;&nbsp;No
                        </div>
                    </div>

                    <div class="formRow">
                        <label>4: IS THE ORIGINAL DIALOGUE RECORDED MAINLY IN ENGLISH OR AFRICAN LANGUAGE?</label>
                        <div class="row">
                            <input type="radio" class="form-control" onclick="check_eligibility()" name="fourth_ques" value="1">&nbsp;&nbsp;Yes
                            <input type="radio" class="form-control" onclick="check_eligibility()" name="fourth_ques" checked=""  value="0">&nbsp;&nbsp;No
                        </div>
                    </div>

                    <div class="formRow">
                        <label>5: DOES THE FILM DEMONSTRATE AFRICAN CREATIVITY, AFRICAN HERITAGE AND/OR DIVERSITY?</label>
                        <div class="row">
                            <input type="radio" class="form-control" onclick="check_eligibility()" name="fifth_ques" value="1">&nbsp;&nbsp;Yes
                            <input type="radio" class="form-control" onclick="check_eligibility()" name="fifth_ques" checked=""  value="0">&nbsp;&nbsp;No
                        </div>
                    </div>

                    <div class="formRow">
                        <label>6: DOES AT LEAST 50% OF THE PRINCIPAL PHOTOGRAPHY OR SFX TAKE PLACE IN AFRICA?</label>
                        <div class="row">
                            <input type="radio" class="form-control" onclick="check_eligibility()" name="sixth_ques" value="1">&nbsp;&nbsp;Yes
                            <input type="radio" class="form-control" onclick="check_eligibility()"  name="sixth_ques" checked=""  value="0">&nbsp;&nbsp;No
                        </div>
                    </div>

                    <div class="formRow">
                        <label>7: DOES AT LEAST 50% OF THE VFX TAKE PLACE IN AFRICA?</label>
                        <div class="row">
                            <input type="radio" class="form-control" onclick="check_eligibility()" name="seventh_ques" value="1">&nbsp;&nbsp;Yes
                            <input type="radio" class="form-control" onclick="check_eligibility()" name="seventh_ques" checked=""  value="0">&nbsp;&nbsp;No
                        </div>
                    </div>

                    <div class="formRow">
                        <label>8: DOES THE MUSIC RECORDING/AUDIO POSTPRODUCTION/PICTURE POSTPRODUCTION TAKE PLACE IN AFRICA?</label>
                        <div class="row">
                            <input type="radio"  class="form-control" onclick="check_eligibility()" name="eighth_ques" value="1">&nbsp;&nbsp;Yes
                            <input type="radio"  class="form-control" onclick="check_eligibility()" name="eighth_ques" checked=""  value="0">&nbsp;&nbsp;No
                        </div>
                    </div>

                    <div class="formRow">
                        <label>9: ARE THE FOLLOWING CREW MEMBERS AFRICAN?</label><br>

                        <label>DIRECTOR</label>
                        <div class="row">
                            <input type="radio" class="form-control" onclick="check_eligibility()" name="nine_ques_a" value="1">&nbsp;&nbsp;Yes
                            <input type="radio" class="form-control" onclick="check_eligibility()" name="nine_ques_a" checked=""  value="0">&nbsp;&nbsp;No
                        </div>
                        <label>PRODUCER</label>
                        <div class="row">
                            <input type="radio"  class="form-control" onclick="check_eligibility()" name="nine_ques_b" value="1">&nbsp;&nbsp;Yes
                            <input type="radio"  class="form-control" onclick="check_eligibility()" name="nine_ques_b" checked=""  value="0">&nbsp;&nbsp;No
                        </div>
                        <label>SCRIPTWRITER</label>
                        <div class="row">
                            <input type="radio"  class="form-control" onclick="check_eligibility()" name="nine_ques_c" value="1">&nbsp;&nbsp;Yes
                            <input type="radio"  class="form-control" onclick="check_eligibility()" name="nine_ques_c" checked=""  value="0">&nbsp;&nbsp;No
                        </div>
                        <label>MUSIC SUPERVISOR/COMPOSER</label>
                        <div class="row">
                            <input type="radio"  class="form-control" onclick="check_eligibility()" name="nine_ques_d" value="1">&nbsp;&nbsp;Yes
                            <input type="radio"  class="form-control" onclick="check_eligibility()" name="nine_ques_d" checked=""  value="0">&nbsp;&nbsp;No
                        </div>
                        <label>IMPACT PRODUCER</label>
                        <div class="row">
                            <input type="radio"  class="form-control" onclick="check_eligibility()" name="nine_ques_e" value="1">&nbsp;&nbsp;Yes
                            <input type="radio"  class="form-control" onclick="check_eligibility()" name="nine_ques_e" checked=""  value="0">&nbsp;&nbsp;No
                        </div>
                        <label>EDITOR</label>
                        <div class="row">
                            <input type="radio" class="form-control" onclick="check_eligibility()"  name="nine_ques_f" value="1">&nbsp;&nbsp;Yes
                            <input type="radio" class="form-control" onclick="check_eligibility()"  name="nine_ques_f" checked=""  value="0">&nbsp;&nbsp;No
                        </div>
                        <label>SFX/VFX ARTISTS</label>
                        <div class="row">
                            <input type="radio" class="form-control" onclick="check_eligibility()" name="nine_ques_g" value="1">&nbsp;&nbsp;Yes
                            <input type="radio" class="form-control" onclick="check_eligibility()" name="nine_ques_g" checked=""  value="0">&nbsp;&nbsp;No
                        </div>
                    </div>                    
                   
                    <div class="footerRow">
                      <a href="<?php echo base_url('register'); ?>" style="pointer-events:none;" class="button eligibility_next">Next</a>
                    </div>
                </div><!-- form wrapper -->
            </div><!-- form box -->
        </div>
    </div>
</section><!-- welcome screen -->


