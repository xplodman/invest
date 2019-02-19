<!-- php login script -->
<!-- ============================================================== -->
<?php
include_once "connection.php";

    $username = $_POST['username'];
    $username = mysqli_real_escape_string($con, $username);

    $password = $_POST['password'];
    $password = mysqli_real_escape_string($con, $password);

    $result = mysqli_query($con, "SELECT
  users.id,
  users.nickname,
  role.id AS role_id,
  role.name AS role_name
FROM
  users
  INNER JOIN role ON users.role_id = role.id
Where users.username = '$username' And users.password = '$password'")or die(mysqli_error($con));
    if (mysqli_num_rows($result) != 0) {

        $row = mysqli_fetch_assoc($result);


        $_SESSION['cj_investigation']['timestamp'] = time();
        $_SESSION['cj_investigation']['authenticate'] = "true";
        $_SESSION['cj_investigation']['id'] = $row['id'];
        $_SESSION['cj_investigation']['role_id'] = $row['role_id'];
        $_SESSION['cj_investigation']['job'] = $row['role_name'];
        $_SESSION['cj_investigation']['nickname'] = $row['nickname'];
        if($row['role_id']>5 & $row['role_id']<9){
            header('Location: ../overall_pros/index.php');
            exit;
        }elseif($row['role_id']>9){
            header('Location: ../appeal_pros/index.php');
            exit;
        }else{
            header('Location: ../index.php');
            exit;
        }

    } else {
        header('Location: ../login.php?backresult=0');
        $_SESSION['cj_investigation']['username'] = $username;
        exit;
    }
?>
<!-- ============================================================== -->
<!-- end php login script -->