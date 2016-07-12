[include]app/views/head.view.php[/include]
<div class="queueTop">
	<div class="queue">
		<?
			$pid = 0;
			foreach($patients as $key => $value){
			?>

				<div>
					<b>Patient:</b> &nbsp;&nbsp; {{value['userName']}} {{value['userSurname']}}<br>
					<b>Birthday:</b> &nbsp;&nbsp; {{value['userBirthDate']}}<br>
					<a href='#'>Show more</a><br>
					<div  id="patient{{pid}}">

					</div>
				</div>
				<br>
			<?
				$pid += 1;
			}
		?>
	</div>
</div>
[include]app/views/footer.view.php[/include]