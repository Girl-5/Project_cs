<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <title>DocA Grants</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="<?php echo base_url('assets/front/') ?>css/style.css" rel="Stylesheet" type="text/css" />
</head>
<body>

<nav class="fullContainer header"> <!-- full width -->
    <div class="container"> <!-- container width -->
    <div class="wrapper"> <!-- full width wrapper -->

        <div class="logo">
            <a href="https://documentaryafrica.org/grant-listing/"><img src="<?php echo base_url('assets/front/') ?>images/logo.png" /></a>
        </div>
        <div class="navbox">
            <a href="javascript:void(0)" class="bar-icon" id="bar-icon"><i class="fa fa-bars" aria-hidden="true"></i></a>
            <ul class="top-menu">
                <li><a href="/dashboard">Dashboard</a></li>
                <li><a href="/">Grants</a></li>
                <li><a href="https://documentaryafrica.org/mentorships/">Mentorships</a></li>
				<li><a href="https://documentaryafrica.org/workshops-residencies/">Workshops & Residencies</a></li>
				<li><a href="https://documentaryafrica.org/labs/">Labs</a></li>
                <li><a href="/help/">Help</a></li>
                <?php if(empty($this->session->userdata('user_id'))){ ?>
                    <li><a href="<?php echo base_url('login'); ?>" class="button">Login</a></li>
                    <li><a href="<?php echo base_url('eligibility_test'); ?>" class="button">Register</a></li>
                <?php }else{ ?>
                    <li><a href="<?php echo base_url('profile'); ?>" class="button">Profile</a></li>
                    <li><a href="<?php echo base_url('logout'); ?>" class="button">Logout</a></li>
                <?php } ?>
            </ul>
        </div>

    </div>
    </div>   
</nav><!-- header/nav box -->
