<?php include 'includes/db.php'; if(!isset($_SESSION['user'])) header("Location: signin.php");
include 'includes/navbar.php'; $un = $_SESSION['user']['username'];
if(issetPOST['save'])){
    $desc = $_POST['desc'];
    $mssv = $_POST['mssv'];
    mysqli_query($conn, "UPDATE account SET description='$desc', mssv='$mssv' WHERE username='$un'");
    echo "<div class='container'><div class='alert alert-danger'>Profile Forced Update!</div></div>";
}
$u = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM account WHERE username='$un'")); ?>
<div class="container"><div class="card shadow-sm border-0 mx-auto" style="max-width: 550px;"><div class="card-body p-5">
    <h3 class="fw-bold mb-4 text-danger">Edit Profile (Vulnerable)</h3>
    <form method="POST">
        <label class="small fw-bold">STUDENT ID (MSSV)</label>
        <input name="mssv" class="form-control mb-4" value="<?php echo htmlspecialchars($u['mssv']); ?>">
        <label class="small fw-bold">BIO / DESCRIPTION</label>
        <textarea name="desc" class="form-control mb-4" rows="4"><?php echo htmlspecialchars($u['description']); ?></textarea>
        <button name="save" class="btn btn-danger w-100 fw-bold">Save Changes</button>
    </form>
</div></div></div>
