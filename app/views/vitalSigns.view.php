[include]app/views/header.view.php[/include]
<section id="content">

	<div class="container">
	     <div class="row">
		<div class="col-md-7">
			<!-- Heading and para -->
			<div class="block-heading-two">
				<h3><span>Vital Signs</span></h3>
			</div>
			<p>
	<form action='/postdata/' method='post'>
		<big><b>Body<b></big><br>
		<input type='text' name='bodyWeight' placeholder='Weight [kg]'><br>
		<input type='text' name='bodyHeight' placeholder='Height [cm]'><br>		
		<big><b>Vital signs<b></big><br>
		<input type='text' name='temperature' placeholder='Temperature'><br>
		<input type='text' name='heartRate' placeholder='Heart rate [bpm]'><br>
		<input type='text' name='saturation' placeholder='Saturation [%]'><br>
		<input type='text' name='bloodPressureSys' placeholder='Blood pressure - Systolic'><br>	
		<input type='text' name='bloodPressureDia' placeholder='Blood pressure - Diastolic'><br>
		<input type='text' name='breathingRate' placeholder='Breathing rate'><br>
		<big><b>Coughing<b></big><br>
		<input type='radio' name='cough' value='0'> &nbsp; Yes <br>
		<input type='radio' name='cough' value='1'> &nbsp; No <br>
		<big><b>Puking<b></big><br>
		<input type='radio' name='puke' value='0'> &nbsp; Yes <br>
		<input type='radio' name='puke' value='1'> &nbsp; No <br>	
		<big><b>Dizziness<b></big><br>
		<input type='radio' name='dizziness' value='0'> &nbsp; Yes <br>
		<input type='radio' name='dizziness' value='1'> &nbsp; No <br>				

		<br>
		<input type='submit' name='submit' value='Submit Data'><br>
	</form>
</p>
		</div>
				
	</div> <!-- end of row div -->
	<!-- <div class="row"></div> -->
	</div> <!-- end of container div -->
	
	</section> <!-- end of content section -->
[include]app/views/footer.view.php[/include]