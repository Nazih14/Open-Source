<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Ultra CV -Admin">
    <meta name="author" content="Ultra CV - Admin">
    <meta name="keyword" content="Ultraviolet Developer, Ultra CV Admin, Ultraviolet CV, ">

    <title>Ultra CV - Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('gui/backend/assets/css/bootstrap.css');?>" rel="stylesheet">
    <!--external css-->
    <link href="<?php echo base_url('gui/backend/assets/font-awesome/css/font-awesome.css" rel="stylesheet');?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('gui/backend/assets/css/zabuto_calendar.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('gui/backend/assets/js/gritter/css/jquery.gritter.css');?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('gui/backend/assets/lineicons/style.css');?>">    
    
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url('gui/backend/assets/css/style.css" rel="stylesheet');?>">
    <link href="<?php echo base_url('gui/backend/assets/css/style-responsive.css" rel="stylesheet');?>">

    <script src="<?php echo base_url('gui/backend/assets/js/chart-master/Chart.js');?>"></script>
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
   <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.html" class="logo"><b>Ultra CV Admin</b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start -->
                 
            
                </ul>
                <!--  notification end -->
            </div>
            <div class="top-menu">
                <ul class="nav pull-right top-menu">
                    <li><a class="logout" href="<?php echo base_url('admin_area/logout');?>">Logout</a></li>
                </ul>
            </div>
        </header>
      <!--header end-->
