<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cybersecurity Portfolio - Kumar</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body, h1, h2, h3, h4, h5, h6 {
            font-family: "Roboto", sans-serif;
        }
        
        .w3-bar-block .w3-bar-item {
            padding: 16px;
        }

        .flashing-border {
            border: 2px solid #2196F3;
            animation: flash-border 1.5s infinite;
            }

            @keyframes flash-border {
            0%   { border-color: #2196F3; }
            25%  { border-color: #f44336; }
            50%  { border-color: #ffeb3b; }
            75%  { border-color: #4CAF50; }
            100% { border-color: #2196F3; }
            }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <div class="w3-top">
        <div class="w3-bar w3-blue w3-card w3-left-align w3-large">
            <!-- Toggle button for small screens -->
            <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-blue" href="javascript:void(0);" onclick="toggleNavigation()" title="Toggle Navigation Menu">
                <i class="fa fa-bars"></i>
            </a>
            <!-- Navigation links -->
            <a href="index.php" class="w3-bar-item w3-button w3-padding-large w3-hover-white">CV</a>
            <a href="regKumar.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Registration</a>
            <a href="contactUsKumar.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Contact Us</a>
            <a href="courseReflectKumar.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Course Reflection</a>
            <a href="cyberApplied1.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Hash Tool</a>
            <a href="cyberApplied2.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Encryption Tool</a>
            <a href="CyberInfor.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Cybersecurity Topic</a>
                <!-- Logo on the right -->
                <!-- Tribute section with flashing border -->
                <a href="drT.php">
                <div class="w3-right w3-padding-large w3-white" style="display:flex; align-items:center;">
                <div class="flashing-border" style="display:flex; align-items:center; padding:6px 12px; border-radius:8px;">
                    <span style="margin-right:10px; font-weight:bold; color:black;">Click here for a tribute to</span>
                    <img src="images/DrT.png" alt="Logo" style="height:30px;">
                </div>
                </div>
                </a>
            </div>
        </div>


        <!-- Navbar on small screens -->
        <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
            <a href="regKumar.php" class="w3-bar-item w3-button w3-padding-large">Registration</a>
            <a href="contactUsKumar.php" class="w3-bar-item w3-button w3-padding-large">Contact Us</a>
            <a href="courseReflectKumar.php" class="w3-bar-item w3-button w3-padding-large">Course Reflection</a>
            <a href="cyberApplied1.php" class="w3-bar-item w3-button w3-padding-large">Hash Tool</a>
            <a href="cyberApplied2.php" class="w3-bar-item w3-button w3-padding-large">Encryption Tool</a>
            <a href="CyberInfor.php" class="w3-bar-item w3-button w3-padding-large">Cybersecurity Topic</a>
        </div>
    </div>

    <!-- Header margin to prevent content from being hidden by the navigation bar -->
    <div class="w3-container" style="margin-top:80px"></div>

    <script>
        // Toggle between showing and hiding the navigation menu on small screens
        function toggleNavigation() {
            var x = document.getElementById("navDemo");
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
            } else { 
                x.className = x.className.replace(" w3-show", "");
            }
        }
    </script>
