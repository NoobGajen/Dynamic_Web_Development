<?php session_start();

if (!isset($_GET['id']) && $_GET['id'] == '') {
    $_SESSION['msg'] = "You are trying to access unauthorized page.";
} else {
    $id = $_GET['id'];
    include_once("./db.php");
    $sql = "DELETE FROM users WHERE id = ?";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        $_SESSION['msg'] = "User" . $id . " is deleted.";
    } else {
        $_SESSION['msg'] = "User" . $id . " deletion failed.";
    }
}
header("location: ./list.php");
?>

