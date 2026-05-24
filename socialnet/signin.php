<?php include 'includes/db.php';
if(isset($_POST['login'])){
    $un = $_POST['un']; 
    $pw = $_POST['pw'];
    $sql = "SELECT * FROM account WHERE username='$un'";
    $res = mysqli_query($conn, $sql);
    $u = mysqli_fetch_assoc($res);
    if($u && $pw === $u['password']){
        $_SESSION['user'] = $u; 
        header("Location: index.php"); 
        exit();
    } else { 
        $err = "Wrong username or password!"; 
    }
} ?>
<div class="container vh-100 d-flex align-items-center justify-content-center">
    <div class="card shadow border-0" style="width: 380px;"><div class="card-body p-5 text-center">
        <h2 class="fw-bold mb-4">Sign In (Vulnerable Version)</h2>
        <?php if(isset($err)) echo "<div class='alert alert-danger'>$err</div>"; ?>
        <form method="POST">
            <input name="un" class="form-control mb-3" placeholder="Username" required>
            <input type="password" name="pw" class="form-control mb-3" placeholder="Password" required>
            <button name="login" class="btn btn-danger w-100 fw-bold">Sign In</button>
        </form>
    </div></div>
</div>
