[include]app/views/header.view.php[/include]
{{welcomeMessage}}
<div class="formDiv">
	<form action='' method='post' class="form">
		<!-- keep names: userid -->
		<input type='text' name='userid' placeholder='Enter your id...'><br>
		<input type='submit' name='submit' value='Login!'><br>
	</form>
</div>
[include]app/views/footer.view.php[/include]