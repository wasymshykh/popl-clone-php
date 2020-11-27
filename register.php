<?php

require 'app/start.php';

$msg = false;

if (isset($_POST) && !empty($_POST)) {

    if ($_POST['name'] && is_string($_POST['name']) && !empty(normal_text($_POST['name']))) {

        $name = normal_text($_POST['name']);

        if ($_POST['email'] && is_string($_POST['email']) && !empty(normal_text($_POST['email']))) {

            $email = normal_text($_POST['email']);
            
            if ($_POST['password'] && is_string($_POST['password']) && !empty(normal_text($_POST['password']))) {

                $password = normal_text($_POST['password']);
                $password = password_hash($password, PASSWORD_BCRYPT);

                // check for duplicate email

                $stmt = $db->prepare("SELECT * FROM `users` WHERE `user_email` = :email");
                $stmt->bindParam(":email", $email);
                $result = $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    $msg = ['type' => 'error', 'message' => 'Email already Exists!'];
                } else {
                    
                    // generate profile slug

                    $slug = generate_profile_slug($db, $name);

                    // send to db

                    $sql = "INSERT INTO `users`(`user_name`, `user_password`, `user_email`, `user_profile_slug`, `user_created`) VALUE (:uname, :pass, :email, :slug, :uc)";
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(":uname", $name);
                    $stmt->bindParam(":pass", $password);
                    $stmt->bindParam(":email", $email);
                    $stmt->bindParam(":slug", $slug);
                    $date_time = date('Y-m-d H:i:s');
                    $stmt->bindParam(":uc", $date_time);

                    if ($stmt->execute()) {
                        $msg = ['type' => 'success', 'message' => 'You have successfully joined! <a href="'.URL.'/login">Go to login <i class="fas fa-arrow-right"></i></a>'];
                        unset($_POST);
                    } else {
                        $msg = ['type' => 'error', 'message' => 'System error while trying to register!'];
                    }

                }

            } else {
                $msg = ['type' => 'error', 'message' => 'Password cannot be empty!'];
            }

        } else {
            $msg = ['type' => 'error', 'message' => 'Email cannot be empty!'];
        }

    } else {
        $msg = ['type' => 'error', 'message' => 'Name cannot be empty!'];
    }

}

require_once LAYOUT_DIR.'public_header.view.php';
include_once PAGE_DIR.'register.view.php';
include_once LAYOUT_DIR.'public_footer.view.php';
