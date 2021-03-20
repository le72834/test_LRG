<?php
require_once '../load.php';
confirm_logged_in(true);

if(isset($_GET['id'])){
    $delete_user_id = $_GET['id'];

    $delete_result = deleteUser($delete_user_id);

    if(!$delete_result){
        $message = 'Failed to delete user';
    }
}


$users = getAllUsers();

if(!$users){
    $message = 'Failed to get user list';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/main.css">
    <title>Delete User</title>
</head>
<body>

<div>
            <div class="hero-home">
                <div class="logo">
                    <img src="../images/logo.png" alt="">
                </div>
                <nav>
                    <ul class="nav-links">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="about.html">About</a></li>
                        <div class="dropdown">
                            <button class="dropbtn">Programs</button>
                            <div class="dropdown-content">
                              <a href="#">Junior Mentorship Program</a>
                              <a href="#">Membership Program</a>
                              <a href="#">Careers</a>
                            </div>
                        </div> 
                        <!-- <li><a href="#">Refree</a></li>
                        <li><a href="#">Membership</a></li> -->
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </nav>
                <div class="ref-button">
                    
                    <div class="ham-burger">
                        <i class="bars icon"></i>
                    </div>
                </div>
            </div>
           
               
            
</div>
<div class="delete-con">
        <h2>Delete User Panel</h2>
        <?php echo !empty($message) ? $message : ''; ?>

        <a href="index.php" class="delete-back">Back to Dashboard</a>


        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <tbody>
                <?php while($single_user = $users->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo $single_user['user_id'];?></td>
                    <td><?php echo $single_user['user_name'];?></td>
                    <td><?php echo $single_user['user_email'];?></td>
                    <td>
                        <a href="admin_deleteuser.php?id=<?php echo $single_user['user_id'];?>">Delete</a>
                    </td>
                </tr>
                <?php endwhile;?>
            </tbody>
        </table>
</div>
</body>
</html>