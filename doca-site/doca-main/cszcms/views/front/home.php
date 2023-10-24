<section class="fullContainer listingScreen"> <!-- full width -->
    <div style="background-color: #fff">
        <div class="container py-4">
            <h1 class="mb-2" style="color: #5F1145"><strong>Available Grants</strong></h1>
            <div>Apply for grants today!</div>
        </div>
    </div>
    <div class="container "> <!-- container width -->

        <div class="row py-5"> <!-- full width wrapper -->
        <?php if(!empty($grant)){ 
                  foreach($grant as $grantList){
        ?>
            <div class="listingBox col-md-4 ">
                <div class="listingWrapper mb-3">
                    <img src="<?php echo base_url('photo/image/'.$grantList['image']) ?>" />
<!--                    <img src="https://grants.documentaryafrica.org/photo/image/2021/1615329070_1-org.jpg" style="">-->
                    <div class="d-flex justify-content-between">
                        <div style="width: 66%">
                            <a href="/view/<?= $grantList['id'] ?>"><h5 style="color: #fff!important;"><?php echo $grantList['title']; ?></h5></a>
                        </div>
                        <div style="width: 33%; text-align: right; padding-top: 4px">
                            <a href="/apply/<?= $grantList['id'] ?>" class="button" style="background-color: #93C947">Apply</a>
                        </div>
                    </div>


                </div>
            </div><!-- listing box -->
        <?php } ?>
        <?php } ?>
            
        </div>
    </div>
</section><!-- reset password -->
;
<!-- button link <?php echo base_url('apply/'.$grantList['id']); ?> -->
<!-- title link <?php echo base_url('details/'.$grantList['id']); ?> -->