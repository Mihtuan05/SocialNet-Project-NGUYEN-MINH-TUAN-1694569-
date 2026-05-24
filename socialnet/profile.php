<?php include 'includes/db.php';
if(!isset($_SESSION['user'])) { header("Location: signin.php"); exit(); }
include 'includes/navbar.php';

// VÁ LỖI: Lọc sạch tham số URL chống SQL Injection
$owner_un = isset($_GET['owner']) ? mysqli_real_escape_string($conn, $_GET['owner']) : $_SESSION['user']['username'];

$res = mysqli_query($conn, "SELECT * FROM account WHERE username='$owner_un'");
$u = mysqli_fetch_assoc($res);

if(!$u) { echo "<div class='container'><div class='alert alert-danger'>User not found!</div></div>"; exit(); }
?>
<div class="container">
    <div class="card shadow-sm border-0 overflow-hidden rounded-4 bg-white">
        <div class="bg-dark p-5 text-center text-white">
            <h2 class="fw-bold mb-0"><?php echo htmlspecialchars($u['fullname']); ?>'s Profile</h2>
            <p class="text-info">Secure Mode Enabled</p>
        </div>
        <div class="card-body p-5">
            <div class="row mb-4">
                <div class="col-sm-6 border-end">
                    <p class="text-muted small fw-bold mb-1 text-uppercase">Username</p>
                    <p class="h5">@<?php echo htmlspecialchars($u['username']); ?></p>
                </div>
                <div class="col-sm-6 ps-4">
                    <p class="text-muted small fw-bold mb-1 text-uppercase">Student ID (MSSV)</p>
                    <p class="h5"><?php echo htmlspecialchars($u['mssv']) ?: 'N/A'; ?></p>
                </div>
            </div>
            <div class="mt-5 pt-4 border-top">
                <h5 class="fw-bold mb-3">About Me</h5>
                <div class="p-4 bg-light rounded-3 lead">
                    <?php echo nl2br(htmlspecialchars($u['description'] ?: "No bio description available.")); ?>
                </div>
            </div>
        </div>
    </div>
</div>
