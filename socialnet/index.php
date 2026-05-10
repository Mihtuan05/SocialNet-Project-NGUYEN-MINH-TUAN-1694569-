<?php include 'includes/db.php';
if(!isset($_SESSION['user'])) { header("Location: signin.php"); exit(); }
include 'includes/navbar.php';
$me = $_SESSION['user'];
?>
<div class="container">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-center p-4 rounded-4">
                <div class="bg-primary text-white rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center shadow" style="width:80px; height:80px; font-size:35px;">
                    <?php echo strtoupper($me['username'][0]); ?>
                </div>
                <h5 class="fw-bold mb-1"><?php echo $me['fullname']; ?></h5>
                <p class="text-muted small">@<?php echo $me['username']; ?></p>
                <hr>
                <a href="profile.php" class="btn btn-primary btn-sm w-100 rounded-pill">View My Profile</a>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow-sm border-0 p-4 rounded-4">
                <h4 class="fw-bold mb-4">Explore Community</h4>
                <div class="list-group list-group-flush">
                    <?php
                    $res = mysqli_query($conn, "SELECT username, fullname FROM account WHERE username != '".$me['username']."'");
                    while($row = mysqli_fetch_assoc($res)) {
                        echo "<div class='list-group-item d-flex justify-content-between align-items-center border-0 py-3 bg-light rounded-3 mb-2'>
                                <div><span class='fw-bold'>".$row['fullname']."</span><br><small class='text-muted'>@".$row['username']."</small></div>
                                <a href='profile.php?owner=".$row['username']."' class='btn btn-sm btn-dark rounded-pill px-3'>Visit Profile</a>
                              </div>";
                    }
                    if(mysqli_num_rows($res) == 0) echo "<p class='text-muted'>No other users found yet.</p>";
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
