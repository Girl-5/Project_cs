<section class="fullContainer centerBox resetPass"> <!-- full width -->
    <div class="container"> <!-- container width -->
        <div class="wrapper"> <!-- full width wrapper -->

            <?php if($this->session->flashdata('error_message') != ''){ ?>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <?php echo $this->session->flashdata('error_message'); ?>
                    </div>
                </div>
            <?php } ?>
            <div class="formBox">
                <div class="formWrapper">
                    <h2>Help</h2>
                    <h3>Grant Application Process</h3>
                    <ol>
                        <li>
                            Click Register
                        </li>
                        <li>Type in your Name, Email & set New password.</li>
                        <li>Check your inbox for a verification link. (Please check your spam folder should you not find it on your main inbox)</li>
                        <li>Click on verify</li>
                        <li>Log-In with registered credentials</li>
                        <li>Complete Profile (please note only producers/coproducers are eligible to apply for production grants)</li>
                        <li>Click on the grants</li>
                        <li>Select the grant you would like to apply</li>
                        <li>Click on Apply</li>
                        <li>Complete the application</li>
                        <li>Submit application.</li>
                    </ol>
                    You will be able to edit the application before the deadline.

                </div><!-- form wrapper -->
            </div><!-- form box -->
        </div>
    </div>
</section><!-- reset password -->