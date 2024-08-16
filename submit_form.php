<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Coleta os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'];

    // Verifica se as senhas coincidem
    if ($senha !== $confirmar_senha) {
        echo 'As senhas não coincidem.';
        exit;
    }

    // Cria um novo array para o usuário
    $user = array(
        'id' => uniqid(),  // Gerar um ID único para o usuário
        'nome' => $nome,
        'email' => $email,
    );

    // Recupera os usuários do localStorage
    $usuarios = json_decode(file_get_contents('usuarios.json'), true);
    if ($usuarios === null) {
        $usuarios = [];
    }

    // Adiciona o novo usuário
    $usuarios[] = $user;

    // Salva os usuários de volta no localStorage
    file_put_contents('usuarios.json', json_encode($usuarios));

    // Redireciona para a página do relatório de usuários
    header('Location: relatorio_usuarios.html');
    exit;
}
?>
