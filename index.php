<?php
    include 'control.php';
?>
<html>
    <head>
        <title>Cipher Ease</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    </head>
    
    <body>
        <div class="h-100 d-flex justify-content-center align-items-center">
            <form action="<?=basename($_SERVER["PHP_SELF"])?>" method="POST">

                <div class="row">
                    <div class="col-md-12">
                        <h2>Cipher with Ease</h2>
                    </div>
                </div>

                <div class="row" style="padding: 10px 0 0;">
                    <div class="col-md-12">
                        <label>Input: </label>
                        <input type="text" name="input" class="form-control" value="<?php echo $_POST["input"] ?? ""; ?>">
                    </div>

                    <div class="col-md-12">
                        <label style="padding: 10px 0 0;">Key: </label>
                        <input type="text" name="key" class="form-control" value="<?php echo $_POST["key"] ?? ""; ?>">
                    </div>
                </div>

                <div class="row" style="padding: 30px 0 0;">
                    <div class="col-md-6">
                        <select name="choiceCipher" class="form-control">
                            <option value="caesar"
                                <?php
                                    if (isset($_POST["choiceCipher"])) {
                                        if ($_POST["choiceCipher"] == "caesar") {
                                            echo "selected";
                                        }
                                    }
                                ?>
                            >Caesar</option>
                            <option value="vigenere"
                                <?php
                                    if (isset($_POST["choiceCipher"])) {
                                        if ($_POST["choiceCipher"] == "vigenere") {
                                            echo "selected";
                                        }
                                    }
                                ?>
                            >Vigenère</option>
                            <option value="columnar"
                                <?php
                                    if (isset($_POST["choiceCipher"])) {
                                        if ($_POST["choiceCipher"] == "columnar") {
                                            echo "selected";
                                        }
                                    }
                                ?>
                            >Columnar</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <input type="submit" name="encrypt" class="btn btn-primary" value="Encrypt">
                    </div>
                    <div class="col-md-3">
                        <input type="submit" name="decrypt" class="btn btn-primary" value="Decrypt">
                    </div>
                </div>

                <div class="row" style="padding: 20px 0 0;">
                    <div class="col-md-12">
                        <label>Output: </label>
                        <textarea class="form-control" style="resize: none;" readonly><?php
                            if (isset($_POST["encrypt"]) || isset($_POST["decrypt"])) {

                                $choiceCrypt = isset($_POST["encrypt"]) ? "encrypt" : "decrypt";

                                $input = $_POST["input"];
                                $key = $_POST["key"];
                                $choiceCipher = $_POST["choiceCipher"];

                                echo encryptChoice($choiceCipher, $input, $key, $choiceCrypt);
                            }
                        ?></textarea>
                    </div>
                </div>

            </form>
        </div>
    </body>
</html>
