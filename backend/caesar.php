<?php
    class Caesar extends Cipher {

        public function __construct ($input, $key) {
            parent::__construct($input, $key);
        }

        public function encrypt () {

            if (ctype_digit($this->key)) {
                for ($i = 0; $i < strlen($this->input); $i++) {
                    $c = $this->input[$i];

                    if ($c == " ") {
                        $this->output .= " ";
                        continue;
                    } else {
                        if (ctype_upper($c)) {
                            $c = chr(ord('A') +(ord($c) - ord('A') + $this->key) % 26);

                        } else {
                            $c = chr(ord('a') +(ord($c) - ord('a') + $this->key) % 26);
                        }
                    }
                    $this->output .= $c;
                }
            }
        }
        public function decrypt() {

            if (ctype_digit($this->key)) {
                for ($i = 0; $i < strlen($this->input); $i++) {
                    $c = $this->input[$i];

                    if ($c == " ") {
                        $this->output .= " ";
                        continue;
                    } else {
                        if (ctype_upper($c)) {
                            $c = chr(ord('A') +(ord($c) - ord('A') - $this->key + 26) % 26);

                        } else {
                            $c = chr(ord('a') +(ord($c) - ord('a') - $this->key + 26) % 26);
                        }
                    }
                    $this->output .= $c;
                }
            }
        }
    }
?>