<?php 


function login($username, $password, $ip, $current_time) {
    
    $pdo = Database::getInstance()->getConnection();

    #Finish the following query to check if the username and password are matching in the DB
    $get_user_query = 'SELECT * FROM tbl_user WHERE user_name= :username ';
    $user_set = $pdo->prepare($get_user_query);
    $user_set->execute(
        array(
            ':username'=>$username
           
            )
        );

        if($found_user = $user_set->fetch(PDO::FETCH_ASSOC)) {
            // we found user in the DB, get him in!
            $found_user_id = $found_user['user_id'];
            $pass = $found_user['user_pass'];//fetch user_pass from database
            $login_success = $found_user['user_success'];//fetch user_pass from database
            $user_new = $found_user['user_new'];

            //suspend user
            $user_time_start = $found_user['user_date'];
            $time_left = strtotime($current_time) - strtotime($user_time_start);
            $time_count = 44000 - $time_left;

            //fetch user_attempts from database
            $attempts = $found_user['user_attempts'];
                    //if the attempts >= then account will lock it
                    if($attempts >= 3) {
                        return "Your account was locked.Please contact to the administartor.";
                    } 
                    //strcmp — Binary safe string comparison
                    //compare the password
                    if(strcmp($password, $pass) === 0 && $user_new === "O") {
                    //write username and userid into session
                    $_SESSION['user_id'] = $found_user_id;
                    $_SESSION['user_name'] = $found_user['user_fname'];
                    $_SESSION['user_level'] = $found_user['user_level'];
                    $user_new = $found_user['user_new'];
                    //last login time
                    $last_login = $found_user['user_current_login'];//fetch user_current_login from the database
                    $_SESSION['last_login'] = $last_login;//write it into session

                    //count the number login if it success
                    $login_success = $login_success + 1;

                    $update_user_query = 'UPDATE tbl_user SET user_ip= :user_ip, user_current_login= :current_time, user_last_login= :lastlogin, user_attempts= :userattempts, user_success= :success WHERE user_id= :user_id';
                    $update_user_set = $pdo->prepare($update_user_query);
                    $update_user_set->execute(
                        array(
                            ':user_ip'=>$ip,
                            ':user_id'=>$found_user_id,
                            ':current_time'=>$current_time,
                            ':lastlogin'=>$last_login,
                            ':userattempts'=>"0",
                            ':success'=>$login_success
                            
                        )
                    );
                    
                redirect_to('index.php');
            }  if (strcmp($password, $pass) === 0 && $user_new === "N"){
                if ($time_count <= 0) {
                    $update_user_suspend = 'UPDATE tbl_user SET user_suspended=:suspended WHERE user_name= :username';
                    $user_suspend_set = $pdo->prepare($update_user_suspend);
                    $user_suspend_set->execute(
                        array(
                            ':username'=>$username,
                            ':suspended'=>"SUSPENDED"
                        )
                        );
                        return 'Your account was suspended.';
            } else {
                $_SESSION['user_id'] = $found_user_id;
                $_SESSION['user_name'] = $found_user['user_fname'];
                $_SESSION['user_level'] = $found_user['user_level'];
                $last_login = $found_user['user_current_login'];
                $_SESSION['last_login'] = $last_login;
                $user_new = $found_user['user_new'];
                $update_user_query = 'UPDATE tbl_user SET user_ip= :user_ip, user_current_login= :current_time, user_last_login= :lastlogin, user_attempts= :userattempts, user_success= :success WHERE user_id= :user_id';
                $update_user_set = $pdo->prepare($update_user_query);
                $update_user_set->execute(
                        array(
                            ':user_ip'=>$ip,
                            ':user_id'=>$found_user_id,
                            ':current_time'=>$current_time,
                            ':lastlogin'=>$last_login,
                            ':userattempts'=>"0",
                            ':success'=>$login_success
                            
                        )
                    );
                    redirect_to('admin_edituser.php');  
                }

            } else if (strcmp($password, $pass) !== 0) {
                //do the attempts until 3
                $another_attempts = $attempts + 1;
                $left_attempts = 3 - $another_attempts;
                $update_user_attempt = 'UPDATE tbl_user SET user_ip= :user_ip, user_attempts= :anotherattempts WHERE user_id= :user_id';
                $update_attempt_set = $pdo->prepare($update_user_attempt);
                $update_attempt_set->execute(
                    array(
                        ':user_ip'=>$ip,
                        ':user_id'=>$found_user_id,
                        ':anotherattempts'=>$another_attempts
                    )
                    );
                    return 'Wrong password, you still have '.$left_attempts.' more attempts to try again.';

            } else {
                return 'Your account was locked due to 3 attempts failed. Please contact to the administrator.';
            }
        }


       } 


       function confirm_logged_in($admin_above_only=false) {
        if (!isset($_SESSION['user_id'])) {

            redirect_to('admin_login.php');
        }
        if(!empty($admin_above_only) && empty($_SESSION['user_level'])){
            redirect_to('index.php');
        }
    }

    function logout() {
        session_destroy();
        redirect_to('admin_login.php');
    }

?>
