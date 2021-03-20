<?php
require_once '../load.php';
confirm_logged_in();

$id = $_SESSION['user_id'];
$current_user = getSingleUser($id);

if(empty($current_user)) {
    $message = 'Failed to get user info';
}

if (isset($_POST['submit'])){
    $data = array(
        'fname' => trim($_POST['fname']),
        'username' => trim($_POST['username']),
        'password' => trim($_POST['password']),
        'email' => trim($_POST['email']),
        'user_level' => isCurrentUserAdminAbove()?trim($_POST['user_level']):'0',
        'id' => $id,
    );
    $message = editUser($data);
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/main.css">
    <title>Edit User Panel</title>
</head>
<body>
<div>
            <div class="hero-home">
                <div class="logo">
                <a href="../index.html"><img src="../images/logo.png" alt=""></a>
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
    <div class="edit-info">
    <div class="edit-con">
            <h2>Edit User </h2>
            
            <?php if(!empty($current_user)): ?>
            <form action="admin_edituser.php" method="post" class="edit-form">
            <?php while($user_info = $current_user->fetch(PDO::FETCH_ASSOC)):?>
                    <label for="first_name">First Name</label>
                    <input id="first_name" type="text" name="fname" value="<?php echo $user_info['user_fname'];?>"><br><br>

                    <label for="username">Username</label>
                    <input id="username" type="text" name="username" value="<?php echo $user_info['user_name'];?>"><br><br>

                    <label for="password">Password</label>
                    <input id="password" type="text" name="password" value="<?php echo $user_info['user_pass'];?>"><br><br>

                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="<?php echo $user_info['user_email'];?>"><br><br>

                    <?php if(isCurrentUserAdminAbove()):?>
                        <label for="user_level">User Level</label>
                        <select id="user_level" name="user_level">
                            <?php $user_level_map = getUserLevelMap();
                                foreach ($user_level_map as $val => $label):?>
                            <option value="<?php echo $val;?>" <?php echo ($val === (int)$user_info['user_level'])? 'selected':'';?>><?php echo $label;?>
                            </option>
                            <?php endforeach;?>
                        </select><br><br>
                    <?php endif;?>

                    <button type="submit" name="submit">Update User</button>
                <?php endwhile;?>
            </form>
            <?php endif;?>
    </div>
    <div class="edit-pic"><img src="../images/user_edit.jpeg" alt=""></div>
    </div>
    <div class="mess-con"><?php echo !empty($message)?$message:'';?>
</body>
</html>