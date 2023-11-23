<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Ocorrências Ambientais</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        h1 {
            color: #333;
        }

        form {
            max-width: 500px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        p {
            color: #4caf50;
        }

        .error {
            color: #ff0000;
        }
    </style>
</head>
<body>

<h1>Registro de Ocorrências Ambientais</h1>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost:3306";
    $username = "root";
    $password = "@Carrodecorrida123";
    $dbname = "registro_ocorrencias_ambientais";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar a conexão
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Preparar e executar a consulta SQL
    $tipo_ocorrencia = $_POST["tipo_ocorrencia"];
    $descricao = $_POST["descricao"];
    $data_ocorrencia = $_POST["data_ocorrencia"];
    $endereco = $_POST["endereco"];

    $sql = "INSERT INTO ocorrencias (tipo_ocorrencia, descricao, data_ocorrencia, endereco) 
            VALUES ('$tipo_ocorrencia', '$descricao', '$data_ocorrencia', '$endereco')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Ocorrência registrada com sucesso!</p>";
    } else {
        echo "Erro ao registrar a ocorrência: " . $conn->error;
    }

    // Fechar a conexão
    $conn->close();
}
?>

<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <label for="tipo_ocorrencia">Tipo de Ocorrência:</label>
    <input type="text" name="tipo_ocorrencia" required>

    <label for="descricao">Descrição:</label>
    <textarea name="descricao" rows="4" required></textarea>

    <label for="data_ocorrencia">Data da Ocorrência:</label>
    <input type="date" name="data_ocorrencia" required>

    <label for="endereco">Endereço:</label>
    <input type="text" name="endereco" required>

    <input type="submit" value="Registrar">
</form>

</body>
</html>