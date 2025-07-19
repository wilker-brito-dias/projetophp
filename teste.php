
<?php

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Estoque</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h1 class="text-center mb-4">📦 Relatório de Estoque</h1>

    <?php
    $produtos = [
        "Interruptor" => 3,
        "Tomada" => 12,
        "Cabo Flexível 2.5mm" => 3,
        "Disjuntor" => 7,
        "Sensor de Presença" => 12,
        "Lampada" => 10,
        "Cabo Flexível 1.5mm" => 1,
        "Sensor de Presença" => 2,
        "Botoeira" => 4,
        "QDG" => 31,
    ];

    $estoqueMinimo = 10;
    $soma = array_sum($produtos);
    $media = $soma / count($produtos);

    // Produtos que precisam ser repostos
    $produtos_repor = 0;
    foreach ($produtos as $qtd) {
        if ($qtd < $estoqueMinimo) {
            $produtos_repor++;
        }
    }
    $porcentagem_repor = ($produtos_repor / count($produtos)) * 100;
    ?>

    <!-- Tabela principal de estoque -->
    <h3 class="text-center mb-3">🧾 Situação Atual do Estoque</h3>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Produto</th>
                <th>Estoque</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produtos as $produto => $quantidade): ?>
                <tr>
                    <td><?= htmlspecialchars($produto) ?></td>
                    <td><?= htmlspecialchars($quantidade) ?></td>
                    <td>
                        <?php if ($quantidade < $estoqueMinimo): 
                            $faltando = $estoqueMinimo - $quantidade;
                            $porcentagem = ($faltando / $estoqueMinimo) * 100;
                        ?>
                            <span class="text-danger fw-bold">⚠ Faltam <?= $faltando ?> unidades (<?= round($porcentagem, 1) ?>%)</span>
                        <?php else: ?>
                            <span class="text-success">✔ Estoque OK</span>
                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <!-- Estatísticas gerais -->
    <div class="alert alert-info text-center my-4">
        <strong>Média das quantidades:</strong> <?= round($media, 2) ?> <br>
        <strong>Reposição necessária em:</strong> <?= round($porcentagem_repor, 2) ?>% dos produtos
    </div>

    <!-- Tabela de produtos que precisam de reposição -->
    <h3 class="text-center mb-3">🔧 Tabela de produtos que precisam de reposição</h3>
    <table class="table table-bordered table-hover">
        <thead class="table-warning">
            <tr>
                <th>Produto</th>
                <th>Faltando</th>
                <th>% para completar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produtos as $produto => $quantidade): ?>
                <?php if ($quantidade < $estoqueMinimo): 
                    $faltando = $estoqueMinimo - $quantidade;
                    $porcentagem = ($faltando / $estoqueMinimo) * 100;
                ?>
                    <tr>
                        <td><?= htmlspecialchars($produto) ?></td>
                        <td><?= $faltando ?></td>
                        <td><?= round($porcentagem, 1) ?>%</td>
                    </tr>
                <?php endif ?>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

</body>
</html>


