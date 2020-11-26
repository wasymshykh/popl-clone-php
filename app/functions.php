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

function get_social_links_by_profile($user_id)
{
    global $db;

    $stmt = $db->prepare("SELECT * FROM `user_social` u JOIN `social_media` s ON u.sm_id = s.sm_id WHERE `user_id` = :ui");
    $stmt->bindParam(":ui", $user_id);
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        return $stmt->fetch();
    }

    return false;
}


function go($url)
{
    header("location: " . $url);
    die();
}
