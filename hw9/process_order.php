<html>
    <head>
        <title>assignment 9: two owl's cafe</title>
        <style>
            body {
                font-family: 'Georgia', serif;
                padding: 20px;
                text-align: center;
                background-color: #f5f5f5;
            }
            .container {
                max-width: 600px;
                margin: 20px auto;
                padding: 20px;
                background-color: white;
                border-radius: 12px;
                box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
                text-align: left;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <h2>order summary</h2>
            <?php
                // establish connection info
                $server = "localhost"; // your server, will always be localhost if you're on siteground
                $userid = "u096ti55v5d6b"; // your user id, paste from siteground --> mysql
                $pw = "tohruai9894"; // your pw, you can change this in siteground
                $db = "dbjpglvqfukvnf"; // your database, paste from siteground
                        
                // create connection, results a connection object
                $conn = new mysqli($server, $userid, $pw);
             
                // select the database
                $conn->select_db($db);

                // run a query
                $sql = "SELECT itemID, itemName, Price FROM menu";
                $result = $conn->query($sql);

                // store menu items in an associative array
                $menuItems = [];
                while ($row = $result->fetch_assoc()) {
                    $menuItems[$row['itemID']] = ['name' => $row['itemName'], 'price' => $row['Price']];
                }
                                
                // close the connection	
                $conn->close();

                $subtotal = 0;
                $taxRate = 0.0625;

                // process the order
                 foreach ($_GET as $key => $value) {
                    if (strpos($key, "item_") === 0) {
                        $itemID = substr($key, 5);
                        $quantity = (int)$value;

                        if ($quantity > 0 && isset($menuItems[$itemID])) {
                            $itemName = $menuItems[$itemID]['name'];
                            $itemPrice = $menuItems[$itemID]['price'];
                            $totalItemPrice = $itemPrice * $quantity;
                            $subtotal += $totalItemPrice;

                            echo "<div class='order-item'>";
                            echo "<strong>$itemName</strong><br>";
                            echo "quantity: $quantity<br>";
                            echo "price: $" . number_format($itemPrice, 2) . "<br>";
                            echo "total for item: $" . number_format($totalItemPrice, 2) . "<br>";
                            echo "</div>";
                        }
                    }
                }
                // Calculate totals
                $tax = $subtotal * $taxRate;
                $total = $subtotal + $tax;

                echo "<p class='total'>subtotal: $" . number_format($subtotal, 2) . "</p>";
                echo "<p class='total'>tax (6.25%): $" . number_format($tax, 2) . "</p>";
                echo "<p class='total'>total: $" . number_format($total, 2) . "</p>";

                // Display user details
                $firstName = htmlspecialchars($_GET['first_name'] ?? '');
                $lastName = htmlspecialchars($_GET['last_name'] ?? '');
                $pickupTime = htmlspecialchars($_GET['pickup_time'] ?? '');
                $instructions = htmlspecialchars($_GET['instructions'] ?? '');

                echo "<h3>pickup time: $pickupTime</h3>";
                echo "<h3>customer: $firstName $lastName</h3>";
                
                if (!empty($instructions)) {
                    echo "<h3>special instructions:</h3>";
                    echo "<p>$instructions</p>";
                }
            ?>
        </div>
    </body
</html>