<?php
session_start();
if((!isset($_SESSION['login'])) || (!isset($_SESSION['uid']))){
    
?>
	<script>
    window.location="login.php"    </script>
    <?php
}
else{
     
    $id=$_SESSION['uid'];
     $email=$_SESSION['login'];  
    include_once('includes/class.Member.php');
    $objMember		= 	new Member();  	  
    $res    =   $objMember->getMEmberProfile($id);
    $member_NAme    =  $res['first_name'].$res['last_name'];
   //print_r($res);exit;
}
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCST</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/user-style.css">
</head>

<body>
    <section class="min-vh-100 p-3 dark-blue-bg">
        <div class="container-fluid p-0">
            <div class="row g-3">
                <div class="col-lg-3 dash-sidebar">
                    <div class="orange-bg rounded-2 d-flex flex-column align-items-center p-4 sidebar-container">
                        <div
                            class="d-flex flex-lg-column flex-sm-row flex-column align-items-center justify-content-between w-100">
                            <div class="mb-3 d-flex flex-lg-column align-items-center">
                                <div class="img-wrp text-center mb-2">
                                    <img src="images/avatar-new.png" alt="" class="rounded-circle">
                                </div>
                                <div class="d-flex flex-column align-items-lg-center p-3">
                                    <strong class="white-text"><?php echo $member_NAme; ?></strong>
                                    <span class="white-text small"><?php echo $email; ?></span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-center">
                                <button type="button"
                                    class="btn border-2 rounded-pill logout-btn py-1 text-uppercase mb-3" onclick="myfunction()">Logout</button>
                            </div>
                        </div>
                        <ul class="list-group w-100">
                            <li class="dropdown list-group-item list-group-item-action bg-transparent border-0 py-1">
                                <button class="btn btn-secondary border-0 btn-light dropdown-toggle w-100 justify-content-between" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Posts
                                </button>
                                <ul class="dropdown-menu bg-transparent border-0 position-static">
                                    <li class="dark-blue-bg"><a class="dropdown-item active" href="user-dashboard.php">All Posts</a></li>
                                    <li><a class="dropdown-item" href="my-posts.php">My Posts</a></li>
                                    <li><a class="dropdown-item" href="new-post.php">Add Post</a></li>
                                </ul>
                            </li>
                            <li class="dropdown list-group-item list-group-item-action bg-transparent border-0 py-1">
                                <a href="profile-settings.php" class="btn btn-secondary border-0 btn-light justify-content-between">Settings</a>
                            </li>
                        </ul>
                    </div>
                </div>