<?php

session_start();

if (isset($_SESSION["user_id"])) {
    if (!isset($_SESSION["last regeneration"])) {
        regenerate_session_id_loggedin();
    } else {
        $interval = 60 * 30;
        if (time() - $_SESSION["last regeneration"] >= $interval) {
            regenerate_session_id_loggedin();
            
        }
    }

}


function regenerate_session_id_loggedin()
{
    $userId = $_SESSION["user_id"];
    $newSessionId = session_create_id();
    $sessionId = $newSessionId . "_" . $userId;
    session_id($sessionId);

    $_SESSION["last regeneration"] = time();
}
