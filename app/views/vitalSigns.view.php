[include]app/views/head.view.php[/include]
{{welcomeMessage}}
<div class="form">
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
		<input type='text' name='breathingRate' placeholder='Breathing rate'><br><br>
		<input type='submit' name='submit' value='Submit Data'><br>
	</form>
</div>
[include]app/views/footer.view.php[/include]