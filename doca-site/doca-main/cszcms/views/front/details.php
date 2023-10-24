<section class="fullContainer whiteWrapper contentPage" style="background-color: #fff!important; min-height: 100vh; padding-top: 40px"> <!-- full width -->
    <div class="container"> <!-- container width -->
        <div class="wrapper"> <!-- full width wrapper -->


            <div class="darkArea row">
                <div class="col-md-6">
                    <h1 style="color: #5F1145;" class="mb-2" 1><strong><?php echo $grant[0]['title']; ?></strong></h1>
                    <h3><u>Eligibility</u></h3>
                    <p class="mb-4"><?php echo $grant[0]['eligibility']; ?></p>
                    <h2>Description</h2>
                    <p><p><?php echo $grant[0]['description']; ?></p>
                
                    <div class="">
<div id="google_translate_element"></div>
</div>


<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                </div>
                <div class="col-md-6">
                    <div class="darkImg">
                        <img src="<?php echo base_url('photo/image/'.$grant[0]['image']) ?>" />
<!--                        <img class="mb-3" src="https://grants.documentaryafrica.org/photo/image/2021/1615329070_1-org.jpg">-->
                        <a style="text-align: center" href="https://grants.documentaryafrica.org/apply/<?= $grant[0]['id'] ?>"><p class=""><input type="button" class="button" value="Apply"></p></a>
                    </div>
                </div>
            </div>


        </div>
    </div>
</section><!-- profile information -->