<html>
    <head>
        <title>assignment 8: php practice - problem 2</title>
        <style>
            body {
                display: flex;
                height: 100vh;
                font-family: Arial, sans-serif;
                justify-content: center;
                align-items: center;
                flex-direction: column;
            }
            .h1 {
                margin-bottom: 10px;
            }
            .container {
                border: 1px solid black;
                border-radius: 10px;
                box-shadow: 4px 4px 15px rgba(0, 0, 0, 0.1);
                padding: 20px;
                max-width: 350px;
                width: 100%;
                text-align: center;
            }
            .day {
                font-weight: bold;
                color: #333;
            }
            .hours {
                font-weight: normal;
                color: #666;
            }
            .hours-closed {
                font-weight: normal;
                color: red;
                font-style: italic;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <h1>business hours</h1>
            <?php
                // create associative array for office hours
                $hours = array("monday" => "9am - 5pm", 
                            "tuesday" => "9am - 5pm", 
                            "wednesday" => "9am - 5pm",
                            "thursday" => "9am - 7pm",
                            "friday" => "9am - 7pm",
                            "saturday" => "10am - 4pm",
                            "sunday" => "closed"
                            );
                // loop through array and display data
                foreach($hours as $day => $h) {
                    echo "<p class='day'>$day: ";
                    if ($h == "closed")
                        echo "<span class='hours-closed'>$h</span>";
                    else
                        echo "<span class='hours'>$h</span>";
                    echo "</p>";
                }
            ?>
        </div>
    </body>
</html>