<?php
    include 'backend/cipher.php';
    include 'backend/caesar.php';
    include 'backend/vigenere.php';
    include 'backend/columnar.php';

    function encryptChoice ($choiceCipher, $input, $key, $choiceCrypt) {

        if (empty($input) && empty($key)) {
            return "";
        }

        if (!validateInput($input)) {
            return "Invalid input. Please enter only alphabetic characters.";
        }

        switch ($choiceCipher) {
            case 'caesar':
                if (!validateKey_Caesar($key)) {
                    return "Invalid key. Please enter only numeric characters.";
                }

                $cipher = new Caesar($input, $key);
                if ($choiceCrypt == "encrypt") {
                    $cipher->encrypt();
                } else {
                    $cipher->decrypt();
                }
                return $cipher->getOutput();
                break;

            case 'vigenere':
                if (!validateKey_String($key)) {
                    return "Invalid key. Please enter only alphabetic characters.";
                }

                $cipher = new Vigenere($input, $key);
                if ($choiceCrypt == "encrypt") {
                    $cipher->encrypt();
                } else {
                    $cipher->decrypt();
                }
                return $cipher->getOutput();
                break;

            case 'columnar':
                if (!validateKey($key)) {
                    return "Invalid key. Please enter a key.";
                }

                $cipher = new Columnar($input, $key);
                if ($choiceCrypt == "encrypt") {
                    $cipher->encrypt();
                } else {
                    $cipher->decrypt();
                }
                return $cipher->getOutput();
                break;

        }
    }

    function validateInput ($input) {
        if (empty($input)) {
            return false;
        }
        if (!ctype_alpha(str_replace(' ', '', $input))) {
            return false;
        }
        return true;
    }
 
    function validateKey($key) {
    if (empty($key)) {
        return false;
    }
    return true;
}


    function validateKey_String ($key) {
        if (empty($key)) {
            return false;
        }
        if (!ctype_alpha($key)) {
            return false;
        }
        return true;
    }

    function validateKey_Caesar ($key) {
        if (empty($key)) {
            return false;
        }
        if (!ctype_digit($key)) {
            return false;
        }
        return true;
    }
?>
