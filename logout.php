<?php
session_start();
session_destroy();
?>

<script language="javascript">
    alert("Anda Akan Logout!");
    document.location="login.php";
</script>