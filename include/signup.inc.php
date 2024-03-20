<?php
 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];

    try {
        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'signup_view.inc.php';
        require_once 'signup_contr.inc.php';

        //ERROR HANDLERS
        $errors = [];

        if (is_input_empty($username, $pwd, $email)) {
            $errors["empty_input"] = "Please Fill in all fields!";
        }if (is_email_invalid($email)) {
            $errors["invalid_email"] = "Input valid Email!";
        }if (is_username_taken($pdo, $username)) {
            $errors["username_taken"] = "This username is already been taken";
        }if (is_email_registered($pdo, $email)) {
            $errors["registered_email"] = "This Email is already Registered";
        }

        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["error_signup"] = $errors;
            header("Location: ../index.php");
            die();
        }

        create_user($pdo, $username, $pwd, $email);

        header("Location: ../index.php?signup=sucess");

        $pdo = null;
        $stmt = null;
        die();

    } catch (PDOException $th) 
    {
        die("Query Failed" . $th->getMessage());
    }

} else {
    header("Location: ../index.php");
    die();
}
