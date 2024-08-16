<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe os dados JSON do frontend
    $data = json_decode(file_get_contents('php://input'), true);
    if ($data === null) {
        echo 'Erro ao ler dados JSON.';
        exit;
    }

    // Lê os dados existentes
    $usuarios = json_decode(file_get_contents('usuarios.json'), true);
    if ($usuarios === null) {
        $usuarios = [];
    }

    // Adiciona os novos dados
    foreach ($data as $user) {
        $usuarios[] = array(
            'id' => $user['id'] ?? uniqid(),
            'nome' => $user['nome'],
            'email' => $user['email']
        );
    }

    // Salva os dados de volta no arquivo
    file_put_contents('usuarios.json', json_encode($usuarios));

    echo 'Dados importados com sucesso!';
}
?>
