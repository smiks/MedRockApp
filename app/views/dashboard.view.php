[include]app/views/header.view.php[/include]
<section id="content">

	<div class="container">
	     <div class="row">
		<div class="col-md-7">
			<!-- Heading and para -->
			<div class="block-heading-two">
				<h3><span>Queueeeeeeeeeeee</span></h3>
			</div>
			<p>

		<?
			/*
			function bmi($h, $w){
				$tmp = $h/100;  // from cm to m
				$bmi = $w / ($tmp*$tmp);
				return $bmi;
			}
			*/
			$pid = 0;
			foreach($patients as $key => $value){
				//$bmi = bmi($value['height'], $value['weight']);
				//BMI = ( Weight in Kilograms / ( Height in Meters x Height in Meters ) )
			?>

				<div>
					<b>Patient:</b> &nbsp;&nbsp; {{value['userName']}} {{value['userSurname']}}<br>
					<b>Birthday:</b> &nbsp;&nbsp; {{value['userBirthDate']}}<br>
					<a href='#' id="click{{pid}}" onClick="moreInfo({{pid}});">Show more</a><br>
					<div id="patient{{pid}}" style="display:none;">
					&nbsp;&nbsp;&nbsp;&nbsp;	<b>Age:</b> &nbsp;&nbsp; {{value['age']}}<br>
					&nbsp;&nbsp;&nbsp;&nbsp;	<b>Height:</b> &nbsp;&nbsp; {{value['height']}} cm<br>
					&nbsp;&nbsp;&nbsp;&nbsp;	<b>Weight:</b> &nbsp;&nbsp; {{value['weight']}} kg<br>
					<!-- &nbsp;&nbsp;&nbsp;&nbsp;	<b>BMI:</b> &nbsp;&nbsp; <? echo($bmi); ?><br> -->
					</div>
				</div>
				<br>
			<?
				$pid += 1;
			}
		?>


			</p>
		</div>
				
	</div> <!-- end of row div -->
	<!-- <div class="row"></div> -->
	</div> <!-- end of container div -->
	
	</section> <!-- end of content section -->



[include]app/views/footer.view.php[/include]