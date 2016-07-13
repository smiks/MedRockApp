<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Medical App</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="" />
<meta name="author" content="http://medrock.avatar-rpg.net" />
<!-- css -->
<link href="/static/css/bootstrap.min.css" rel="stylesheet" />
<link href="/static/css/fancybox/jquery.fancybox.css" rel="stylesheet">
<link href="/static/css/flexslider.css" rel="stylesheet" />
<link href="/static/css/style.css" rel="stylesheet" />

<style type="text/css">
.numberCircle {
    border-radius: 50%;
    behavior: url(PIE.htc); /* remove if you don't care about IE8 */

    width: 20px;
    height: 20px;
    padding: 1px;

    background: #ffff33;
    border: 1px solid #666;
    color: #000;
    text-align: center;

    font: 12px Arial, sans-serif;
}
</style>
 
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>
<body>
	<div id="wrapper">
	<!-- start header -->
	<header>
	<section class="contactInfo">
	<div class="container"> 
                   

                    <div class="col-md-12"> 
                            <div class="contact-area">
                                <ul>
                                    <li>Medical App</li>
                                </ul>
                            </div> 
                    </div> 
            </div>
		</section>	
        <div class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
					<!-- OUR LOGO -->
                    <a class="navbar-brand" href="/"><img src="/static/img/logo.png" alt="logo"/></a>
                </div>
				<!-- SHOW ONLY IF LOGGED IN -->
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
        			<?php
					if($_SESSION['loggedin']){

                        require_once 'app/models/history.php';
                        $hist = new history();
                        $nUnread = $hist->unRead($_SESSION['userID']);
                        $showUnread = "";
                        if($nUnread > 0){
                            $showUnread = "<span class='numberCircle'>{$nUnread}</span>";
                        }
						?>
						<!-- EXAMPLE: <li class="active"><a href="index.html">Home</a></li>  -->
                        <li><a href="/patienthistory/">History <? echo($showUnread); ?></a></li> 
                        <li><a href="/changeDoctor/">Change doctor</a></li> 
						<li><a href="/logout/">Logout</a></li>
	                <?php
	            	} else { echo"<li>&nbsp;</li>";}
	            	?>                        
                    </ul>
                </div>

            </div>
        </div>
	</header>
	<!-- end header -->
		<section id="featured">
	
	<!-- SHOW ONLY IF NOT LOGGED IN -->
	<!-- Slider -->
		<?php
			if(!$_SESSION['loggedin']){
		?>
        <div id="main-slider" class="flexslider">
            <ul class="slides">
              <li>
                <img src="/static/img/slides/1.jpg" alt="" height="400px" width="auto"/>
                <div class="flex-caption">
                    <h3>Tutorial</h3> 
					<p>Quickly through application.</p>  
                </div>
              </li>
            </ul>
        </div>
	    <?php
		}
		?>           
	<!-- end slider -->
 
	</section> 