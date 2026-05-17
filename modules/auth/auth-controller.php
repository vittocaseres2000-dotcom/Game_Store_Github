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

    /* VALIDAR EMAIL */

    if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){

        die("Correo inválido");

    }

    /* VERIFICAR SI EXISTE */

    $verify = mysqli_query(
        $conn,
        "SELECT * FROM usuario WHERE correo='$correo'"
    );

    if(mysqli_num_rows($verify) > 0){

        die("El correo ya existe");

    }

    /* ENCRIPTAR PASSWORD */

    $passwordHash = password_hash(
        $password,
        PASSWORD_DEFAULT
    );

    /* INSERTAR */

    $query = "INSERT INTO usuarios(
                nombre,
                correo,
                password
            )
            VALUES(
                '$nombre',
                '$correo',
                '$passwordHash'
            )";

    mysqli_query($conn, $query);

    header(
        "Location: login-view.php"
    );

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
       LOGIN CORRECTO
    ========================= */

    $_SESSION['usuario_id']
    = $usuario['id'];

    $_SESSION['usuario_nombre']
    = $usuario['nombre'];

    $_SESSION['usuario_rol']
    = $usuario['rol'];

    header(
        "Location: ../home/home-view.php"
    );

    exit();

}