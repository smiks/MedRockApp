[include]app/views/head.view.php[/include]
{{welcomeMessage}}
<div class="form">
	<form action='' method='post'>
		<!-- keep names: userid -->
		<input type='text' name='userid' placeholder='Enter your id...'><br>
		<input type='submit' name='submit' value='Login!'><br>
	</form>
</div>
[include]app/views/footer.view.php[/include]