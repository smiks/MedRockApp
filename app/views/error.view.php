[include]app/views/header.view.php[/include]
<section id="content">

	<div class="container">
	     <div class="row">
		<div class="col-md-7">
			<!-- Heading and para -->
			<div class="block-heading-two">
			</div>
			<p>
	<h2>Something went wrong!</h2>
	<b>Error message</b><br>
	<i>{{message}}</i><br><br>
    <script>
        document.write('<a href="' + document.referrer + '"><input id="button" type="button" name="submit" value="Go back!"></a>');
    </script>
			</p>
		</div>
				
	</div> <!-- end of row div -->
	<!-- <div class="row"></div> -->
	</div> <!-- end of container div -->
	
	</section> <!-- end of content section -->



[include]app/views/footer.view.php[/include]