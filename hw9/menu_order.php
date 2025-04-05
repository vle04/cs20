<html>
    <head>
        <title>assignment 9: two owl's cafe</title>
        <style>
            body {
                font-family: 'Georgia', serif;
                padding: 20px;
                text-align: center;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
            }
            .container {
                display: flex;
                justify-content: center;
                align-content: center;
                flex-direction: column;
            }
            .menu {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
                max-width: 800px;
                margin: 0 auto;
            }
            .product {s
                padding: 10px;
                display: flex;
                justify-content: center;
                align-content: center;
                flex-direction: column;
                border-radius: 12px;
                box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            }
            img {
                max-height: 120px;
                max-width: 120px;
                align-self: center;
            }
            .quantity {
                display: flex;
                flex-direction: row;
                gap: 10px;
                justify-content: center;
                margin-top: 10px;
            }
            .info {
                display: flex;
                flex-direction: column;
                align-items: center;
                background-color: white;
                padding: 20px;
                border-radius: 12px;
                box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
                max-width: 400px;
                width: 100%;
                margin-top: 20px;
            }
            .field {
                display: flex;
                flex-direction: column;
                align-items: center;
                width: 100%;
                margin-bottom: 15px;
            }
            label {
                font-weight: bold;
                margin-bottom: 5px;
            }
            input, textarea, select {
                width: 90%;
                padding: 8px;
                border: 1px solid #ccc;
                border-radius: 6px;
                font-size: 16px;
                text-align: center;
            }
            .submit_btn {
                display: flex;
                justify-content: center;
                width: 100%;
                margin-top: 10px;
            }
        </style>
    </head>
    <body>
        <?php include 'header.php' ?>
        <div class='container'>
        <form class='menu' method='get' action='process_order.php'>
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
                $sql = "SELECT itemID, itemName, Price, Description, Image FROM menu";
                $result = $conn->query($sql);

                // get results
                // loop keeps a pointer, always looking one at a time
                if ($result->num_rows > 0) { // if returned more than one row, go into a loop
                    // can use like an associative array
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='product'>";
                        echo "<img src='images/" . $row["Image"] . "' alt='" . $row["itemName"] . "'>";
                        echo "<h3>" . $row["itemName"] . " <span class='price'>\$" . $row["Price"] . "</span></h3>";
                        echo "<p class='description'>" . $row["Description"] . "</p>";
                        echo "<div class='quantity'>";
                        echo "<label for='item_" . $row["itemID"] . "' id='item_" . $row["itemID"] . "'>quantity: </label>";
                        echo "<select name='item_" . $row["itemID"] . "' id='item_" . $row["itemID"] . "'>";
                        for ($i = 0; $i <= 10; $i++) {
                            echo "<option value='$i'>$i</option>";
                        }
                        echo "</select>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "no results";
                }
                    
                // close the connection	
                $conn->close();
            ?>
            <div class='info'>
                <div class='field'>
                    <label for='first_name'>first name:</label>
                    <input type='text' name='first_name' id='first_name'></input>
                </div>
                <div class='field'>
                    <label for='last_name'>last name:</label>
                    <input type='text' name='last_name' id='last_name'></input>
                </div>
                <div class='field'>
                    <label for='instructions'>special instructions:</label>
                    <textarea name='instructions' id='instructions' rows='4' cols='40' placeholder='allergies, preferences, etc.'></textarea>
                </div>
                <div class='field'>
                    <input type='hidden' name='pickup_time' value="">
                </div>
                <div class='submit_btn'>
                    <input type='submit' value='submit order'>
                </div>
            </div>
        </form>
        </div>
        <script>
            document.querySelector("form").addEventListener("submit", function(event) {
                const form = event.target;
                let itemOrdered = false;

                // check quantities of items
                const selects = form.querySelectorAll("select");
                selects.forEach(select => {
                    if (parseInt(select.value) > 0) {
                        itemOrdered = true;
                    }
                });

                // get the name of the fields
                const firstName = form.querySelector("#first_name").value.trim();
                const lastName = form.querySelector("#last_name").value.trim();

                if (!itemOrdered) {
                    alert("please order at least one item");
                    event.preventDefault();
                    return;
                }

                if (firstName === "" || lastName === "") {
                    alert("please enter your first and last name");
                    event.preventDefault();
                    return;
                }

                // calculate the pick up time
                const now = new Date();
                now.setMinutes(now.getMinutes() + 20);

                const hours = now.getHours().toString().padStart(2, "0");;
                const minutes = now.getMinutes().toString().padStart(2, "0");;
                const pickupTime = `${hours}:${minutes}`;

                // set the pick up time in the hidden field
                form.querySelector("input[name='pickup_time']").value = pickupTime;
            });
        </script>
    </body>
</html>