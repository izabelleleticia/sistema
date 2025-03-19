<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['mensagem']) && isset($_SESSION['tipo_msg'])) {
    $mens = $_SESSION['mensagem'];
    $tipo = $_SESSION['tipo_msg'];

    if ($tipo == 'sucesso') {
        echo '<div class="alert alert-success" role="alert">' . $mens . "</div>";
    } elseif ($tipo == 'erro') {
        echo '<div class="alert alert-danger" role="alert">' . $mens . "</div>";
    }

    unset($_SESSION['mensagem']);
    unset($_SESSION['tipo_msg']);
}
?>




<a href="http://localhost/sistema/public/servicos/adicionar" class="btn btn-primary">Cadastrar Serviço</a>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Foto</th>
            <th scope="col">Serviço</th>
            <th scope="col">Descrição</th>
            <th scope="col">Valor (R$)</th>
            <th scope="col">Tempo de execução</th>
            <th scope="col">Tipo</th>
            <th scope="col">Especialidade</th>
            <th>EDITAR</th>
            <th>DESATIVAR</th>

        </tr>
    </thead>
    <tbody>
        <?php


        foreach ($servicos as $linha): ?>
            <tr>
                <td scope="col">
                    <?php
                    $caminhoBase = "http://localhost/sistema/public/uploads/";
                    $caminhoFoto = $caminhoBase . $linha['foto_servico'];

                    if ($linha['foto_servico'] != '') {
                        $urlFoto = $caminhoFoto;
                    } else {
                        $urlFoto = $caminhoBase . 'semfoto.png';
                    }


                    ?>
                    <img src="<?php echo $urlFoto; ?>" class="img-thumbnail" alt="<?php echo $linha['nome_servico']; ?>">
                </td>
                <td scope="col"><?php echo $linha['nome_servico']; ?></td>
                <td scope="col"><?php echo $linha['descricao_servico']; ?></td>
                <td scope="col"><?php echo $linha['valor_servico']; ?></td>
                <td scope="col"><?php echo $linha['tempo_exec_servico']; ?></td>
                <td scope="col"><?php echo $linha['tipo_servico']; ?></td>
                <td scope="col"><?php echo $linha['id_especialidade']; ?></td>
                <td scope="col"><?php echo $linha['id_servico']; ?></td>
                <td scope="col"><?php echo $linha['id_especialidade']; ?></td>
                <td><?php echo $linha['id_servico']; ?></td>
                <td><?php echo $linha['id_servico']; ?></td>
            </tr>
        <?php endforeach; ?>



    </tbody>
</table>