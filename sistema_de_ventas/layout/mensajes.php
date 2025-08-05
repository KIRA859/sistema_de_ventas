<?php


if(  (isset($_SESSION['mensaje'])) && (isset($_SESSION['icono'])) ) {
    $respuesta = $_SESSION['mensaje']; 
    ?>
    <script>
        alert("<?php echo $_SESSION['mensaje']; ?>");
    </script>
<?PHP
    unset($_SESSION['mensaje']);
}
?>