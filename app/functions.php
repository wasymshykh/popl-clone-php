<?php

function normal_text($data)
{
    if (gettype($data) !== "array") {
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }
    return '';
}

function normal_text_back($text)
{
    if (gettype($text) !== "array") {
        return htmlspecialchars_decode(trim($text), ENT_QUOTES);
    }
    return '';
}

function normal_date($date, $format = 'M d, Y h:i A')
{
    $d = date_create($date);
    return date_format($d, $format);
}

function current_date($format = 'M d, Y h:i A')
{
    return date($format);
}

function generate_profile_slug($db, $name)
{
    
    $name = str_replace(' ', '-', strtolower($name));

    $got = false;
    $count = 1;
    while (!$got) {
        
        $stmt = $db->prepare("SELECT * FROM `users` WHERE `user_profile_slug` = :slug");
        $stmt->bindParam(":slug", $name);
        $result = $stmt->execute();
        if ($result && $stmt->rowCount() > 0) {
            $name = $name . "-" . $count;
            $count++;
        } else {
            $got = true;
        }

        break;
    }

    return $name;
}

function get_session_by_id($session_id)
{
    global $db;

    $stmt = $db->prepare("SELECT * FROM `user_session` WHERE `session_id` = :id");
    $stmt->bindParam(":id", $session_id);
    if ($stmt->execute()) {

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch();
        } else {
            return false;
        }

    } else {
        return false;
    }
}

function insert_session_data($db, $session_id, $user_id)
{

    $session = get_session_by_id($session_id);


    if ($session) {
        $next_stmt = $db->prepare("UPDATE `user_session` SET `session_user` = :u, `session_updated` = :du WHERE `session_id` = :id");
        $date_time = date('Y-m-d H:i:s');
        $next_stmt->bindParam(":du", $date_time);
    } else {
        $next_stmt = $db->prepare("INSERT INTO `user_session` (`session_id`, `session_user`) VALUE (:id, :u)");
    }

    $next_stmt->bindParam(":id", $session_id);
    $next_stmt->bindParam(":u", $user_id);
    $next_stmt->execute();

}

function get_user_by_id($user_id)
{
    global $db;

    $stmt = $db->prepare("SELECT * FROM `users` WHERE `user_id` = :ui");
    $stmt->bindParam(":ui", $user_id);

    if ($stmt->execute()) {
        return $stmt->fetch();
    } else {
        return false;
    }
}

function check_auth()
{

    if (isset($_SESSION['logged']) && isset($_SESSION['user_id']) && $_SESSION['logged'] && !empty($_SESSION['user_id'])) {
        return get_user_by_id($_SESSION['user_id']);
    }

    if (isset($_COOKIE['x-log-s']) && !empty($_COOKIE['x-log-s']) && is_string($_COOKIE['x-log-s'])) {
        $session_id = normal_text($_COOKIE['x-log-s']);
        $session = get_session_by_id($session_id);

        if ($session) {
            return get_user_by_id($session['session_user']);
        } else {
            return false;
        }
    }
    
    return false;
}

function get_profile_by_slug($slug)
{
    global $db;

    $stmt = $db->prepare("SELECT * FROM `users` WHERE `user_profile_slug` = :slug");
    $stmt->bindParam(":slug", $slug);
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        return $stmt->fetch();
    }

    return false;
}

function get_social_links_by_profile($user_id, $clean = true)
{
    global $db;

    $stmt = $db->prepare("SELECT * FROM `user_social` u JOIN `social_media` s ON u.sm_id = s.sm_id WHERE `user_id` = :ui ORDER BY `us_instant`, `us_dated` DESC");
    $stmt->bindParam(":ui", $user_id);
    if ($stmt->execute() && $stmt->rowCount() > 0) {

        if ($clean) {
            $result = [];
            foreach ($stmt->fetchAll() as $value) {
                $result[$value['sm_id']] = $value;
            }
    
            return $result;
        } else {
            return $stmt->fetchAll();
        }
    }

    return false;
}

function get_social_media_all()
{
    global $db;

    $stmt = $db->prepare("SELECT * FROM `social_media`");
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        return $stmt->fetchAll();
    }

    return false;
}

function get_social_media_by_id($sm_id)
{
    global $db;

    $stmt = $db->prepare("SELECT * FROM `social_media` WHERE `sm_id` = :sm");
    $stmt->bindParam(":sm", $sm_id);
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        return $stmt->fetch();
    }

    return false;
}

function update_user_social_media($sm_id, $sm_value, $user_id, $sm_instant = "1")
{
    global $db;

    // check if sm is available 
    $stmt = $db->prepare("SELECT * FROM `user_social` WHERE `user_id` = :ui AND `sm_id` = :sm");
    $stmt->bindParam(":ui", $user_id);
    $stmt->bindParam(":sm", $sm_id);

    if ($stmt->execute()) {

        if ($stmt->rowCount() > 0) {
            $sql = "UPDATE `user_social` SET `us_name` = :un, `us_instant` = :usi WHERE `sm_id` = :sm AND `user_id` = :ui";
        } else {
            $sql = "INSERT INTO `user_social` (`sm_id`, `user_id`, `us_name`, `us_instant`) VALUE (:sm, :ui, :un, :usi)";
        }

        $stmt = $db->prepare($sql);
        $stmt->bindParam(":ui", $user_id);
        $stmt->bindParam(":sm", $sm_id);
        $stmt->bindParam(":un", $sm_value);
        $stmt->bindParam(":usi", $sm_instant);
        
        if ($stmt->execute()) {

            return true;

        } else {
            return false;
        }

    } else {
        return false;
    }

}

function update_user_instant_status($status, $user_id)
{
    global $db;

    $stmt = $db->prepare("UPDATE `users` SET `user_instant` = :ui WHERE `user_id` = :us");
    $stmt->bindParam(":ui", $status);
    $stmt->bindParam(":us", $user_id);

    if ($stmt->execute()) {
        return true;
    }
    return false;
}

function update_user_password($user_id, $password)
{
    global $db;

    $stmt = $db->prepare("UPDATE `users` SET `user_password` = :p WHERE `user_id` = :ui");
    $stmt->bindParam(":p", $password);
    $stmt->bindParam(":ui", $user_id);

    if ($stmt->execute()) {
        return true;
    }
    return false;
}




function go($url)
{
    header("location: " . $url);
    die();
}
