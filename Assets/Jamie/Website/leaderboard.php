<?php

//includes login script
include( 'binary/functions.php' );

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Retro Gecko</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/images/fav/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/fav/favicon-16x16.png">
    <link rel="manifest" href="/images/fav/site.webmanifest">
    <link rel="mask-icon" href="/images/fav/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#00a300">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/css/swiper.min.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:200,900" rel="stylesheet">
    <link rel="stylesheet" href="owl/owl.carousel.min.css">
    <link rel="stylesheet" href="owl/owl.theme.default.min.css">
    <link rel="stylesheet" href="font/customfonts.css">
    <link rel="stylesheet" href="css/main.css">

    <style>

    </style>
</head>

<body>
    <div id="wrapper">
        <!--Navigation-->

        <nav id="navbar" class="navbar navbar-expand-lg navbar-dark bg-dark ">
            <a id="brandtitle" class="navbar-brand" href="#"><span class="rwthin pl-3">RETRO</span><span
                    class="sym">GECKO</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end pr-3" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="blog.php">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="leaderboard.php">Leaderboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/cms">Sign in</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!--End Navigation-->

        <!--Landing Space-->
        <div id="space" class="home-space">
            <div class="container text-white">
                <div class="row">
                    <h1 class="col-9">Leaderboard</h1>
                    <ul class="filter col-3">
                        <li><a href="#" class="item filtertext">Filter <i class="fa fas-chevron-down"></i></a>
                            <span class="accent"></span>
                            <ul class="drop-down">
                                <li><a href="?f=Most+Wins">Most Wins</a></li>
                                <li><a href="?f=Games+Played">Games Played</a></li>
                                <li><a href="?f=Hacker+Wins">Hacker Wins</a></li>
                                <li><a href="?f=Merc+Wins">Merc Wins</a></li>
                                <li><a href="?f=Steps+Taken">Steps Taken</a></li>
                                <li><a href="?f=Shots+Fired">Shots Fired</a></li>
                                <li><a href="?f=Abilities+Used">Abilities Used</a></li>
                                <li><a href="?f=Points+Captured">Points Captured</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <hr>
                <?php
                    leaderBoard();
                ?>
                <!-- <div class="player player1">
                    <div class="row">
                        <div class="col-3">#1</div>
                        <div class="col-6">Jamiee</div>
                        <div class="col-3  ta-r">100</div>
                    </div>
                </div>
                <hr>
                <div class="player player2">
                    <div class="row">
                        <div class="col-3">#2</div>
                        <div class="col-6">James</div>
                        <div class="col-3  ta-r">96</div>
                    </div>
                </div>
                <hr>
                <div class="player player3">
                    <div class="row">
                        <div class="col-3">#3</div>
                        <div class="col-6">Ian</div>
                        <div class="col-3  ta-r">76</div>
                    </div>
                </div>
                <hr>
                <div class="player">
                    <div class="row">
                        <div class="col-3">#4</div>
                        <div class="col-6">Jess</div>
                        <div class="col-3  ta-r">54</div>
                    </div>
                </div>
                <hr>
                <div class="player">
                    <div class="row">
                        <div class="col-3">#5</div>
                        <div class="col-6">Chewy</div>
                        <div class="col-3  ta-r">32</div>
                    </div>
                </div>
                <hr style="padding-top:25px;"> -->


            </div>
        </div>
        <!--End-->
    </div>
    <footer class="footer">
        <p class="highlight">&copy Retro Gecko 2019, all rights reserved</p>
    </footer>

    </div>
    <!-- threejs.org canvas lines example -->
    <script src="
                https://cdnjs.cloudflare.com/ajax/libs/three.js/r67/three.min.js">
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/js/swiper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
    </script>
    <script src="owl/owl.carousel.min.js"></script>
    <script src="js/particle-background.js"></script>
    <script src="js/main.js"></script>
    <script>
        $(document).ready(function () {
            var url_string = window.location.href;
            var url = new URL(url_string);
            var page = url.searchParams.get("f");

            if (page != null) {
                console.log(page);
                $(".filtertext").text(page);
            } else {
                location.href = '?f=Most+Wins';
            }
        });

        $(".filter").mouseover(function () {

            $(this).find(".drop-down").dequeue().stop().slideDown(300);
            $(this).find(".accent").addClass("animate");
            $(this).find(".item").css("color", "#19a333");
        }).mouseleave(function () {

            $(this).find(".drop-down").dequeue().stop().slideUp(300);
            $(this).find(".accent").removeClass("animate");
            $(this).find(".item").css("color", "rgba(255,255,255,.5");
        });
    </script>
</body>

</html>