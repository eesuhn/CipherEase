<?php
    abstract class Cipher {
        protected $input;
        protected $key;
        protected $output;

        function __construct ($input, $key) {
            $this->input = $input;
            $this->key = $key;
        }
        public function getInput () {
            return $this->input;
        }
        public function getKey () {
            return $this->key;
        }
        public function getOutput () {
            return $this->output;
        }

        abstract public function encrypt ();
        abstract public function decrypt ();
    }
?>