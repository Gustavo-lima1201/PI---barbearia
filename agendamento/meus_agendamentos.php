<?php
require '../conexao/conexao.php';

$agendamentos = [];
$mensagem = "";
$emailBuscado = "";

/* CANCELAR AGENDAMENTO */
if (isset($_GET['cancelar'])) {

    $idCancelar = $_GET['cancelar'];

    $sqlCancelar = "UPDATE Agendamento 
                    SET status = 'cancelado'
                    WHERE idAgendamento = :id";

    $stmtCancelar = $pdo->prepare($sqlCancelar);
    $stmtCancelar->execute([":id" => $idCancelar]);

    $mensagem = "Agendamento cancelado com sucesso!";
}

/* BUSCAR AGENDAMENTOS */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $emailBuscado = $_POST["email"];

    $sql = "SELECT 
                a.idAgendamento,
                s.nomeServico,
                a.dataAgendamento,
                a.status
            FROM Agendamento a
            JOIN cliente c ON a.idCliente = c.idCliente
            JOIN Servico s ON a.idServico = s.idServico
            WHERE c.email = :email
            ORDER BY a.dataAgendamento DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([":email" => $emailBuscado]);

    $agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($agendamentos)) {
        $mensagem = "Nenhum agendamento encontrado para esse email!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Meus Agendamentos</title>
<link rel="stylesheet" href="../css/agendamento.css">
</head>
<body>

<div class="container">

<h1>Consultar Meus Agendamentos</h1>

<?php if($mensagem != "") { ?>
<div class="mensagem"><?= $mensagem ?></div>
<?php } ?>

<form method="POST">
<input type="email" name="email" placeholder="Digite seu email" required>
<button type="submit">Buscar</button>
</form>

<?php if(!empty($agendamentos)) { ?>
<table>
<tr>
<th>Serviço</th>
<th>Data</th>
<th>Status</th>
<th>Ação</th>
</tr>

<?php foreach($agendamentos as $a) { ?>
<tr>
<td><?= $a['nomeServico'] ?></td>
<td><?= $a['dataAgendamento'] ?></td>
<td><?= $a['status'] ?></td>
<td>
<?php if($a['status'] != 'cancelado') { ?>
<a href="?cancelar=<?= $a['idAgendamento'] ?>" 
class="cancelar"
onclick="return confirm('Tem certeza que deseja cancelar?')">
Cancelar
</a>
<?php } else { ?>
—
<?php } ?>
</td>
</tr>
<?php } ?>

</table>
<?php } ?>

</div>

</body>
</html>