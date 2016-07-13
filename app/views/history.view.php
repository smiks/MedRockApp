[include]app/views/header.view.php[/include]
<section id="content">

	<div class="container">
	     <div class="row">
		<div class="col-md-7">
			<!-- Heading and para -->
			<div class="block-heading-two">
				<h3><span>History</span></h3>
			</div>
			<p>
				<?
					$ynn = array(0, 1);
					$ynw = array("No", "Yes");

					$pid = 0;

					foreach($history as $key => $value){
					
						$coughRepl = str_replace($ynn, $ynw, $value['cough']);
						$vomitRepl = str_replace($ynn, $ynw, $value['vomit']);
						$dizzRepl = str_replace($ynn, $ynw, $value['dizziness']);
						$visit = str_replace($ynn, $ynw, $value['requiredVisit']);

						$unread = "";
						if($value['unread'] == 1){
							$unread = "<b>UNREAD!</b><br>";
						}

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
							{$unread}
							<b>Date:</b> &nbsp;&nbsp; {$value['addedDate']}<br>
							<b>Required visit at the doctor's:</b> &nbsp;&nbsp; {$visit}<br>
							<a href='#click{$pid}' id='click{$pid}' onClick='moreInfo({$pid});'>Show more</a><br>
							<div id='patient{$pid}' style='display:none;'>
							&nbsp;&nbsp;&nbsp;&nbsp;	<b>Height:</b> &nbsp;&nbsp; {$value['height']} cm<br>
							&nbsp;&nbsp;&nbsp;&nbsp;	<b>Weight:</b> &nbsp;&nbsp; {$value['weight']} kg<br>
							<br>
							<b>Coughing:</b> &nbsp;&nbsp; {$coughRepl}<br>
							<b>Vomiting:</b> &nbsp;&nbsp; {$vomitRepl}<br>
							<b>Dizziness:</b> &nbsp;&nbsp; {$dizzRepl}<br>						
							<br>
							<center>
							<table style='width:100%;'>
							<tr>
							<td style='width:35%; text-align:right; vertical-align:text-top; padding-top:7%;'>
							Temperature: <i>{$value['temperature']} °C</i><br><br><br><br>
							Blood Pressure<br>
							Systolic: <i>{$value['bloodPressureSys']} mmHg</i> <br>
							Diastolic: <i>{$value['bloodPressureDia']} mmHg</i> <br>
							</td>
							<td style='width:30%;'>
							<center>
							<img src='{$image}' style='max-height:250px;'>
							</center>
							</td>
							<td style='width:35%; text-align:left; vertical-align:text-top; padding-top:7%;'>
							SpO<sub style='vertical-align: sub;'>2</sub>: <i>{$value['saturation']} % </i> <br><br><br><br>
							Heart Beat: <i>{$value['heartRate']} BPM</i> <br>
							</td>
							</tr>
							<tr>
							<td colspan='3'>
							<br>
							<center>
							Doctor's response:<br>
							<i>{$value['notes']}</i>
							</center>
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