<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
</head>
<body>

<table>
<?php
    require "connection.php";
    $result = $connection->prepare("SELECT auto.*, citta.* FROM auto auto INNER JOIN citta citta ON auto.idCitta = citta.IdCitta;");
    $result->execute();
    echo "<table>";
    $numColumns = $result->columnCount();
    // Iterate over each column and fetch the name
    for ($col = 0; $col < $numColumns; $col++) {
        $columnMeta = $result->getColumnMeta($col);  // Get column metadata
        echo "<th>" . $columnMeta['name'] . "</th>";
    }
    echo"</tr>";

    while($row = $result->fetch(mode: PDO::FETCH_ASSOC)) {
        echo "<tr>";
        foreach ($row as $value){
            echo "<td>". $value ."</td>";
        }
        echo "</tr>";
    }
?>
</body>
</html>