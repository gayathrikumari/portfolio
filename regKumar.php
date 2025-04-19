<?php include 'header.php'; ?>

<div class="w3-container w3-padding-64 w3-pale-blue w3-grayscale-min" id="register">
    <div class="w3-content" style="max-width:1100px">
        <h2 class="w3-center">Mailing List Registration</h2>
        <p class="w3-center w3-large">Join our mailing list to receive the latest cybersecurity updates</p>
        
        <div class="w3-row-padding" style="margin-top:64px">
            <div class="w3-half">
                <p><i class="fa fa-user-plus w3-xxlarge w3-text-blue"></i></p>
                <p>Stay informed about the latest cybersecurity threats and solutions.</p>
                <p><i class="fa fa-shield w3-xxlarge w3-text-blue"></i></p>
                <p>Receive tips and best practices to protect your digital assets.</p>
                <p><i class="fa fa-bell w3-xxlarge w3-text-blue"></i></p>
                <p>Get notifications about upcoming cybersecurity events and webinars.</p>
            </div>
            
            <div class="w3-half">
                <?php
                // Initialize variables
                $firstNameErr = $lastNameErr = $birthdayErr = $emailErr = "";
                $firstName = $lastName = $birthday = $email = "";
                $formSubmitted = false;
                
                // Form validation when submitted
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $formSubmitted = true;
                    
                    // Validate first name
                    if (empty($_POST["firstName"])) {
                        $firstNameErr = "First name is required";
                    } else {
                        $firstName = test_input($_POST["firstName"]);
                        // Check if name only contains letters and whitespace
                        if (!preg_match("/^[a-zA-Z ]*$/", $firstName)) {
                            $firstNameErr = "Only letters and white space allowed";
                        }
                    }
                    
                    // Validate last name
                    if (empty($_POST["lastName"])) {
                        $lastNameErr = "Last name is required";
                    } else {
                        $lastName = test_input($_POST["lastName"]);
                        // Check if name only contains letters and whitespace
                        if (!preg_match("/^[a-zA-Z ]*$/", $lastName)) {
                            $lastNameErr = "Only letters and white space allowed";
                        }
                    }
                    
                    // Validate birthday
                    if (empty($_POST["birthday"])) {
                        $birthdayErr = "Birthday is required";
                    } else {
                        $birthday = test_input($_POST["birthday"]);
                        // Check if birthday is a valid date
                        $date = DateTime::createFromFormat('Y-m-d', $birthday);
                        if (!$date || $date->format('Y-m-d') !== $birthday) {
                            $birthdayErr = "Invalid date format";
                        }
                    }
                    
                    // Validate email
                    if (empty($_POST["email"])) {
                        $emailErr = "Email is required";
                    } else {
                        $email = test_input($_POST["email"]);
                        // Check if email is valid
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $emailErr = "Invalid email format";
                        }
                    }
                }
                
                // Function to sanitize input data
                function test_input($data) {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }
                ?>
                
                <?php if ($formSubmitted && $firstNameErr == "" && $lastNameErr == "" && $birthdayErr == "" && $emailErr == ""): ?>
                    <!-- Display submitted information -->
                    <div class="w3-panel w3-pale-green w3-padding-16 w3-round-large">
                        <h3>Registration Successful!</h3>
                        <p><strong>First Name:</strong> <?php echo $firstName; ?></p>
                        <p><strong>Last Name:</strong> <?php echo $lastName; ?></p>
                        <p><strong>Birthday:</strong> <?php echo $birthday; ?></p>
                        <p><strong>Email:</strong> <?php echo $email; ?></p>
                        <p>Thank you for joining our mailing list!</p>
                        <p><a href="regKumar.php" class="w3-button w3-blue">Register Another</a></p>
                    </div>
                <?php else: ?>
                    <!-- Registration Form -->
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="w3-container w3-card-4 w3-padding-16 w3-white w3-round-large">
                        <div class="w3-section">
                            <label><b>First Name</b> <span class="w3-text-red">*</span></label>
                            <input class="w3-input w3-border" type="text" name="firstName" value="<?php echo $firstName; ?>" required>
                            <span class="w3-text-red"><?php echo $firstNameErr; ?></span>
                        </div>
                        <div class="w3-section">
                            <label><b>Last Name</b> <span class="w3-text-red">*</span></label>
                            <input class="w3-input w3-border" type="text" name="lastName" value="<?php echo $lastName; ?>" required>
                            <span class="w3-text-red"><?php echo $lastNameErr; ?></span>
                        </div>
                        <div class="w3-section">
                            <label><b>Birthday</b> <span class="w3-text-red">*</span></label>
                            <input class="w3-input w3-border" type="date" name="birthday" value="<?php echo $birthday; ?>" required>
                            <span class="w3-text-red"><?php echo $birthdayErr; ?></span>
                        </div>
                        <div class="w3-section">
                            <label><b>Email</b> <span class="w3-text-red">*</span></label>
                            <input class="w3-input w3-border" type="email" name="email" value="<?php echo $email; ?>" required>
                            <span class="w3-text-red"><?php echo $emailErr; ?></span>
                        </div>
                        <button type="submit" class="w3-button w3-right w3-blue">Register</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
