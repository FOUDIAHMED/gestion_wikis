<?php 
session_start();

include "db_connection.php";

if (isset($_POST['username']) && isset($_POST['password'])) {

    function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }

    $uname = validate($_POST['username']);
    $pass = validate($_POST['password']);

    if (empty($uname)) {
        header("Location: index.php?error=User Name is required");
        exit();
    } else if (empty($pass)) {
        header("Location: index.php?error=Password is required");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE username='$uname' AND mot_passe='$pass'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // Use mysqli_fetch_assoc to get an associative array
            $row = mysqli_fetch_assoc($result);

            if ($row && $row['username'] === $uname && $row['mot_passe'] === $pass ) {
				if( $row['ro_le']==='admin'){
					$_SESSION['uname']=$_POST['username'];
					$_SESSION['pass']=$_POST['password'];
					header("Location: admin.php");
                exit();
				}
				if( $row['valide']===1){
					$_SESSION['uname']=$_POST['username'];
					$_SESSION['pass']=$_POST['password'];
					header("Location: index.php?");
				}else{
					header("Location: signin.php?error=sakofaki");
				}
                
            } else {
                header("Location: signin.php?error=Incorrect User name or password");
                exit();
            }
        } else {
            // Handle database query error
            header("Location: signin.php?error=Database error");
            exit();
        }
    }
    
} else {
    header("Location: signin.php?error=yhydheydheydh");
    exit();
}
?>
