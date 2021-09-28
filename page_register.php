<?php 
    $conn = mysql_connect("localhost", "root", "") or die ("koneksi database gagal");
    mysql_select_db("nikahyuk") or die ("database tidak ada");

    $user = $email = $password = $id_login =  null;

    if(isset($_POST["register"])){
        $user=$_POST["username"];
        $email=$_POST["email"];
        $password=$_POST["password"];
        $status = 'customer';
        
        if(($user and $email and $password) != null){
            $query1="INSERT INTO login (Username,Password,Email_login,Status) VALUES ('".$user."','".$password."','".$email."','".$status."');";
            $sql_insert1 = mysql_query($query1,$conn);
        }else{
            echo "<script>alert('Ada data yang kosong')</script>";
        }

        $result=mysql_query("SELECT * FROM login WHERE Email_login LIKE '%$email%';",$conn);
        while ($row=mysql_fetch_array($result)){
            $id_login = $row["Id_login"];
        }

        if($id_login != null){
            $query2="INSERT INTO customer (Email_customer,id_login_custom) VALUES ('".$email."','".$id_login."');";
            $sql_insert2 = mysql_query($query2,$conn);
        }

        if($sql_insert1 and $sql_insert2){
            echo "<script>alert('Berhasil Membuat Akun')
                location.replace('index.php')</script>";
        }else{
            echo "<script>alert('Gagal Membuat Akun')</script>";
        }
    }

    

?>
body {
    .kotak img {
  -webkit-transition: 0.4s ease;
  transition: 0.4s ease;
  width: 700px;
}

.zoom-effect:hover .kotak img {
  -webkit-transform: scale(1.08);
  transform: scale(1.08);
}
}

<SCRIPT LANGUAGE="JavaScript">
<!-- 	
function controlCK(str) {	
	document.frm.register.disabled = !str;
}
//  End -->
</script>
<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register Nikah Yuk</title>
    <meta name="description" content="Register Nikah Yuk">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/logonikahIcon.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <link rel="stylesheet" type="text/css" href="styles/bootstrap-4.1.2/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" >

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
</head>
<body class="bg-dark">

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.php">
                        <img class="align-content" src="images/logonikahyuk.png" alt="" style="width:80%;hight:80%">
                    </a>
                </div>
                <div class="login-form">
                    <form method="POST" action="page_register.php" name="frm"> 
                        <div class="form-group">
                            <label>User Name</label>
                            <input type="text" class="form-control" name="username" placeholder="User Name" value="<?php $user; ?>">
                        </div>
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" class="form-control" name="email" placeholder="Email" value="<?php $email; ?>">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password" value="<?php $password; ?>">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="check" onClick="controlCK(this.checked)"> Agree the terms and policy
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30" name="register" disabled="true">Register</button>
                        <div class="register-link m-t-15 text-center">
                            <p>Already have account ? <a href="page_login.php"> Sign in</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>
</html>
