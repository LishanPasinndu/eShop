<?php

session_start();

if(isset($_SESSION["k"])){

    session_destroy();

   ?>

<script>
    window.location = "manageuser.php";
</script>

   <?php

}

?>