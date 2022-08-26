<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['nomeraktif'])){
            $datarespon = $_POST['nomeraktif'];
            $data = file_get_contents("./assets/data/nomer.json");
            $array = json_decode($data, true);
            $array['aktif'] = $datarespon;
            file_put_contents('./assets/data/nomer.json', json_encode($array));
            header('Location: index.html');
            exit();
        }
        if(isset($_POST['tambahnomer'])){
            $tambahnomer = $_POST['tambahnomer'];
            $data = file_get_contents("./assets/data/nomer.json");
            $array = json_decode($data, true);
            $array['daftar'][] = $tambahnomer;
            $array['aktif'] = $tambahnomer;
            file_put_contents('./assets/data/nomer.json', json_encode($array));
            header('Location: index.html');
            exit();
        }
        if(isset($_POST['hapusnomer'])){
            $datarespon = $_POST['hapusnomer'];
            $data = file_get_contents("./assets/data/nomer.json");
            $array = json_decode($data, true);
            $arraydaftar = $array['daftar'];
            $lenghtArrayData = count($arraydaftar);
            if( $lenghtArrayData = 1){
                array_splice($arraydaftar, $datarespon, 1); 
                $array['daftar'] = $arraydaftar;
                file_put_contents('./assets/data/nomer.json', json_encode($array));
                header('Location: index.html');
                exit();
            } else {
                array_splice($arraydaftar, $datarespon, $datarespon); 
                $array['daftar'] = $arraydaftar;
                file_put_contents('./assets/data/nomer.json', json_encode($array));
                header('Location: index.html');
                exit();
            }
        }
        if(isset($_POST['editnomer'])){
            $editnomer = $_POST['editnomer'];
            $data = file_get_contents("./assets/data/nomer.json");
            $array = json_decode($data, true);
            $array['daftar'][] = $editnomer;
            file_put_contents('./assets/data/nomer.json', json_encode($array));
            header('Location: index.html');
            exit();
        }
        
}
?>