/*
$produtos = [
    "Interruptor" => 3,
    "Tomada" => 12,
    "Cabo Flexível 2.5mm" => 3,
    "Disjuntor" => 7,
    "Sensor de Presença" => 12,
];

$estoqueMinimo = 10;

$soma = array_sum($produtos);
$quantidade = count($produtos);
$media = $soma / $quantidade;


$produtos_repor = 0;
foreach ($produtos as $qtd) {
    if ($qtd < $estoqueMinimo) {
        $produtos_repor++;
    }
}
$porcentagem_repor = ($produtos_repor / count($produtos)) * 100;


echo <<<CSS
<style>
    table {
        border-collapse: collapse;
        width: 80%;
        margin: 20px auto;
        font-family: Arial, sans-serif;
    }
    th, td {
        border: 1px solid #444;
        padding: 10px 15px;
        text-align: left;
    }
    thead th {
        background-color: #333;
        color: #fff;
    }
    tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    tbody tr:hover {
        background-color: #d0e7ff;
    }
    .warning {
        color: #b33;
        font-weight: bold;
    }
    h2 {
        text-align: center;
        font-family: Arial, sans-serif;
        margin-top: 30px;
    }
</style>
CSS;

echo "<table>";
echo "<thead><tr><th>Produto</th><th>Estoque</th><th>Status</th></tr></thead>";
echo "<tbody>";

foreach ($produtos as $produto => $quantidade) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($produto) . "</td>";
    echo "<td>" . htmlspecialchars($quantidade) . "</td>";

    echo "<td>";
    if ($quantidade < $estoqueMinimo) {
        $faltando = $estoqueMinimo - $quantidade;
        $porcentagem = ($faltando / $estoqueMinimo) * 100;
        echo "<span class='warning'>⚠ Faltam $faltando unidades (" . round($porcentagem, 1) . "%)</span>";
    } else {
        echo "Estoque OK";
    }
    echo "</td>";
    echo "</tr>";
}

echo "</tbody>";
echo "</table>";

echo "<h2>A média das quantidades é: " . round($media, 2) . "</h2>";
echo "<h2>É necessário repor o estoque de " . round($porcentagem_repor, 2) . "% dos produtos.</h2>";


/*  */

echo "<table>";
echo "<thead><tr><th>Repor estoque</th><th>Estoque</th><th>Status</th></tr></thead>";
echo "<tbody>";

foreach ($produtos as $produto => $quantidade) {
     if($quantidade<= $estoqueMinimo){
    echo "<tr>";
    echo "<td>" . htmlspecialchars($produto) . "</td>";
    echo "<td>" . htmlspecialchars($quantidade) . "</td>";

    echo "<td>";
    if ($quantidade < $estoqueMinimo) {
        $faltando = $estoqueMinimo - $quantidade;
        $porcentagem = ($faltando / $estoqueMinimo) * 100;
        echo "<span class='warning'>⚠ Faltam $faltando unidades (" . round($porcentagem, 1) . "%)</span>";
    } else {
        echo "Estoque OK";
    }
    echo "</td>";
    echo "</tr>";
}
}

echo "</tbody>";
echo "</table>";

/*
$produtos = [
    "Interruptor" => 3,
    "Tomada" => 12,
    "Cabo Flexível 2.5mm" => 3,
    "Disjuntor" => 7,
    "Sensor de Presença" => 12,
];

$estoqueMinimo = 10;

$soma = array_sum($produtos);
$quantidade = count($produtos);
$media = $soma / $quantidade;

echo "<h2>A média das quantidades é: " . round($media, 2) . "</h2>";

$produtos_repor = 0;
foreach ($produtos as $qtd) {
    if ($qtd < $estoqueMinimo) {
        $produtos_repor++;
    }
}
$porcentagem_repor = ($produtos_repor / count($produtos)) * 100;
echo "<h2>É necessário repor o estoque de " . round($porcentagem_repor, 2) . "% dos produtos.</h2>";

echo "<table border='1' cellpadding='10' cellspacing='0'>";
echo "<thead><tr><th>Produto</th><th>Estoque</th><th>Status</th></tr></thead>";
echo "<tbody>";

foreach ($produtos as $produto => $quantidade) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($produto) . "</td>";
    echo "<td>" . htmlspecialchars($quantidade) . "</td>";

    echo "<td>";
    if ($quantidade < $estoqueMinimo) {
        $faltando = $estoqueMinimo - $quantidade;
        $porcentagem = ($faltando / $estoqueMinimo) * 100;
        echo "<span class='warning'>⚠ Faltam $faltando unidades ($porcentagem%)</span>";
    } else {
        echo "Estoque OK";
    }
    echo "</td>";
    echo "</tr>";
}

echo "</tbody>";
echo "</table>";
?>
