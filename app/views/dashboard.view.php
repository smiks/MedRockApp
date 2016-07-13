	[include]app/views/header.view.php[/include]
	<section id="content">

		<div class="container">
		     <div class="row">
			<div class="col-md-7">
				<!-- Heading and para -->
				<div class="block-heading-two">
					<h3><span>Queue</span></h3>
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
				$ynn = array(0, 1);
				$ynw = array("No", "Yes");

				$pid = 0;
				foreach($patients as $key => $value){

					$coughRepl = str_replace($ynn, $ynw, $value['cough']);
					$vomitRepl = str_replace($ynn, $ynw, $value['vomit']);
					$dizzRepl = str_replace($ynn, $ynw, $value['dizziness']);

					$spo = 0;
					$bp  = 0;
					$tem = 0;

					if($value['saturation'] > 92){
						$spo = 1;
					}

					if($value['bloodPressureSys'] > 100 && $value['bloodPressureSys'] < 135 &&
						$value['bloodPressureDia'] > 60 && $value['bloodPressureDia'] < 85){
						$bp = 1;
					}

					if($value['bloodPressureSys'] > 135 && $value['bloodPressureDia'] > 85){
						$bp = 2;
					}

					if($value['temperature'] > 36 && $value['temperature'] < 37.1){
						$tem = 1;
					}
					if($value['temperature'] > 37){
						$tem = 2;
					}

					$image = "/static/img/vitalSigns/".$spo.$bp.$tem.".png";
					echo"
					<div>
						<b>Patient:</b> &nbsp;&nbsp; {$value['userName']} {$value['userSurname']}<br>
						<b>Birthday:</b> &nbsp;&nbsp; {$value['userBirthDate']}<br>
						<br>
						<b>Coughing:</b> &nbsp;&nbsp; {$coughRepl}<br>
						<b>Vomiting:</b> &nbsp;&nbsp; {$vomitRepl}<br>
						<b>Dizziness:</b> &nbsp;&nbsp; {$dizzRepl}<br>
						<br>
						<a href='#click{$pid}' id='click{$pid}' onClick='moreInfo({$pid});'>Show more</a><br>
						<div id='patient{$pid}' style='display:none;'>
						&nbsp;&nbsp;&nbsp;&nbsp;	<b>Age:</b> &nbsp;&nbsp; {$value['age']}<br>
						&nbsp;&nbsp;&nbsp;&nbsp;	<b>Height:</b> &nbsp;&nbsp; {$value['height']} cm<br>
						&nbsp;&nbsp;&nbsp;&nbsp;	<b>Weight:</b> &nbsp;&nbsp; {$value['weight']} kg<br>
						<br>
						<center>
						<table>
						<tr>
						<td style='width:33%;'>
						Saturation [SpO2]: {$value['saturation']}<br><br><br><br>
						BloodPressure [Sys/Dia]: {$value['bloodPressureSys']}/{$value['bloodPressureDia']}<br>
						</td>
						<td style='width:33%;'>
						<img src='{$image}' style='max-height:250px;'>
						</td>
						<td style='width:33%;'>
						Temperature [°C]: {$value['temperature']}<br><br><br><br>
						Heart Beat [BPM]: {$value['heartRate']}<br>
						</td>
						</tr>
						</table>
						<center>
						<br>
						</div>
					</div>
					";
					if(sizeOf($patients) > 1){
						echo"<hr>";
					}
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