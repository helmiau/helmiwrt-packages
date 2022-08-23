<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $datanomer = $_POST['nomer'];
        $data = file_get_contents("nomer.json");
        $array = json_decode($data, true);
        $array[0] = "$datanomer";
        file_put_contents('nomer.json', json_encode($array));
        header('Location: index.php');
        exit();
    }
?>