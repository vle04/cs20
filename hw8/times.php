<html>
    <head><title>assignment 8: php practice - problem 1</title></head>
    <body>
        <?php
            // check that n is in the query string
            if (isset($_GET['n']) && is_numeric($_GET['n'])) {
                $n = intval($_GET['n']); // convert into an int

                 // create times table for n
                for ($i = 1; $i <= 15; $i++) {
                    echo "$i x $n = " . ($i * $n) . "<br>";
                }
            } else {
                echo "Please enter a valid number using '?n=' in the URL";
            }
        ?>
    </body>
</html>