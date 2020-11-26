<?php

require 'app/start.php';

$msg = false;

if (isset($_POST) && !empty($_POST)) {
    
    if ($_POST['email'] && is_string($_POST['email']) && !empty(normal_text($_POST['email']))) {

        $email = normal_text($_POST['email']);
        
        if ($_POST['password'] && is_string($_POST['password']) && !empty(normal_text($_POST['password']))) {

            $password = normal_text($_POST['password']);

            $stmt = $db->prepare("SELECT * FROM `users` WHERE `user_email` = :email");
            $stmt->bindParam(":email", $email);

            if ($stmt->execute() && $stmt->rowCount() > 0) {
                $data = $stmt->fetch();
                if (password_verify($password, $data['user_password'])) {

                    $_SESSION['logged'] = true;
                    $_SESSION['user_id'] = $data['user_id'];

                    if (isset($_POST['remember'])) {
                        setcookie("x-log-s", session_id(),  time() + ((86400 * 30) * 3));
                        insert_session_data($db, session_id(), $data['user_id']);
                    }

                    header('location: ' . URL . '/u.php?slug=' . $data['user_profile_slug']);


                } else {
                    $msg = ['type' => 'error', 'message' => 'Invalid password!'];
                }

            } else {
                $msg = ['type' => 'error', 'message' => 'Invalid email address!'];
            }

        } else {
            $msg = ['type' => 'error', 'message' => 'Password cannot be empty!'];
        }

    } else {
        $msg = ['type' => 'error', 'message' => 'Email cannot be empty!'];
    }
    
}

require_once LAYOUT_DIR.'public_header.view.php';
include_once PAGE_DIR.'login.view.php';
include_once LAYOUT_DIR.'public_footer.view.php';
