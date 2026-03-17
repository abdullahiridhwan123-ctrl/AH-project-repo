<?php
// Start the session
session_start();
// Destroy the active session, which logs the user out
session_destroy();
// Redirect to the index page after logging out
header('Location: index.php');
exit;
?>