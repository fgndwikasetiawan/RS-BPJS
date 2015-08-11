<html>
	<head>
	</head>
	<body>
		<script src="/assets/js/jquery.js"></script>
		<script>
			$(function(){
				var a = {
					haha: 'asdasd',
					hoho: 'heheheh',
					huhu: 'asjdklk'
				}
				$.ajax({
					url: '/ajax/baz',
					method: 'POST',
					data: a,
					success: function(data) {
						$('#output').text(data);
					}
				});
			});
		</script>
		<span id="output"></span>
	</body>
	
</html>

