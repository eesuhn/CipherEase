<?php

# Columnar transposition that reads and writes by row

class ColumnarRow {
    private $text;
    private $key;
    private $rows;
    private $cols;
    private $table;
    private $output;
    
    public function __construct($text, $key) {
        $this->text = $text;
        $this->key = $key;
        $this->output = "";
        $this->table = array();
    }
    
    public function encrypt() {
        $this->generateTable();
        $this->sortTable();
        $this->readTable();
    }
    
    public function decrypt() {
        $this->generateTable();
        $this->sortTable();
        $this->readTable();
    }
    
    public function getOutput() {
        return $this->output;
    }
    
    private function generateTable() {
        $this->rows = ceil(strlen($this->text) / strlen($this->key));
        $this->cols = strlen($this->key);
        $this->text = str_pad($this->text, $this->rows * $this->cols, " ");
        for ($i = 0; $i < $this->cols; $i++) {
            $this->table[$i] = "";
            for ($j = 0; $j < $this->rows; $j++) {
                $this->table[$i] .= $this->text[$j * $this->cols + $i];
            }
        }
    }
    
    private function sortTable() {
    $keys = str_split($this->key);
    array_multisort($keys, SORT_ASC, SORT_STRING, $this->table);
}
    
    private function readTable() {
        $this->output = "";
        for ($i = 0; $i < $this->rows; $i++) {
            for ($j = 0; $j < $this->cols; $j++) {
                $this->output .= $this->table[$j][$i];
            }
        }
    }
}

function columnar_rw_row($text, $key, $decrypt = false) {
    $cipher = new ColumnarRow($text, $key);
    if ($decrypt) {
        $cipher->decrypt();
    } else {
        $cipher->encrypt();
    }
    return $cipher->getOutput();
}

?>
