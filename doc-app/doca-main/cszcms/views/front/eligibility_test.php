<section class="fullContainer centerBox welcomeScreen"> <!-- full width -->
    <div class="container" style="align-items:baseline;"> <!-- container width -->
        <div class="wrapper"> <!-- full width wrapper -->
                    
            <div class="formBox">
                <div class="formWrapper">
                    <h2>Eligibility Test</h2>
                    <h4 style="margin-top:0;">Please Confirm Eligibility!</h4>

                <!-- ======================== 1st SECTION ========================================== -->                
                <div class="first_section">
                    <div class="formRow">
                        <label>1: Are you a national of any African country?</label>
                        <div class="row px-3">
                            <input type="radio" class="form-control" style="width: auto" onclick="check_eligibility_third()" name="first_ques" value="1">&nbsp;&nbsp;Yes
                            <input type="radio" class="form-control" style="width: auto" onclick="check_eligibility_third()" name="first_ques" checked="" value="0">&nbsp;&nbsp;No
                        </div>
                    </div>
                    <div class="formRow">
                        <label>2: Are you a resident of an African country?</label>
                        <div class="row px-3">
                            <input type="radio" class="form-control" style="width: auto" onclick="check_eligibility_third()" name="second_ques" value="1">&nbsp;&nbsp;Yes
                            <input type="radio" class="form-control" style="width: auto" onclick="check_eligibility_third()" name="second_ques" checked="" value="0">&nbsp;&nbsp;No
                        </div>
                    </div>
<!--                    <div class="formRow">-->
<!--                        <label>2: ARE THE PROTAGONISTS AFRICAN CITIZENS AND RESIDENTS?</label>-->
<!--                        <div class="row">-->
<!--                            <input type="radio" class="form-control" onclick="check_eligibility_first()" name="second_ques" value="1">&nbsp;&nbsp;Yes-->
<!--                            <input type="radio" class="form-control" onclick="check_eligibility_first()" name="second_ques" checked="" value="0">&nbsp;&nbsp;No-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="formRow">-->
<!--                        <label>3: IS THE FILM BASED ON AN AFRICAN SUBJECT MATTER OR AN UNDERLYING ISSUE?</label>-->
<!--                        <div class="row">-->
<!--                            <input type="radio" class="form-control" onclick="check_eligibility_first()"  name="third_ques" value="1">&nbsp;&nbsp;Yes-->
<!--                            <input type="radio" class="form-control" onclick="check_eligibility_first()"  name="third_ques" checked=""  value="0">&nbsp;&nbsp;No-->
<!--                        </div>-->
<!--                    </div>-->

                    <div class="footerRow">
