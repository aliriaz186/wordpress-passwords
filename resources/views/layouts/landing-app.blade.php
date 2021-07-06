<!doctype html>
<html lang="en">


<!-- Mirrored from appscred.com/html/saasly/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Apr 2021 10:48:32 GMT -->
<head>

    <!--====== Required meta tags ======-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <!--====== Title ======-->
    <title>{{env('APP_NAME')}}</title>

    <!--====== Favicon Icon ======-->
    {{-- <link rel="shortcut icon" href="{{url('')}}/assets/images/logo.png" type="image/png"> --}}

    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="{{url('')}}/assets/css/bootstrap.min.css">

    <!--====== Fontawesome css ======-->
    <link rel="stylesheet" href="{{url('')}}/assets/css/font-awesome.min.css">

    <!--====== magnific popup css ======-->
    <link rel="stylesheet" href="{{url('')}}/assets/css/magnific-popup.css">

    <!--====== Slick css ======-->
    <link rel="stylesheet" href="{{url('')}}/assets/css/slick.css">

    <!--====== animation css ======-->
    <link rel="stylesheet" href="{{url('')}}/assets/css/animate.min.css">

    <!--====== custom animation css ======-->
    <link rel="stylesheet" href="{{url('')}}/assets/css/custom-animation.css">

    <!--====== Default css ======-->
    <link rel="stylesheet" href="{{url('')}}/assets/css/default.css">

    <!--====== Style css ======-->
    <link rel="stylesheet" href="{{url('')}}/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--====== jquery js ======-->
    <script src="{{url('')}}/assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="{{url('')}}/assets/js/vendor/jquery-1.12.4.min.js"></script>

    <!--====== Bootstrap js ======-->
    <script src="{{url('')}}/assets/js/bootstrap.min.js"></script>
    <script src="{{url('')}}/assets/js/popper.min.js"></script>

    <!--====== magnific popup js ======-->
    <script src="{{url('')}}/assets/js/jquery.magnific-popup.min.js"></script>

    <!--====== wow js ======-->
    <script src="{{url('')}}/assets/js/wow.js"></script>

    <!--====== Slick js ======-->
    <script src="{{url('')}}/assets/js/slick.min.js"></script>

    <!--====== counterup js ======-->
    <script src="{{url('')}}/assets/js/jquery.counterup.min.js"></script>
    <script src="{{url('')}}/assets/js/waypoints.min.js"></script>

    <!--====== Main js ======-->
    <script src="{{url('')}}/assets/js/main.js"></script>
    <script type="text/javascript" src="https://cdn.ywxi.net/js/1.js" async></script>
    <style>
        .blackcolorlink {
            color: black !important;
        }

        .activenavlink {
            border-bottom: 2px solid;
        }

        hr.new5 {
            border: 2px solid #6b9ce8;
            /*border-radius: 5px;*/
        }

        .facustom {
            padding: 10px;
            font-size: 20px;
            width: 40px;
            text-align: center;
            text-decoration: none;
            margin: 5px 2px;
            border-radius: 50%;
        }

        .facustom:hover {
            opacity: 0.7;
            color: white;
        }

        .fa-facebook {
            background: #3B5998;
            color: white;
        }

        .fa-patreon {
            background: #f96854;
            color: white;
        }

        .fa-instagram {
            background: #3f729b;
            color: white;
        }

        .fa-twitter {
            background: #55ACEE;
            color: white;
        }

        /*Cookie Consent Begin*/
        #cookieConsent {
            background-color: rgba(20,20,20,0.8);
            min-height: 26px;
            font-size: 14px;
            color: #ccc;
            line-height: 26px;
            padding: 20px;
            font-family: "Trebuchet MS",Helvetica,sans-serif;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            display: none;
            z-index: 9999;
        }
        #cookieConsent a {
            color: #4B8EE7;
            text-decoration: none;
        }
        #closeCookieConsent {
            float: right;
            display: inline-block;
            cursor: pointer;
            height: 20px;
            width: 20px;
            margin: -15px 0 0 0;
            font-weight: bold;
        }
        #closeCookieConsent:hover {
            color: #FFF;
        }
        #cookieConsent a.cookieConsentOK {
            background-color: #6b9ce8;
            color: white;
            display: inline-block;
            border-radius: 5px;
            padding: 0 20px;
            cursor: pointer;
            float: right;
            margin: 0 60px 0 10px;
        }
        #cookieConsent a.cookieConsentOK:hover {
            background-color: #6b9ce8;
        }
        /*Cookie Consent End*/

        .dropdown:hover .dropdown-menu{
            display: block;
        }
        .dropdown-menu{
            margin-top: 0;
        }
        .onlyonmobile{
            display: none;
        }
        .ftlinksresp{
            margin-top: 140px!important;
            max-width: 180px;
        }

        .ftlinksresp2{
            margin-top: 120px;
        }

        .ftlinksresp3{
            padding: 2px;
        }

        @media screen and (max-width: 600px) {
            .onlyonmobile{
                display: inline;
            }
            .ftlinksresp{
                margin-top: 10px!important;
                max-width: 389px;
            }
            .ftlinksresp2{
                margin-top: 10px;
            }
            .ftlinksresp3{
                padding: 2px;
               padding-left: 53px;
            }
            .mgleft5{
                margin-left: 50px;
            }
            .mgtop5{
                margin-top: 30px;
            }
        }
        @media screen and (max-width: 450px) {
            .ftlinksresp{
                margin-top: 10px!important;
                max-width: 200px;
            }
        }
    </style>

</head>

<body>

<div class="preloader" id="preloader">
    <div class="three ">
        <div class="loader" id="loader">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</div>



<!--====== HEADER PART ENDS ======-->
@yield('content')
<!--====== FOOTER PART START ======-->






<!--====== FOOTER PART ENDS ======-->

<!--====== BACK TO TOP START ======-->

<a class="back-to-top" style="display: none;opacity: 0">
    <i class="fal fa-angle-up"></i>
</a>

<!--====== BACK TO TOP ENDS ======-->


</body>


</html>

