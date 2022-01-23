<?php
function is_post_request() {
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}
function url_for($script_path) {
    if($script_path[0] != '/') {
        $script_path = "/" . $script_path;
    }
    return WEB . $script_path;
}
function redirect_to($location) {
    header("Location: " . $location);
    exit;
}
function display_errors($errors=array()) {
    $output = '';
    if(!empty($errors)) {
      $output .= "<div class=\"errors\">";
      $output .= "Please fix the following errors:";
      $output .= "<ul>";
      foreach($errors as $error) {
        $output .= "<li>" . h($error) . "</li>";
      }
      $output .= "</ul>";
      $output .= "</div>";
    }
    return $output;
}
function u($string="") {
  return urlencode($string);
}

function raw_u($string="") {
  return rawurlencode($string);
}

function h($string="") {
  return htmlspecialchars($string);
}
function get_and_clear_session_message() {
    if(isset($_SESSION['message']) && $_SESSION['message'] != '') {
      $msg = $_SESSION['message'];
      unset($_SESSION['message']);
      return $msg;
    }
  }
  
function display_session_message() {
$msg = get_and_clear_session_message();

if(!is_blank($msg)) {
    return '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>'. h($msg).'</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
}
}
  