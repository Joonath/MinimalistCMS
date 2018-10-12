<html>
<head>
<title>Test</title>

<script src="plugins/ckeditor/ckeditor.js"></script>
</head>
<body>
	<form>
		<textarea id="edits"></textarea>
		<script>
		var config = {
				extraPlugins: 'codesnippet',
				codeSnippet_theme: 'monokai_sublime',
				height: 356
			};
	
		CKEDITOR.replace("edits", config);
		</script>
	</form>
</body>
</html>