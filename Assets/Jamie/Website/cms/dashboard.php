<?php

error_reporting(E_ALL);

 //includes login script
 include( 'functions.php' );

 //checks to see if user is logged in
 checkLogin();

 updateProfile();

 addSlide();

 addBlog();

 deleteBlog();

 editBlog();

 updateBlog();

 deleteSlide();

 editSlide();

 updateSlide();

 //echo var_dump($_POST);die;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Retro Gecko Dashboard</title>
    <link rel="apple-touch-icon" sizes="180x180" href="../images/fav/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../images/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/fav/favicon-16x16.png">
    <link rel="manifest" href="../images/fav/site.webmanifest">
    <link rel="mask-icon" href="../images/fav/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#00a300">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/css/swiper.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/brands.css" integrity="sha384-n9+6/aSqa9lBidZMRCQHTHKJscPq6NW4pCQBiMmHdUCvPN8ZOg2zJJTkC7WIezWv" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/fontawesome.css" integrity="sha384-vd1e11sR28tEK9YANUtpIOdjGW14pS87bUBuOIoBILVWLFnS+MCX9T6MMf0VdPGq" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="/font/customfonts.css">
    <link rel="stylesheet" href="css/dashboard.css">
</head>

<body class="base">

    <div id="wrapper">

        <nav class="navbar navbar-default navbar-static-top panel p-bot text-white fixed-top">
            <h3><span class="rwthin pl-3 ">RETRO</span><span class="sym">GECKO</span></h3>

            <div class="float-right">
                <a href="logout.php" class="mr-2">Logout <i class="fas fa-sign-out-alt"></i></a>
                <a href="/">Back <i class="fas fa-arrow-left"></i> </a>
            </div>
            
        </nav>

        <div id="sidenav" class="panel p-right">

            <div class="profilePic mb-5">

                <div class="row">
                    <div class="d-inline-flex ml-5 mt-5">
                        <div class="pro-img" style="background-image:url('<?php echo $_SESSION[ 'pic' ]?>');"></div>
                        <div class="div ml-3 mt-2">
                            <h5 class="light-text sym" style="max-width:170px;"><?php echo $_SESSION[ 'name' ] ?></h5>
                            <p class="hi-text"><?php echo $_SESSION[ 'rank' ] ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <a class="a-link" href="dashboard.php?page=profile">
                <div class="profile nav-btn d-flex justify-content-left align-items-center">
                    <div class="item ml-3"><i class="fas fa-home"></i></div>
                    <div class="item vr ml-3"></div>
                    <p class="ml-3">Home</p>
                </div>
            </a>
            <a class="a-link" href="dashboard.php?page=slideshow">
                <div class="slideshow nav-btn d-flex justify-content-left align-items-center">
                    <div class="item ml-3"><i class="fas fa-image"></i></div>
                    <div class="item vr ml-3"></div>
                    <p class="ml-3">Slideshow</p>
                </div>
            </a>
            <a class="a-link" href="dashboard.php?page=blog">
                <div class="blog nav-btn d-flex justify-content-left align-items-center">
                    <div class="item ml-3"><i class="fas fa-font"></i></div>
                    <div class="item vr ml-3"></div>
                    <p class="ml-3">Blog</p>
                </div>
            </a>

            <a class="a-link" href="/cpanel" target="_blank">
                <div class="nav-btn d-flex justify-content-left align-items-center">
                    <div class="item ml-3"><i class="fab fa-cpanel"></i></div>
                    <div class="item vr ml-3"></div>
                    <p class="ml-3">cPanel</p>
                </div>
            </a>
            
            <a class="a-link" href="http://ct.glos.ac.uk/jira" target="_blank">
                <div class="nav-btn d-flex justify-content-left align-items-center">
                    <div class="item ml-3"><i class="fab fa-jira"></i></div>
                    <div class="item vr ml-3"></div>
                    <p class="ml-3">Jira</p>
                </div>
            </a>
            <a class="a-link" href="http://ct.glos.ac.uk/confluence" target="_blank">
                <div class="nav-btn d-flex justify-content-left align-items-center">
                    <div class="item ml-3"><i class="fab fa-confluence"></i></div>
                    <div class="item vr ml-3"></div>
                    <p class="ml-3">Confluence</p>
                </div>
            </a>
            <a href="#" style="font-size: 32pt;" id="close-btn" class="item light-text fixed-bottom">
                <i class=" fas fa-caret-left float-right pr-3"></i>
            </a>

        </div>

        <div id="smallnav" class="panel p-right">

            <div class="profile mb-5 mt-2">
            <div class="pro-img-small" style="background-image:url('<?php echo $_SESSION[ 'pic' ]?>');"></div>
            </div>
            <a class="a-link" href="dashboard.php?page=profile">
                <div class="profile nav-btn d-flex justify-content-left align-items-center">
                    <div class="item ml-3"><i class="fas fa-home"></i></div>
                </div>
            </a>
            <a class="a-link" href="dashboard.php?page=slideshow">
                <div class="slideshow nav-btn d-flex justify-content-left align-items-center">
                    <div class="item ml-3"><i class="fas fa-image"></i></div>
                </div>
            </a>
            <a class="a-link" href="dashboard.php?page=blog">
                <div class="blog nav-btn d-flex justify-content-left align-items-center">
                    <div class="item ml-3"><i class="fas fa-font"></i></div>
                </div>
            </a>
            <a class="a-link" href="/cpanel" target="_blank">
                <div class="nav-btn d-flex justify-content-left align-items-center">
                    <div class="item ml-3"><i class="fab fa-cpanel"></i></div>
                </div>
            </a>
            <a class="a-link" href="http://ct.glos.ac.uk/jira" target="_blank">
                <div class="nav-btn d-flex justify-content-left align-items-center">
                    <div class="item ml-3"><i class="fab fa-jira"></i></div>
                </div>
            </a> 
            <a class="a-link" href="http://ct.glos.ac.uk/confluence" target="_blank">
                <div class="nav-btn d-flex justify-content-left align-items-center">
                    <div class="item ml-3"><i class="fab fa-confluence"></i></div>
                </div>
            </a>
            <a href="#" style="font-size: 32pt;" id="open-btn" class="item light-text fixed-bottom">
                <i class=" fas fa-caret-right float-right pr-3"></i>
            </a>

        </div>
        <!-- Content rendered here through Ajax -->
        <div id="content-panel">
            
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/js/swiper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
    <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>

</body>

</html>