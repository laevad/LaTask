<?php

function insert_user($user) {
    global $db;
    $errors = validate_user($user);
    if (!empty($errors)) {
        return $errors;
    }
    $hashed_password = password_hash($user['password'], PASSWORD_BCRYPT);
    $sql = "INSERT INTO users ";
    $sql .= "(username, contact, address, password) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $user['username']) . "',";
    $sql .= "'" . db_escape($db, $user['contact']) . "',";
    $sql .= "'" . db_escape($db, $user['address']) . "',";
    $sql .= "'" . db_escape($db, $hashed_password) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    if($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}
function validate_user($user, $options=[]) {
    $password_required = $options['password_required'] ?? true;
    if(is_blank($user['username'])) {
        $errors[] = "Username cannot be blank.";
    } elseif (!has_length($user['username'], array('min' => 8, 'max' => 255))) {
        $errors[] = "Username must be between 8 and 255 characters.";
    } elseif (!has_unique_username($user['username'], $user['id'] ?? 0)) {
        $errors[] = "Username not allowed. Try another.";
    }
    if(is_blank($user['contact'])) {
        $errors[] = "Contact cannot be blank.";
    } elseif (!has_length($user['contact'], array('min' => 11, 'max' => 11))) {
        $errors[] = "Contact must be 12 digits.";
    }
    if(is_blank($user['address'])) {
        $errors[] = "Address cannot be blank.";
    } elseif (!has_length($user['address'], array('min' => 2, 'max' => 255))) {
        $errors[] = "Address must be between 2 and 255 characters.";
    }
    if($password_required) {
        if(is_blank($user['password'])) {
            $errors[] = "Password cannot be blank.";
        } elseif (!has_length($user['password'], array('min' => 12))) {
            $errors[] = "Password must contain 12 or more characters";
        } elseif (!preg_match('/[A-Z]/', $user['password'])) {
            $errors[] = "Password must contain at least 1 uppercase letter";
        } elseif (!preg_match('/[a-z]/', $user['password'])) {
            $errors[] = "Password must contain at least 1 lowercase letter";
        } elseif (!preg_match('/[0-9]/', $user['password'])) {
            $errors[] = "Password must contain at least 1 number";
        } elseif (!preg_match('/[^A-Za-z0-9\s]/', $user['password'])) {
            $errors[] = "Password must contain at least 1 symbol";
        }
        if(is_blank($user['confirm_password'])) {
            $errors[] = "Confirm password cannot be blank.";
        } elseif ($user['password'] !== $user['confirm_password']) {
            $errors[] = "Password and confirm password must match.";
        }
    }
    return $errors;
}

function find_user_by_username($username) {
    global $db;

    $sql = "SELECT * FROM users ";
    $sql .= "WHERE username='" . db_escape($db, $username) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $user = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $user;
}
function add_product($item){
    global $db;

    $fileExt = explode('.', $item['fileName']);
    $item['fileActualExt'] = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png');
    if (in_array($item['fileActualExt'], $allowed)){
        if ($item['fileError'] === 0){
            if ($item['fileSize'] < 5000000){
                $fileNameNew = uniqid().rand(1,10000000).$_SESSION['user_id'].".".$item['fileActualExt'];
                $fileDestination = 'uploads/'.$fileNameNew;
                move_uploaded_file($item['fileTmpName'], $fileDestination);

                $sql = "INSERT INTO items ";
                $sql .= "(user_id, name, price, description, image) ";
                $sql .= "VALUES (";
                $sql .= "'" . db_escape($db,  $_SESSION['user_id']) ."',";
                $sql .= "'" . db_escape($db, $item['name']) . "',";
                $sql .= "'" . db_escape($db, $item['price']) . "',";
                $sql .= "'" . db_escape($db, $item['description']) . "',";
                $sql .= "'" . db_escape($db, $fileNameNew) . "'";
                $sql .= ")";
                $result = mysqli_query($db, $sql);
                return true;
            }else{
                $errors[] = "your file is too large";
                return $errors;
            }
        }else{
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }else{
        $errors[] = "no image detected!";
        return $errors;
    }


}
function display() {
    global $db;
    $sql = "SELECT items.name, items.price, items.image, items.description, users.address, users.contact FROM users INNER JOIN items on users.id = items.user_id";
    //echo $sql;
    //SELECT items.name, items.price, items.image, items.description, users.address, users.contact FROM users INNER JOIN items on users.id = items.user_id;
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}
function display_img($user_id) {
    global $db;
    $sql = "SELECT * from item where user_id='$user_id' ";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}


function validate_update_user($user, $options=[]) {

    $password_required = $options['password_required'] ?? true;
    if(is_blank($user['username'])) {
        $errors[] = "Username cannot be blank.";
    } elseif (!has_length($user['username'], array('min' => 8, 'max' => 255))) {
        $errors[] = "Username must be between 8 and 255 characters.";
    } elseif (!has_unique_username($user['username'], $user['id'] ?? 0)) {
        $errors[] = "Username not allowed. Try another.";
    }
    if(is_blank($user['contact'])) {
        $errors[] = "Contact cannot be blank.";
    } elseif (!has_length($user['contact'], array('min' => 11, 'max' => 11))) {
        $errors[] = "Contact must be 12 digits.";
    }
    if(is_blank($user['address'])) {
        $errors[] = "Address cannot be blank.";
    } elseif (!has_length($user['address'], array('min' => 2, 'max' => 255))) {
        $errors[] = "Address must be between 2 and 255 characters.";
    }
    if($password_required) {
        if(is_blank($user['password'])) {
            $errors[] = "Password cannot be blank.";
        } elseif (!has_length($user['password'], array('min' => 12))) {
            $errors[] = "Password must contain 12 or more characters";
        } elseif (!preg_match('/[A-Z]/', $user['password'])) {
            $errors[] = "Password must contain at least 1 uppercase letter";
        } elseif (!preg_match('/[a-z]/', $user['password'])) {
            $errors[] = "Password must contain at least 1 lowercase letter";
        } elseif (!preg_match('/[0-9]/', $user['password'])) {
            $errors[] = "Password must contain at least 1 number";
        } elseif (!preg_match('/[^A-Za-z0-9\s]/', $user['password'])) {
            $errors[] = "Password must contain at least 1 symbol";
        }

        if(is_blank($user['confirm_password'])) {
            $errors[] = "Confirm password cannot be blank.";
        } elseif ($user['password'] !== $user['confirm_password']) {
            $errors[] = "Password and confirm password must match.";
        }
    }

    return $errors;
}


function update_user($user) {
    global $db;

    $password_sent = !is_blank($user['password']);

    $errors = validate_update_user($user, ['password_required' => $password_sent]);
    if (!empty($errors)) {
        return $errors;
    }

    $hashed_password = password_hash($user['password'], PASSWORD_BCRYPT);

    $sql = "UPDATE users SET ";
    if($password_sent) {
        $sql .= "password='" . db_escape($db, $hashed_password) . "', ";
    }
    $sql .= "username='" . db_escape($db, $user['username']) . "', ";
    $sql .= "contact='" . db_escape($db, $user['contact']) . "', ";
    $sql .= "address='" . db_escape($db, $user['address']) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $user['id']) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    // For UPDATE statements, $result is true/false
    if($result) {
        return true;
    } else {
        // UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function find_user_by_id($id) {
    global $db;

    $sql = "SELECT * FROM users ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $user = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $user;
}
