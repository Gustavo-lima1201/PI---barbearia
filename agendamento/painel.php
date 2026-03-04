<?php
require __DIR__ . '/../conexao/conexao.php';

$sql = "SELECT 
a.idAgendamento,
c.nome AS cliente,
s.nomeServico,
a.dataAgendamento,
a.status
FROM Agendamento a
JOIN cliente c ON a.idCliente = c.idCliente
JOIN Servico s ON a.idServico = s.idServico
ORDER BY a.dataAgendamento DESC";

$stmt = $pdo->query($sql);
$agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Painel</title>
<link rel="stylesheet" href="../css/agendamento.css">
</head>
<body>

<div class="container">
<h1>Painel do Barbeiro</h1>

<table>
<tr>
<th>Cliente</th>
<th>Serviço</th>
<th>Data</th>
<th>Status</th>
</tr>

<?php foreach($agendamentos as $a) { ?>
<tr>
<td><?= $a['cliente'] ?></td>
<td><?= $a['nomeServico'] ?></td>
<td><?= $a['dataAgendamento'] ?></td>
<td><?= $a['status'] ?></td>
</tr>
<?php } ?>

</table>

</div>
</body>
</html>