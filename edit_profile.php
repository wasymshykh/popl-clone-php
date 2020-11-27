<?php

require 'app/start.php';

$logged = check_auth();
if (!$logged) {
    go(URL . '/login');
}

$msg = false;
$msg_social = false;
$image_msg = false;

$profile = $logged;

if (isset($_POST['s-e'])) {

    if (isset($_POST['name']) && is_string($_POST['name']) && !empty(normal_text($_POST['name']))) {

        if (!isset($_POST['bio'])) {
            $msg = ['type' => 'error', 'message' => 'Bio field must be submitted!'];
        } else {
            $name = normal_text($_POST['name']);
            $bio = normal_text($_POST['bio']);
            $phone = normal_text($_POST['phone']);
            $address = normal_text($_POST['address']);
            
            $sql = "UPDATE `users` SET `user_name` = :n , `user_bio` = :b, `user_phone` = :p, `user_address` = :ad WHERE `user_id` = :d";
    
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":n", $name);
            $stmt->bindParam(":b", $bio);
            $stmt->bindParam(":p", $phone);
            $stmt->bindParam(":ad", $address);
            $stmt->bindParam(":d", $logged['user_id']);

            if ($stmt->execute()) {
                $msg = ['type' => 'success', 'message' => 'Data is updated!'];

            } else {
                $msg = ['type' => 'error', 'message' => 'Cannot update the data!'];

            }
        }
    } else {
        $msg = ['type' => 'error', 'message' => 'Name cannot be empty!'];
    }
}
else
if (isset($_POST['s-s'])) {

    if (isset($_POST['sm']) && !empty($_POST['sm']) && is_array($_POST['sm'])) {

        $success = false;
        foreach ($_POST['sm'] as $sm_id => $sm_value) {
            
            if (is_numeric($sm_id) && is_string($sm_value)) {
                
                // check for valid sm id
                $_sm = get_social_media_by_id($sm_id);
                if ($_sm) {

                    $status = update_user_social_media($_sm['sm_id'], $sm_value, $logged['user_id']);
                    if ($status) {
                        $success = true;
                    } else {
                        $msg_social = ['type' => 'error', 'message' => 'Unable to submit data!'];
                    }

                } else {
                    $msg_social = ['type' => 'error', 'message' => 'Invalid data submission!'];
                }

            }

        }

        if ($success) {
            $msg_social = ['type' => 'success', 'message' => 'Social media accounts are updated!'];
        }

    } else {
        $msg_social = ['type' => 'error', 'message' => 'Invalid form submission!'];
    }

}
else
if (isset($_POST['s-i'])) {

    $check = getimagesize($_FILES["profile-picture"]["tmp_name"]);
    if($check !== false) {
    
        $file_ext = strtolower(pathinfo(basename($_FILES["profile-picture"]["name"]), PATHINFO_EXTENSION));
        $file_name = time() . '.' . $file_ext;
        $target_file = DIR . "static/images/uploads/" . $file_name;

        if ($_FILES["profile-picture"]["size"] < 500000) {
            
            if (move_uploaded_file($_FILES["profile-picture"]["tmp_name"], $target_file)) {
            
                $sql = "UPDATE `users` SET `user_profile_picture` = :up WHERE `user_id` = :ui";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(":up", $file_name);
                $stmt->bindParam(":ui", $logged['user_id']);

                if ($stmt->execute()) {
                    $image_msg = ['type' => 'success', 'message' => 'Image uploaded successfully!'];
                    $profile = get_user_by_id($logged['user_id']);
                    
                } else {
                    $image_msg = ['type' => 'error', 'message' => 'Sorry could not save the image'];
                }

            } else {
                $image_msg = ['type' => 'error', 'message' => 'Sorry could not upload the image'];
            }
        } else {
            $image_msg = ['type' => 'error', 'message' => 'Uploaded file is not too large'];
        }

    } else {
        $image_msg = ['type' => 'error', 'message' => 'Uploaded file is not an image'];
    }
}

$social = get_social_links_by_profile($profile['user_id']);
$social_media = get_social_media_all(); 

if (!$social) {
    $social = [];
}

require_once LAYOUT_DIR.'profile_header.view.php';
include_once PAGE_DIR.'edit_profile.view.php';
include_once LAYOUT_DIR.'profile_footer.view.php';
