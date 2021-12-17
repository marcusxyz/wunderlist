<?=

$message = $_SESSION['message'] ?? '';
$error = $_SESSION['error'] ?? '';

unset($_SESSION['message'], $_SESSION['error']);

?>
