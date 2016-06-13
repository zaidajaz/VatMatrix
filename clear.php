<?php
session_start();
if(isset($_SESSION)){
	session_destroy();
}
?>
<script type="text/javascript">document.location='view.php'</script>