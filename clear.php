<?php

session_start();

if(isset($_SESSION["k"])){

    session_destroy();

   ?>

<script>
    window.location = "manageproducts.php";
</script>

   <?php

}

?>