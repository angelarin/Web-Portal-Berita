<?php
session_start();
include("includesguest/config.php");
$_SESSION['login']=="";
session_unset();
session_destroy();

?>
<script language="javascript">
document.location="../index.php";
</script>