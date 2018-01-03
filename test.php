<?php
include 'querys.php';
	print 5454;
	print "<br>".strlen(5454.54);
?>
<br/><button id="reload">Reload</button>
<script src="js/jquery-3.2.1.min.js"></script>
<script>
	$("#reload").click(function(){
		location.reload(true);
	});	
</script>