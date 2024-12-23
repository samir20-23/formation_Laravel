<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debug Foreach Example</title>
</head>
<body>
    <h1>Fruits List with Debugging</h1>
    <ul>
        <?php
        // Define an array of fruits
        $fruits = ["Apple", "Banana", "Orange", "Mango"];

        // Debugging: Output the array structure
        echo "<pre>Full Array Debug:\n";
        print_r($fruits);
        echo "</pre>";

        // Use foreach to iterate over the array
        foreach ($fruits as $index => $fruit) {
            // Debugging: Output the current index and value
            echo "<pre>Debug: Index $index => $fruit</pre>";
            
            // Display each fruit in a list
            echo "<li>$fruit</li>";
        }
        ?>
    </ul>
</body>
</html>
