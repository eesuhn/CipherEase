<?php
    class Columnar extends Cipher{

        private $rows;
        private $cols;
        private $table;

        public function __construct ($input, $key) {
            parent::__construct($input, $key);
        }

        public function encrypt() {
            $this->generateTable();
            $this->sortTable();
            $this->readTable();
        }

        // Need to fix this
        public function decrypt() {
            $this->generateTable();
            $this->sortTable();
            $this->readTable();
        }

        public function getOutput() {
            return $this->output;
        }

        private function generateTable() {
            $this->rows = ceil(strlen($this->input) / strlen($this->key));
            $this->cols = strlen($this->key);
            $this->input = str_replace(' ', '_', $this->input);
            $this->input = str_pad($this->input, $this->rows * $this->cols, " ", STR_PAD_RIGHT);
            $this->table = array();
            for ($i = 0; $i < $this->cols; $i++) {
                $this->table[$i] = str_repeat('', $this->rows);
                for ($j = 0; $j < $this->rows; $j++) {
                    $this->table[$i][$j] = $this->input[$j * $this->cols + $i];
                }
            }
        }

        private function sortTable() {
            $keys = str_split($this->key);
            $key_indexes = range(0, strlen($this->key)-1);
            array_multisort($keys, SORT_ASC, SORT_STRING, $key_indexes);
            $sorted_table = array();
            foreach ($key_indexes as $i) {
                $sorted_table[] = $this->table[$i];
            }
            $this->table = $sorted_table;
        }

        private function readTable() {
            $this->output = "";
            for ($i = 0; $i < $this->cols; $i++) {
                for ($j = 0; $j < $this->rows; $j++) {
                    $char = trim($this->table[$i][$j]);
                    if ($char == '_') {
                        $this->output .= ' ';
                    } else {
                        $this->output .= $char;
                    }
                }
            }
        }
    }

    function columnar($text, $key, $decrypt = false) {
        $cipher = new Columnar($text, $key);
        if ($decrypt) {
            $cipher->decrypt();
        } else {
            $cipher->encrypt();
        }
        return $cipher->getOutput();
    }
?>