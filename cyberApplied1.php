<?php include 'header.php'; ?>

<div class="w3-container w3-padding-64 w3-light-grey">
    <div class="w3-content" style="max-width:1100px">
        <h2 class="w3-center">Security Hash Tool</h2>
        <p class="w3-center w3-large">Generate secure one-way hashes from plaintext input</p>
        
        <div class="w3-row-padding" style="margin-top:64px">
            <div class="w3-half">
                <div class="w3-card w3-white w3-padding-16">
                    <div class="w3-container">
                        <h3>About Hash Functions</h3>
                        <p>Hash functions are cryptographic algorithms that convert data of arbitrary size into a fixed-size output, known as a hash value or digest. These functions are designed to be:</p>
                        
                        <ul class="w3-ul">
                            <li><strong>One-way:</strong> It should be computationally infeasible to reverse the process and obtain the original input from the hash value.</li>
                            <li><strong>Deterministic:</strong> The same input will always produce the same hash value.</li>
                            <li><strong>Fast to compute:</strong> Generating a hash should be efficient for any input.</li>
                            <li><strong>Collision-resistant:</strong> It should be extremely difficult to find two different inputs that produce the same hash value.</li>
                        </ul>
                        
                        <p>Common hash algorithms include:</p>
                        <ul class="w3-ul">
                            <li>SHA-256: Part of the SHA-2 family, produces a 256-bit (32-byte) hash value.</li>
                            <li>SHA-384: Part of the SHA-2 family, produces a 384-bit (48-byte) hash value.</li>
                            <li>SHA-512: Part of the SHA-2 family, produces a 512-bit (64-byte) hash value.</li>
                            <li>SHA3-256: Part of the newer SHA-3 family, produces a 256-bit hash value.</li>
                            <li>SHA3-512: Part of the newer SHA-3 family, produces a 512-bit hash value.</li>
                        </ul>
                        
                        <p>Hash functions are widely used in:</p>
                        <ul class="w3-ul">
                            <li>Password storage (with additional salting)</li>
                            <li>Data integrity verification</li>
                            <li>Digital signatures</li>
                            <li>Blockchain technology</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="w3-half">
                <?php
                // Initialize variables
                $plaintext = $algorithm = $hash = "";
                $plaintextErr = $algorithmErr = "";
                $formSubmitted = false;
                
                // Form validation when submitted
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $formSubmitted = true;
                    
                    // Validate plaintext
                    if (empty($_POST["plaintext"])) {
                        $plaintextErr = "Input text is required";
                    } else {
                        $plaintext = test_input($_POST["plaintext"]);
                    }
                    
                    // Validate algorithm
                    if (empty($_POST["algorithm"])) {
                        $algorithmErr = "Algorithm selection is required";
                    } else {
                        $algorithm = test_input($_POST["algorithm"]);
                        // Verify that the selected algorithm is valid
                        $validAlgorithms = array("sha256", "sha384", "sha512", "sha3-256", "sha3-512");
                        if (!in_array($algorithm, $validAlgorithms)) {
                            $algorithmErr = "Invalid algorithm selected";
                        }
                    }
                    
                    // Generate hash if no errors
                    if (empty($plaintextErr) && empty($algorithmErr)) {
                        // Generate the hash using the selected algorithm
                        $hash = hash($algorithm, $plaintext);
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
                
                <!-- Hash Generator Form -->
                <div class="w3-card w3-white w3-padding-16">
                    <div class="w3-container">
                        <h3>Hash Generator</h3>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="w3-container">
                            <div class="w3-section">
                                <label><b>Enter Text to Hash</b> <span class="w3-text-red">*</span></label>
                                <textarea class="w3-input w3-border" name="plaintext" rows="4" required><?php echo $plaintext; ?></textarea>
                                <span class="w3-text-red"><?php echo $plaintextErr; ?></span>
                            </div>
                            <div class="w3-section">
                                <label><b>Select Hash Algorithm</b> <span class="w3-text-red">*</span></label>
                                <select class="w3-select w3-border" name="algorithm" required>
                                    <option value="" <?php if ($algorithm == "") echo "selected"; ?>>Choose an algorithm</option>
                                    <option value="sha256" <?php if ($algorithm == "sha256") echo "selected"; ?>>SHA-256</option>
                                    <option value="sha384" <?php if ($algorithm == "sha384") echo "selected"; ?>>SHA-384</option>
                                    <option value="sha512" <?php if ($algorithm == "sha512") echo "selected"; ?>>SHA-512</option>
                                    <option value="sha3-256" <?php if ($algorithm == "sha3-256") echo "selected"; ?>>SHA3-256</option>
                                    <option value="sha3-512" <?php if ($algorithm == "sha3-512") echo "selected"; ?>>SHA3-512</option>
                                </select>
                                <span class="w3-text-red"><?php echo $algorithmErr; ?></span>
                            </div>
                            <button type="submit" class="w3-button w3-blue">Generate Hash</button>
                        </form>
                        
                        <?php if ($formSubmitted && empty($plaintextErr) && empty($algorithmErr)): ?>
                            <div class="w3-panel w3-pale-green w3-padding-16 w3-round-large w3-margin-top">
                                <h4>Hash Result</h4>
                                <p><strong>Algorithm:</strong> <?php echo strtoupper($algorithm); ?></p>
                                <p><strong>Input Text:</strong> <?php echo $plaintext; ?></p>
                                <p><strong>Hash Value:</strong></p>
                                <div class="w3-code w3-border w3-padding" style="word-wrap: break-word;">
                                    <?php echo $hash; ?>
                                </div>
                                <p class="w3-small w3-text-grey">Note: Hash functions are one-way algorithms and cannot be decrypted.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
