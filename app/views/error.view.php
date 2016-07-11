[include]app/views/head.view.php[/include]
<div class="error">
	Something went wrong!<br>
	Error message:<br>
	{{message}}<br>
    <script>
        document.write('<a href="' + document.referrer + '"><input id="button" type="button" name="submit" value="Go back!"></a>');
    </script>
</div>
[include]app/views/footer.view.php[/include]