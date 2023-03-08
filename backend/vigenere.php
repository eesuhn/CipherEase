<?php
    class Vigenere extends Cipher {

        public function __construct ($input, $key) {
            parent::__construct($input, $key);
        }

        public function encrypt() {
            $input = strtolower($this->input);
            $key = strtolower($this->key);
            $keyIndex = 0;

            for ($i = 0; $i < strlen($input); $i++) {
                $c = $input[$i];

                if ($c == " ") {
                    $this->output .= " ";
                    continue;
                } else {
                    if (ctype_upper($c)) {
                        $c = chr(ord('A') + (ord($c) - ord('A') + ord($key[$keyIndex]) - ord('A')) % 26);

                    } else {
                        $c = chr(ord('a') + (ord($c) - ord('a') + ord($key[$keyIndex]) - ord('a')) % 26);
                    }
                }
                $keyIndex = ($keyIndex + 1) % strlen($key);

                if (ctype_upper($this->input[$i])) {
                    $c = strtoupper($c);
                }

                $this->output .= $c;
            }
        }

        public function decrypt() {
            $input = strtolower($this->input);
            $key = strtolower($this->key);
            $keyIndex = 0;

            for ($i = 0; $i < strlen($input); $i++) {
                $c = $input[$i];

                if ($c == " ") {
                    $this->output .= " ";
                    continue;
                } else {
                    if (ctype_upper($c)) {
                        $c = chr(ord('A') + (ord($c) - ord('A') - ord($key[$keyIndex]) + ord('A') + 26) % 26);

                    } else {
                        $c = chr(ord('a') + (ord($c) - ord('a') - ord($key[$keyIndex]) + ord('a') + 26) % 26);
                    }
                }
                $keyIndex = ($keyIndex + 1) % strlen($key);

                if (ctype_upper($this->input[$i])) {
                    $c = strtoupper($c);
                }

                $this->output .= $c;
            }
        }
    }
?>