<!--                      <button style="pointer-events:none;" class="button eligibility_next_first">Next </button>-->
                        <a href="<?php echo base_url('register'); ?>" style="pointer-events:none;" class="button eligibility_next_third">Next</a>
                    </div>
                </div>
                <!-- ======================== 1st SECTION END HERE=================================== -->


                <!-- ======================== 2nd SECTION ========================================= -->                
               <div class="second_section d-none" style="display: none;">
                    <div class="formRow">
                        <label>4: IS THE ORIGINAL DIALOGUE RECORDED MAINLY IN ENGLISH OR AFRICAN LANGUAGE?</label>
                        <div class="row">
                            <input type="radio" class="form-control" onclick="check_eligibility_second()" name="fourth_ques" value="1">&nbsp;&nbsp;Yes
                            <input type="radio" class="form-control" onclick="check_eligibility_second()" name="fourth_ques" checked=""  value="0">&nbsp;&nbsp;No
                        </div>
                    </div>

                    <div class="formRow">
                        <label>5: DOES THE FILM DEMONSTRATE AFRICAN CREATIVITY, AFRICAN HERITAGE AND/OR DIVERSITY?</label>
                        <div class="row">
                            <input type="radio" class="form-control" onclick="check_eligibility_second()" name="fifth_ques" value="1">&nbsp;&nbsp;Yes
                            <input type="radio" class="form-control" onclick="check_eligibility_second()" name="fifth_ques" checked=""  value="0">&nbsp;&nbsp;No
                        </div>
                    </div>

                    <div class="formRow">
                        <label>6: DOES AT LEAST 50% OF THE PRINCIPAL PHOTOGRAPHY OR SFX TAKE PLACE IN AFRICA?</label>
                        <div class="row">
                            <input type="radio" class="form-control" onclick="check_eligibility_second()" name="sixth_ques" value="1">&nbsp;&nbsp;Yes
                            <input type="radio" class="form-control" onclick="check_eligibility_second()"  name="sixth_ques" checked=""  value="0">&nbsp;&nbsp;No
                        </div>
                    </div>
                    <div class="footerRow">
                      <button style="pointer-events:none;" class="button eligibility_next_second">Next </button>
                    </div>
                </div>
                <!-- ======================== 2nd SECTION END HERE=================================== -->


                <!-- ======================== 3rd SECTION ============================================ -->
                <div class="third_section d-none" style="display: none;">
                    <div class="formRow">
                        <label>7: DOES AT LEAST 50% OF THE VFX TAKE PLACE IN AFRICA?</label>
                        <div class="row">
                            <input type="radio" class="form-control" onclick="check_eligibility_third()" name="seventh_ques" value="1">&nbsp;&nbsp;Yes
                            <input type="radio" class="form-control" onclick="check_eligibility_third()" name="seventh_ques" checked=""  value="0">&nbsp;&nbsp;No
                        </div>
                    </div>

                    <div class="formRow">
                        <label>8: DOES THE MUSIC RECORDING/AUDIO POSTPRODUCTION/PICTURE POSTPRODUCTION TAKE PLACE IN AFRICA?</label>
                        <div class="row">
                            <input type="radio"  class="form-control" onclick="check_eligibility_third()" name="eighth_ques" value="1">&nbsp;&nbsp;Yes
                            <input type="radio"  class="form-control" onclick="check_eligibility_third()" name="eighth_ques" checked=""  value="0">&nbsp;&nbsp;No
                        </div>
                    </div>

                    <div class="formRow">
                        <label>9: ARE THE FOLLOWING CREW MEMBERS AFRICAN?</label><br>

                        <label>DIRECTOR</label>
                        <div class="row">
                            <input type="radio" class="form-control" onclick="check_eligibility_third()" name="nine_ques_a" value="1">&nbsp;&nbsp;Yes
                            <input type="radio" class="form-control" onclick="check_eligibility_third()" name="nine_ques_a" checked=""  value="0">&nbsp;&nbsp;No
                        </div>
                        <label>PRODUCER</label>
                        <div class="row">
                            <input type="radio"  class="form-control" onclick="check_eligibility_third()" name="nine_ques_b" value="1">&nbsp;&nbsp;Yes
                            <input type="radio"  class="form-control" onclick="check_eligibility_third()" name="nine_ques_b" checked=""  value="0">&nbsp;&nbsp;No
                        </div>
                        <label>SCRIPTWRITER</label>
                        <div class="row">
                            <input type="radio"  class="form-control" onclick="check_eligibility_third()" name="nine_ques_c" value="1">&nbsp;&nbsp;Yes
                            <input type="radio"  class="form-control" onclick="check_eligibility_third()" name="nine_ques_c" checked=""  value="0">&nbsp;&nbsp;No
                        </div>
                        <label>MUSIC SUPERVISOR/COMPOSER</label>
                        <div class="row">
                            <input type="radio"  class="form-control" onclick="check_eligibility_third()" name="nine_ques_d" value="1">&nbsp;&nbsp;Yes
                            <input type="radio"  class="form-control" onclick="check_eligibility_third()" name="nine_ques_d" checked=""  value="0">&nbsp;&nbsp;No
                        </div>
                        <label>IMPACT PRODUCER</label>
                        <div class="row">
                            <input type="radio"  class="form-control" onclick="check_eligibility_third()" name="nine_ques_e" value="1">&nbsp;&nbsp;Yes
                            <input type="radio"  class="form-control" onclick="check_eligibility_third()" name="nine_ques_e" checked=""  value="0">&nbsp;&nbsp;No
                        </div>
                        <label>EDITOR</label>
                        <div class="row">
                            <input type="radio" class="form-control" onclick="check_eligibility_third()"  name="nine_ques_f" value="1">&nbsp;&nbsp;Yes
                            <input type="radio" class="form-control" onclick="check_eligibility_third()"  name="nine_ques_f" checked=""  value="0">&nbsp;&nbsp;No
                        </div>
                        <label>SFX/VFX ARTISTS</label>
                        <div class="row">
                            <input type="radio" class="form-control" onclick="check_eligibility_third()" name="nine_ques_g" value="1">&nbsp;&nbsp;Yes
                            <input type="radio" class="form-control" onclick="check_eligibility_third()" name="nine_ques_g" checked=""  value="0">&nbsp;&nbsp;No
                        </div>
                    </div>                  
                   
                    <div class="footerRow">
                      <a href="<?php echo base_url('register'); ?>" style="pointer-events:none;" class="button eligibility_next_third">Next</a>
                    </div>
                </div>
                <!-- ======================== 3rd SECTION END HERE=================================== -->


                </div><!-- form wrapper -->
            </div><!-- form box -->
        </div>
    </div>
</section><!-- welcome screen -->


