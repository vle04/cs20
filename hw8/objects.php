<html>
    <head>
        <title>assignment 8: php practice - problem 3</title>
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
            // create an object to store a product
            class Product {
                // constructor function
                public function __construct($name, $description, $price) {
                    $this->name = $name;
                    $this->description = $description;
                    $this->price = $price;
                }

                public function getFormattedPrice() {
                    return number_format($this->price, 2);
                }
            }

            // create array of products using the object
            $products = [
                new Product("croissant", "flaky, buttery layers perfect for breakfast or a snack", 3.50),
                new Product("cinnamon roll", "sweet, spiced, and topped with a creamy icing", 4.25),
                new Product("macaron set", "delicate french cookies with a creamy filling", 10.00),
                new Product("blueberry muffin", "moist and packed with fresh blueberries", 2.75),
                new Product("chocolate eclair", "choux pastry filled with rich chocolate cream", 3.99),
                new Product("lemon tart", "tangy lemon curd in a crisp, buttery crust", 5.50)
            ];

            // display all products to the page
            foreach ($products as $p) {
                echo "<div class='product'>";
                echo "<h2>{$p->name} <span class='price'>\${$p->getFormattedPrice()}</span></h2>";
                echo "<p class='description'>{$p->description}</p>";
                echo "</div>";
            }
        ?>
        </div>
    </body>
</html>