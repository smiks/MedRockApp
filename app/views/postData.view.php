[include]app/views/header.view.php[/include]
<section id="content">

	<div class="container">
	     <div class="row">
		<div class="col-md-7">
			<!-- Heading and para -->
			<div class="block-heading-two">
				<h3><span>Your doctor has been informed about your vital signs!</span></h3>
			</div>
			<p>
				Our system predicted the following:<br>
				<i>{{prediction}}</i>
			</p>
		</div>
				
	</div> <!-- end of row div -->
	<!-- <div class="row"></div> -->
	</div> <!-- end of container div -->
	
	</section> <!-- end of content section -->
[include]app/views/footer.view.php[/include]