<?php
    header("content-type:text/html;charset=utf-8");  //设置页面内容是html  编码是utf-8
    error_reporting(E_ALL &~ E_NOTICE);     //屏蔽错误信息
    $username=$_POST['username'];
    $password=$_POST['password'];
    $privilege=1;
    if ($username == "" || $password == "")
    {
		echo "<script>alert('输入格式错误');history.back();</script>";
    }
	else
    {
    // 	$_SESSION = array();
 	 	// if(isset($_COOKIE['PHPSESSID']))
 	 	// {
    // 	 	$commandd = "logout -u ".$_COOKIE['username'];
    //     	$socket = socket_create(AF_INET,SOCK_STREAM,SOL_TCP);
    //     	socket_connect($socket,'127.0.0.1',8888);
    //     	socket_write($socket, strlen($commandd).$commandd);
    //     	$res = socket_read($socket, 2048);
    //     	setcookie('PHPSESSID','',time()-3600);
    //  		setcookie('username','',time()-3600);
    //  		setcookie('privilege','',time()-3600);
    //  	}
        $commandd = "login -u $username -p $password";
        $socket = socket_create(AF_INET,SOCK_STREAM,SOL_TCP);
        socket_connect($socket,'123.57.252.230',8888);
        socket_write($socket, strlen($commandd).$commandd);
        $tmp_res = socket_read($socket, 204800);
        $res = substr($tmp_res, 6, substr($tmp_res, 0, 6));
        if ($res == "0")
        {
            ini_set('session.gc_maxlifetime', 3600);
            $expire = ini_get('session.gc_maxlifetime');
			// if (empty($_COOKIE['PHPSESSID']))
            // {
 				session_start();
                setcookie('PHPSESSID', session_id(), time() + $expire);
                setcookie('username', $username, time() + $expire);
                setcookie('privilege', $privilege, time() + $expire);
 			// }
 			// else
    //         {
 			// 	session_start();
 			// 	setcookie('PHPSESSID', session_id(), time() + $expire);
    //             setcookie('USERNAMEE', $username, time() + $expire);
    //             setcookie('PRIVILEGEE', $privilege, time() + $expire);
 			// }
 			if(isset($_SESSION['username']) && ($_SESSION['username'] == $username))
            {
 			 	exit("您已经登入了，请不要重新登入！用户名：".$_SESSION['username']."{$expire}");
 			}
            else
            {
 				$_SESSION['username'] = $username_cookie;
                $_SESSION['privilege'] = $privilege;
 			}
            echo "0";
        }
        else if($res == "-1")
        {
            echo "-1";
        }
        else
        {
            echo "-1";
        }

    }

?>
