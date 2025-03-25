<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>assignment 8: php practice - problem 4</title>
        <style>
            body {
                font-family: 'Georgia', serif;
                padding: 20px;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }
            .container {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
                max-width: 800px;
                margin: 0 auto;
            }
            .product {
                border: 1px solid red;
                padding: 10px;
            }
        </style>
    </head>
    <body>
        <div class='container'>
        <?php    
            // establish connection info
            $server = "localhost"; // your server, will always be localhost if you're on siteground
            $userid = "u096ti55v5d6b"; // your user id, paste from siteground --> mysql
            $pw = "tohruai9894"; // your pw, you can change this in siteground
            $db = "dbtmr1mivgsnxs"; // your database, paste from siteground
                    
            // create connection, results in a connection object
            $conn = new mysqli($server, $userid, $pw);

            // check connection
            if ($conn->connect_error) {
                // don't want to use except for in development, user shouldn't see this
                die("Connection failed: " . $conn->connect_error);
            }
                
            // select the database
            $conn->select_db($db);

            // run a query
            $sql = "SELECT ProductName, Price, Description FROM Products";
            $result = $conn->query($sql);

            // get results
            // loop keeps a pointer, always looking one at a time
            if ($result->num_rows > 0) { // if returned more than one row, go into a loop
                // can use like an associative array
                while($row = $result->fetch_assoc()) {
                    echo "<div class='product'>";
                    echo "<h2>" . $row["ProductName"] . " <span class='price'>\$" . $row["Price"] . "</span></h2>";
                    echo "<p class='description'>" . $row["Description"] . "</p>";
                    echo "</div>";
                }
            } else {
                echo "no results";
            }
                
            // close the connection	
            $conn->close();
        ?>
        </div>
    </body>
</html>