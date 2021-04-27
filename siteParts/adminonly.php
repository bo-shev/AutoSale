<?

include_once 'usercheck.php';
$user = checkUser();

if ($user['role'] != 'admin')
{
    header('Location: http://salo0n/carsPage.php ');
}
?>