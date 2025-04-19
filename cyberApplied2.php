<?php include 'header.php'; ?>

<div class="w3-container w3-padding-64 w3-light-grey">
    <div class="w3-content" style="max-width:1100px">
        <h2 class="w3-center">Encryption & Decryption Tool</h2>
        <p class="w3-center w3-large">Securely encrypt and decrypt messages using PHP</p>
        
        <div class="w3-row-padding" style="margin-top:64px">
            <div class="w3-half">
                <div class="w3-card w3-white w3-padding-16">
                    <div class="w3-container">
                        <h3>About Encryption</h3>
                        <p>Unlike hashing, encryption is a two-way process that allows data to be encrypted and later decrypted back to its original form with the proper key. Encryption is essential for:</p>
                        
                        <ul class="w3-ul">
                            <li><strong>Data Confidentiality:</strong> Protecting sensitive information from unauthorized access.</li>
                            <li><strong>Secure Communications:</strong> Enabling private communication over insecure channels.</li>
                            <li><strong>Data Protection:</strong> Safeguarding stored data from potential breaches.</li>
                            <li><strong>Compliance:</strong> Meeting regulatory requirements for data protection.</li>
                        </ul>
                        
                        <p>This tool uses OpenSSL for encryption with the following features:</p>
                        <ul class="w3-ul">
                            <li><strong>AES-256-CBC:</strong> Advanced Encryption Standard with 256-bit key length in Cipher Block Chaining mode.</li>
                            <li><strong>Initialization Vector (IV):</strong> A random value used to ensure that identical plaintext encrypts to different ciphertext.</li>
                            <li><strong>Password-based Key:</strong> The encryption key is derived from your password.</li>
                        </ul>
                        
                        <p class="w3-text-red"><strong>Important Security Note:</strong> For real-world applications, never store encryption keys in your code or database. Use secure key management systems and follow best practices for key rotation and storage.</p>
                    </div>
                </div>
            </div>
            
            <div class="w3-half">
                <?php
                // Initialize variables
                $action = $text = $password = $result = "";
                $actionErr = $textErr = $passwordErr = $resultErr = "";
                $formSubmitted = false;
                
                // Form validation when submitted
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $formSubmitted = true;
                    
                    // Validate action
                    if (empty($_POST["action"])) {
                        $actionErr = "Action selection is required";
                    } else {
                        $action = test_input($_POST["action"]);
                        if ($action != "encrypt" && $action != "decrypt") {
                            $actionErr = "Invalid action selected";
                        }
                    }
                    
                    // Validate text
                    if (empty($_POST["text"])) {
                        $textErr = "Input text is required";
                    } else {
                        $text = test_input($_POST["text"]);
                    }
                    
                    // Validate password
                    if (empty($_POST["password"])) {
                        $passwordErr = "Password is required";
                    } else {
                        $password = test_input($_POST["password"]);
                        // Check if password is at least 8 characters
                        if (strlen($password) < 8) {
                            $passwordErr = "Password must be at least 8 characters";
                        }
                    }
                    
                    // Process encryption or decryption if no errors
                    if (empty($actionErr) && empty($textErr) && empty($passwordErr)) {
                        try {
                            if ($action == "encrypt") {
                                $result = encrypt($text, $password);
                            } else {
                                $result = decrypt($text, $password);
                            }
                        } catch (Exception $e) {
                            $resultErr = "Error: " . $e->getMessage();
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
                
                // Encryption function
                function encrypt($plaintext, $password) {
                    // Generate a random IV
                    $iv = openssl_random_pseudo_bytes(16);
                    
                    // Create encryption key from password
                    $key = hash('sha256', $password, true);
                    
                    // Encrypt the data
                    $ciphertext = openssl_encrypt($plaintext, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
                    
                    if ($ciphertext === false) {
                        throw new Exception("Encryption failed: " . openssl_error_string());
                    }
                    
                    // Combine IV and ciphertext and encode as base64
                    $encrypted = base64_encode($iv . $ciphertext);
                    
                    return $encrypted;
                }
                
                // Decryption function
                function decrypt($encrypted, $password) {
                    // Decode from base64
                    $data = base64_decode($encrypted);
                    
                    if ($data === false) {
                        throw new Exception("Invalid base64 encoded data");
                    }
                    
                    // Extract IV (first 16 bytes) and ciphertext
                    if (strlen($data) < 16) {
                        throw new Exception("Invalid encrypted data format");
                    }
                    
                    $iv = substr($data, 0, 16);
                    $ciphertext = substr($data, 16);
                    
                    // Create decryption key from password
                    $key = hash('sha256', $password, true);
                    
                    // Decrypt the data
                    $plaintext = openssl_decrypt($ciphertext, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
                    
                    if ($plaintext === false) {
                        throw new Exception("Decryption failed: " . openssl_error_string());
                    }
                    
                    return $plaintext;
                }
                ?>
                
                <!-- Encryption/Decryption Form -->
                <div class="w3-card w3-white w3-padding-16">
                    <div class="w3-container">
                        <h3>Encryption/Decryption Tool</h3>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="w3-container">
                            <div class="w3-section">
                                <label><b>Select Action</b> <span class="w3-text-red">*</span></label>
                                <div class="w3-row">
                                    <div class="w3-half">
                                        <input class="w3-radio" type="radio" name="action" value="encrypt" <?php if ($action == "encrypt" || $action == "") echo "checked"; ?>>
                                        <label>Encrypt</label>
                                    </div>
                                    <div class="w3-half">
                                        <input class="w3-radio" type="radio" name="action" value="decrypt" <?php if ($action == "decrypt") echo "checked"; ?>>
                                        <label>Decrypt</label>
                                    </div>
                                </div>
                                <span class="w3-text-red"><?php echo $actionErr; ?></span>
                            </div>
                            
                            <div class="w3-section">
                                <label><b>Enter Text</b> <span class="w3-text-red">*</span></label>
                                <textarea class="w3-input w3-border" name="text" rows="4" required><?php echo $text; ?></textarea>
                                <span class="w3-text-red"><?php echo $textErr; ?></span>
                            </div>
                            
                            <div class="w3-section">
                                <label><b>Password</b> <span class="w3-text-red">*</span></label>
                                <input class="w3-input w3-border" type="password" name="password" value="<?php echo $password; ?>" required>
                                <span class="w3-text-red"><?php echo $passwordErr; ?></span>
                                <p class="w3-small w3-text-grey">Must be at least 8 characters. Remember this password for decryption!</p>
                            </div>
                            
                            <button type="submit" class="w3-button w3-blue">Process</button>
                        </form>
                        
                        <?php if ($formSubmitted && empty($actionErr) && empty($textErr) && empty($passwordErr) && empty($resultErr)): ?>
                            <div class="w3-panel w3-pale-green w3-padding-16 w3-round-large w3-margin-top">
                                <h4><?php echo ($action == "encrypt") ? "Encryption" : "Decryption"; ?> Result</h4>
                                <p><strong>Operation:</strong> <?php echo ucfirst($action); ?></p>
                                <p><strong>Result:</strong></p>
                                <div class="w3-code w3-border w3-padding" style="word-wrap: break-word;">
                                    <?php echo $result; ?>
                                </div>
                            </div>
                        <?php elseif ($formSubmitted && !empty($resultErr)): ?>
                            <div class="w3-panel w3-pale-red w3-padding-16 w3-round-large w3-margin-top">
                                <h4>Error</h4>
                                <p><?php echo $resultErr; ?></p>
                                <p>If you're trying to decrypt, make sure you're using the correct password and that the encrypted text is valid.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
