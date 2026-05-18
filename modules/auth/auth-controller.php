<!--Trabajo_GrupalWeb/modules/auth/auth-controller.php-->
<?php

session_start();

require_once("../../config/database.php");

/* =========================
   REGISTER
========================= */

if(isset($_POST['register'])){

    $nombre = trim($_POST['nombre']);

    $correo = trim($_POST['correo']);

    $password = trim($_POST['password']);

    $confirmar =
    trim($_POST['confirmar_password']);

    $errors = [];

    /* VALIDAR NOMBRE */

    if(empty($nombre)){

        $errors['nombre_error']
        = "Ingresa tu nombre";

    }

    /* VALIDAR EMAIL */

    if(
        !filter_var(
            $correo,
            FILTER_VALIDATE_EMAIL
        )
    ){

        $errors['correo_error']
        = "Correo inválido";

    }

    /* VALIDAR PASSWORD */

    if(strlen($password) < 8){

        $errors['password_error']
        = "Mínimo 8 caracteres";

    }

    elseif(
        !preg_match(
            '/[A-Z]/',
            $password
        )
    ){

        $errors['password_error']
        = "Debe tener una mayúscula";

    }

    elseif(
        !preg_match(
            '/[0-9]/',
            $password
        )
    ){

        $errors['password_error']
        = "Debe tener un número";

    }

    /* CONFIRMAR PASSWORD */

    if($password !== $confirmar){

        $errors['confirmar_error']
        = "Las contraseñas no coinciden";

    }

    /* MOSTRAR ERRORES */

    if(!empty($errors)){

        $url =
        "Location: register-view.php?";

        foreach($errors as $key => $value){

            $url .=
            $key . "=" .
            urlencode($value)
            . "&";

        }

        header($url);

        exit();

    }

    /* VERIFICAR CORREO */

    $verify = mysqli_query(

        $conn,

        "SELECT * FROM usuario
         WHERE correo='$correo'"

    );

    if(mysqli_num_rows($verify) > 0){

        header(
            "Location: register-view.php?correo_error="
            . urlencode(
                "El correo ya existe"
            )
        );

        exit();

    }

    /* ENCRIPTAR PASSWORD */

    $passwordHash = password_hash(

        $password,
        PASSWORD_DEFAULT

    );

    /* INSERTAR */

    $query = mysqli_query(

        $conn,

        "INSERT INTO usuario(

            nombre,
            correo,
            contrasena

        )

        VALUES(

            '$nombre',
            '$correo',
            '$passwordHash'

        )"

    );

    if($query){

      /* =========================
   GENERAR 2FA
========================= */

$codigo2fa = rand(100000, 999999);

/* =========================
   GUARDAR CÓDIGO
========================= */

mysqli_query(

    $conn,

    "UPDATE usuario
     SET codigo_2fa='$codigo2fa'
     WHERE correo='$correo'"

);

/* =========================
   ENVIAR CORREO
========================= */

$asunto =
"Verificación GameStore";

$mensaje =
"Hola ".$nombre."\n\n".
"Tu código de verificación es:\n\n".
$codigo2fa."\n\n".
"Bienvenido a GameStore.";

$headers =
"From: gamestore@localhost";

mail(

    $correo,
    $asunto,
    $mensaje,
    $headers

);

/* =========================
   SESIÓN TEMPORAL
========================= */

$_SESSION['2fa_correo']
= $correo;

/* =========================
   REDIRECCIÓN
========================= */

header(

    "Location: verify-2fa.php"

);

exit();
    }else{

        die(
            mysqli_error($conn)
        );

    }

}
/* =========================
   LOGIN
========================= */

if(isset($_POST['login'])){

    $correo = trim($_POST['correo']);

    $password = trim($_POST['password']);

    $errors = [];

    /* =========================
       VALIDAR EMAIL VACÍO
    ========================= */

    if(empty($correo)){

        $errors['correo_error']
        = "Ingresa tu correo electrónico";

    }

    elseif(strlen($correo) > 100){

        $errors['correo_error']
        = "El correo es demasiado largo";

    }

    elseif(!filter_var($correo, FILTER_VALIDATE_EMAIL)){

        $errors['correo_error']
        = "Ingresa un correo válido";

    }

    /* =========================
       PASSWORD VACÍA
    ========================= */

    if(empty($password)){

        $errors['password_error']
        = "Ingresa tu contraseña";

    }

    /* =========================
       MOSTRAR ERRORES
    ========================= */

    if(!empty($errors)){

        $url =
        "Location: login-view.php?";

        if(isset($errors['correo_error'])){

            $url .=
            "correo_error="
            . urlencode($errors['correo_error'])
            . "&";

        }

        if(isset($errors['password_error'])){

            $url .=
            "password_error="
            . urlencode($errors['password_error'])
            . "&";

        }

        $url .=
        "correo="
        . urlencode($correo);

        header($url);

        exit();

    }

    /* =========================
       BUSCAR USUARIO
    ========================= */

    $query = mysqli_query(
    $conn,
    "SELECT * FROM usuario WHERE correo='$correo'"
);

if(!$query){
    die("Error en la consulta: " . mysqli_error($conn));
}

if(mysqli_num_rows($query) == 0){

        header(
            "Location: login-view.php?correo_error="
            . urlencode("El correo no está registrado")
            . "&correo="
            . urlencode($correo)
        );

        exit();

    }

    $usuario = mysqli_fetch_assoc($query);

    /* =========================
       PASSWORD INCORRECTA
    ========================= */

    if(
        !password_verify(
            $password,
            $usuario['contrasena']
        )
    ){

        header(
            "Location: login-view.php?password_error="
            . urlencode("Contraseña incorrecta")
            . "&correo="
            . urlencode($correo)
        );

        exit();

    }

    /* =========================
   GENERAR CÓDIGO 2FA
========================= */

$codigo2fa = rand(100000, 999999);

/* =========================
   GUARDAR CÓDIGO
========================= */

mysqli_query(

    $conn,

    "UPDATE usuario
     SET codigo_2fa='$codigo2fa'
     WHERE correo='$correo'"

);

/* =========================
   ENVIAR CORREO
========================= */

$asunto =
"Código de acceso GameStore";

$mensaje =
"Hola ".$usuario['nombre']."\n\n".
"Tu código de verificación es:\n\n".
$codigo2fa."\n\n".
"GameStore Security";

$headers =
"From: gamestore@localhost";

mail(

    $correo,
    $asunto,
    $mensaje,
    $headers

);

/* =========================
   SESIÓN TEMPORAL
========================= */

$_SESSION['2fa_usuario']
= $usuario['id_usuario'];

$_SESSION['2fa_nombre']
= $usuario['nombre'];

$_SESSION['2fa_rol']
= $usuario['rol'];

$_SESSION['2fa_correo']
= $correo;

/* =========================
   IR A VERIFY
========================= */

header(

    "Location: verify-2fa.php"

);

exit();
}