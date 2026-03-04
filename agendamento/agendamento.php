<?php
require __DIR__ . '/../conexao/conexao.php';

/* BUSCAR SERVIÇOS */
$stmt = $pdo->query("SELECT * FROM Servico");
$servicos = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];
    $servico = $_POST["servico"];
    $data = $_POST["data"];
    $hora = $_POST["hora"];

    $dataHora = $data . " " . $hora;

    try {

        // VERIFICAR SE HORÁRIO JÁ EXISTE
        $sqlVerifica = "SELECT COUNT(*) FROM Agendamento 
                        WHERE dataAgendamento = :dataHora 
                        AND status != 'cancelado'";

        $stmtVerifica = $pdo->prepare($sqlVerifica);
        $stmtVerifica->execute([":dataHora" => $dataHora]);

        if ($stmtVerifica->fetchColumn() > 0) {

            $mensagem = "Esse horário já está ocupado!";

        } else {

            // Inserir cliente
            $sqlCliente = "INSERT INTO cliente (nome, telefone, email)
                           VALUES (:nome, :telefone, :email)";
            $stmtCliente = $pdo->prepare($sqlCliente);
            $stmtCliente->execute([
                ":nome" => $nome,
                ":telefone" => $telefone,
                ":email" => $email
            ]);

            $idCliente = $pdo->lastInsertId();

            // Inserir agendamento
            $sqlAgendamento = "INSERT INTO Agendamento
                               (idCliente, idServico, dataAgendamento, status)
                               VALUES (:idCliente, :idServico, :dataAgendamento, 'agendado')";

            $stmtAgendamento = $pdo->prepare($sqlAgendamento);
            $stmtAgendamento->execute([
                ":idCliente" => $idCliente,
                ":idServico" => $servico,
                ":dataAgendamento" => $dataHora
            ]);

            $mensagem = "Agendamento realizado com sucesso!";
        }

    } catch (PDOException $e) {
        $mensagem = "Erro: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Agendamento</title>
<link rel="stylesheet" href="../css/agendamento.css">
<link rel="stylesheet" href="../css/style.css">
</head>
<body>
 
   

<div class="container">

<h1>Agende seu Horário</h1>

<?php if(isset($mensagem)) { ?>
<div class="mensagem"><?= $mensagem ?></div>
<?php } ?>

<form method="POST">

<input type="text" name="nome" placeholder="Seu nome" required>
<input type="text" name="telefone" placeholder="Telefone" required>
<input type="email" name="email" placeholder="Email">

<select name="servico" required>
<option value="">Selecione um serviço</option>
<?php foreach ($servicos as $s) { ?>
<option value="<?= $s['idServico'] ?>">
<?= $s['nomeServico'] ?> - R$ <?= $s['preco'] ?>
</option>
<?php } ?>
</select>

<label>Data:</label>
<input type="date" name="data" required>

<label>Horário:</label>
<input type="time" name="hora" required>

<button type="submit">Agendar</button>

</form>

<a href="painel.php" class="link">Painel do Barbeiro</a>
<a href="meus_agendamentos.php" class="link">Meus Agendamentos</a>

</div>

</body>
</html>