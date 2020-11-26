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
