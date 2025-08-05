<?php
/*include('../../config.php');


$email = $_POST['email'];
$password_user= $_POST['password_user'];



//Verificar contraseña encriptada

$contador = 0;
//Inyeccion de datos
$sql = "SELECT * FROM tb_usuarios WHERE email = '$email'"; 
$query = $pdo ->prepare($sql);
$query->execute();
$usuarios = $query->fetchAll(PDO::FETCH_ASSOC);
foreach($usuarios as $usuario){
    $contador= $contador + 1;
    $email_tabla = $usuario['email'];
    $nombres = $usuario['nombres'];
    $password_user_tabla = $usuario['password_user'];

}




if( ($contador > 0) && (password_verify($password_user, $password_user_tabla)) ){
    echo "Datos correctos, congratulations";
    session_start();
    $_SESSION['sesion_email'] = $email; 
    header('Location: '.$URL. '/index.php' );
} else {
    echo "Datos incorrectos, vuelva a intentarlo";
    session_start();
    $_SESSION['mensaje'] = "Error datos incorrectos";
    header('Location: '. $URL. '/login');
}*/


include('../../config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password_user = $_POST['password_user'];

    $contador = 0;

    $sql = "SELECT * FROM tb_usuarios WHERE email = :email";
    $query = $pdo->prepare($sql);
    $query->bindParam(':email', $email);
    $query->execute();

    $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($usuarios as $usuario) {
        $contador++;
        $email_tabla = $usuario['email'];
        $nombres = $usuario['nombres'];
        $password_user_tabla = $usuario['password_user'];
    }

    if (($contador > 0) && (password_verify($password_user, $password_user_tabla))) {
        echo "Datos correctos, congratulations";
        session_start();
        $_SESSION['sesion_email'] = $email; 
        header('Location: '.$URL.'/index.php');
        exit;
    } else {
        echo "Datos incorrectos, vuelva a intentarlo";
        session_start();
        $_SESSION['mensaje'] = "Error: Datos incorrectos";
        header('Location: '.$URL.'/login');
        exit;
    }
}
?>