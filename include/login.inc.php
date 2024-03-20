<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];

    try {
        require_once 'dbh.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';

        //ERROR HANDLER
        $errors = [];

        if (is_input_empty($username, $pwd)) {
            $errors["empty_input"] = "Please Fill in all fields!";
        }

        $result = get_user($pdo, $username);

        if (is_username_wrong($result)) {
            $errors["login_incorrect"] = "Incorrect Login info";
        }
        if (!is_username_wrong($result) && is_password_wrong($pwd, $result["pwd"])) {
            $errors["login_incorrect"] = "Incorrect Password";
        }

        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["error_login"] = $errors;
            header("Location: ../index.php");
            die();
        }

        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["id"];
        session_id($sessionId);

        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_username"] = htmlspecialchars($result["username"]);


        header("Location: ../index.php?login=sucess");

        $pdo = null;
        $stmt = null;
        die();
    } catch (PDOException $th) {
        die("Query Failed" . $th->getMessage());
    }
} else {
    header("Location: ../index.php");
    die();
}
