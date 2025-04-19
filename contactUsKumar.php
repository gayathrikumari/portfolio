<?php include 'header.php'; ?>

<div class="w3-container w3-padding-64 w3-pale-blue w3-grayscale-min" id="contact">
    <div class="w3-content" style="max-width:1100px">
        <h2 class="w3-center">Contact Us</h2>
        <p class="w3-center w3-large">Have questions? Reach out to our cybersecurity expert Dr. T</p>
        
        <div class="w3-row-padding" style="margin-top:64px">
            <div class="w3-half">
                <p><i class="fa fa-map-marker w3-xxlarge w3-text-blue"></i></p>
                <p>Denton, TX</p>
                <p><i class="fa fa-phone w3-xxlarge w3-text-blue"></i></p>
                <p>Phone</p>
                <p><i class="fa fa-envelope w3-xxlarge w3-text-blue"></i></p>
                <p>Email</p>
            </div>
            
            <div class="w3-half">
                <?php
                // Initialize variables
                $firstNameErr = $lastNameErr = $messageErr = $emailErr = "";
                $firstName = $lastName = $message = $email = "";
                $formSubmitted = false;
                
                // Form validation when submitted
                if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["submit"])) {
                    $formSubmitted = true;
                    
                    // Validate first name
                    if (empty($_GET["firstName"])) {
                        $firstNameErr = "First name is required";
                    } else {
                        $firstName = test_input($_GET["firstName"]);
                        // Check if name only contains letters and whitespace
                        if (!preg_match("/^[a-zA-Z ]*$/", $firstName)) {
                            $firstNameErr = "Only letters and white space allowed";
                        }
                    }
                    
                    // Validate last name
                    if (empty($_GET["lastName"])) {
                        $lastNameErr = "Last name is required";
                    } else {
                        $lastName = test_input($_GET["lastName"]);
                        // Check if name only contains letters and whitespace
                        if (!preg_match("/^[a-zA-Z ]*$/", $lastName)) {
                            $lastNameErr = "Only letters and white space allowed";
                        }
                    }
                    
                    // Validate message
                    if (empty($_GET["message"])) {
                        $messageErr = "Message is required";
                    } else {
                        $message = test_input($_GET["message"]);
                    }
                    
                    // Validate email
                    if (empty($_GET["email"])) {
                        $emailErr = "Email is required";
                    } else {
                        $email = test_input($_GET["email"]);
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
                
                <?php if ($formSubmitted && $firstNameErr == "" && $lastNameErr == "" && $messageErr == "" && $emailErr == ""): ?>
                    <!-- Display submitted information -->
                    <div class="w3-panel w3-pale-green w3-padding-16 w3-round-large">
                        <h3>Message Sent Successfully!</h3>
                        <p><strong>First Name:</strong> <?php echo $firstName; ?></p>
                        <p><strong>Last Name:</strong> <?php echo $lastName; ?></p>
                        <p><strong>Email:</strong> <?php echo $email; ?></p>
                        <p><strong>Message:</strong> <?php echo $message; ?></p>
                        <p>Thank you for contacting us! We will get back to you soon.</p>
                        <p><a href="contactUsKumar.php" class="w3-button w3-blue">Send Another Message</a></p>
                    </div>
                <?php else: ?>
                    <!-- Contact Form -->
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET" class="w3-container w3-card-4 w3-padding-16 w3-white w3-round-large">
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
                            <label><b>Email</b> <span class="w3-text-red">*</span></label>
                            <input class="w3-input w3-border" type="email" name="email" value="<?php echo $email; ?>" required>
                            <span class="w3-text-red"><?php echo $emailErr; ?></span>
                        </div>
                        <div class="w3-section">
                            <label><b>Message</b> <span class="w3-text-red">*</span></label>
                            <textarea class="w3-input w3-border" name="message" rows="4" required><?php echo $message; ?></textarea>
                            <span class="w3-text-red"><?php echo $messageErr; ?></span>
                        </div>
                        <button type="submit" name="submit" value="submit" class="w3-button w3-right w3-blue">Send Message</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
