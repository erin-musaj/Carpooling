<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
</head>
<body>
<script>
        function confirmSubmit(){
            return confirm("sei sicuro?")
        }
</script>
        <form action="insert.php" method="POST" onsubmit="confirmSubmit()">
            <label for="modello">modello</label>
            <br>
            <input type="text" id="modello" name="modello">
            <br>
            <br>
            <label for="marca">marca</label>
            <br>
            <input type="text" id="marca" name="marca">
            <br>
            <br>
            <label for="nome">nome</label>
            <br>
            <input type="text" id="nome" name="nome">
            <br>
            <br>
            <label for="provincia">provincia</label>
            <br>
            <input type="text" id="provincia" name="provincia">
            <br>
            <br>
            <label for="regione">regione</label>
            <br>
            <input type="text" id="regione" name="regione">
            <br>
            <button type="submit" >invia</button>
            </select>
        </form>
<?php
    if(isset($_POST["modello"]) && isset($_POST["marca"]) && isset($_POST["nome"]) && isset($_POST["provincia"]) && isset($_POST["regione"])){
        require "connection.php";
        $marca = $_POST["marca"];
        $modello = $_POST["modello"];
        $nome = $_POST["nome"];
        $provincia = $_POST["provincia"];
        $regione = $_POST["regione"];
        $param = array(
            ":nome" => $nome,
            ":provincia" => $provincia,
            ":regione" => $regione
        );
        $result = $connection->prepare("SELECT IdCitta FROM citta WHERE nome=:nome AND provincia=:provincia AND regione=:regione;");
        $result->execute(array(
            ':nome' => $nome,
            ':provincia' => $provincia,
            ':regione' => $regione
        ));
        $id = $result->fetch(PDO::FETCH_ASSOC)["IdCitta"];
        $result = $connection->prepare("INSERT INTO auto (modello, marca, idCitta) VALUES ('$modello', '$marca', $id)");
        $result->execute();
        echo "inserimento effettuato";
        $result = $connection->prepare("SELECT * FROM auto");
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
        echo "</table>";
    }
?>
</body>
</html>