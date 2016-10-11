<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<!-- The styles -->
<link id="bs-css" href="<?php echo $this->webroot;?>/css/bootstrap-cerulean.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo $this->webroot;?>css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo $this->webroot;?>css/font-awesome.min.css">

<link href="<?php echo $this->webroot;?>css/charisma-app.css" rel="stylesheet">
<link href="<?php echo $this->webroot;?>css/responsive-tables.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo $this->webroot;?>css/style.css">


<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- The fav icon -->
<link rel="shortcut icon" href="<?php echo $this->webroot;?>ico/favicon.png">

</head>

<body>
<!-- topbar starts -->
<div class="navbar navbar-default" role="navigation">

<div class="navbar-inner">
<button type="button" class="navbar-toggle pull-left animated flip">
<span class="sr-only">Toggle navigation</span>Menu <i class="fa fa-bars"></i>
</button>
<a class="navbar-brand" href="index.html"> <img alt="Charisma Logo" src="img/logo20.png" class="hidden-xs"/>
<span>Charisma</span></a>

<!-- user dropdown starts -->
<div class="btn-group pull-right">
<button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> admin</span>
    <span class="caret"></span>
</button>
<ul class="dropdown-menu">
    <li><a href="#">Profile</a></li>
    <li class="divider"></li>
    <li><a href="login.html">Logout</a></li>
</ul>
</div>
<!-- user dropdown ends -->




</div>
</div>
<!-- topbar ends -->
<div class="ch-container">
<div class="row">   
<!-- left menu starts -->
<div class="col-sm-2 col-lg-2">
<div class="sidebar-nav">
<div class="nav-canvas">
    <div class="nav-sm nav nav-stacked">

    </div>
    <ul class="nav nav-pills nav-stacked main-menu">
       <!--  <li class="nav-header">Main</li> -->
        <li><a href="<?php echo $this->webroot;?>Admin"><i class="fa fa-home"></i><span> Main</span></a>
        </li>
        <li><a href="<?php echo $this->webroot;?>Admin/viewPurchases"><i class="fa fa-home"></i><span> View Purchases</span></a>
        </li>
    </ul>
</div>
</div>
</div>
<!--/span-->
<!-- left menu ends -->

<div id="content" class="col-lg-10 col-sm-10">
<!-- content starts -->
<div>
</div>

<table class="table table-hover table-striped table-bordered bootstrap-datatable datatable responsive table-condensed table-responsive">
<thead>
<tr>
<th>Name</th>
<th>Email</th>
<th>Phone</th>
<th>Category</th>
<th>Plan</th>
<th>Amount</th>
<th>Duration</th>
<th>Purchase Date</th>
<th>Renewal</th>
</tr>
</thead>
<tbody>
<tr>
<td>Akinde Oluwafemi</td>
<td>Oluwafemiakinde@gmail.com</td>
<td>07063325607</td>
<td>Clubs</td>
<td>Yearly</td>
<td>₦298,000.00</td>
<td>2</td>
<td>2012-01-12</td>
<td>2016-01-12</td>
</tr>
</tbody>
</table>

<!-- content ends -->
</div><!--/#content.col-md-0-->
</div><!--/fluid-row-->



<footer class="row">
<p class="col-md-9 col-sm-9 col-xs-12 copyright">&copy; Designed by <a href="http://playspread.com" target="_blank">Playspread</a> 2016</p>
</footer>

</div><!--/.fluid-container-->

<!-- external javascript -->

<script src="<?php echo $this->webroot;?>js/jquery-2.1.1.min.js"></script>
<script src="<?php echo $this->webroot;?>js/bootstrap.min.js"></script>
<script src="<?php echo $this->webroot;?>js/responsive-tables.js"></script>
<script src='<?php echo $this->webroot;?>js/jquery.dataTables.min.js'></script>
<script src="<?php echo $this->webroot;?>js/jquery.iphone.toggle.js"></script>
<script src="<?php echo $this->webroot;?>js/charisma.js"></script>
</body>
</html>
