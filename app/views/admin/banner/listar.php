<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Foto</th>
            <th scope="col">Nome</th>
            <th scope="col">Status</th>
            <th>EDITAR</th>
            <th>DESATIVAR</th>

        </tr>
    </thead>
    <tbody></tbody>
    <?php
    

    foreach ($banner as $linha): ?>


        <tr>
            <td scope="col">
                <?php
                $caminhoBase = "http://localhost/sistema/public/uploads/";
                $caminhoFoto = $caminhoBase . $linha['foto_banner'];

                if ($linha['foto_banner'] != '') {
                    $urlFoto = $caminhoFoto;
                } else {
                    $urlFoto = $caminhoBase . 'semfoto.png';
                }

                ?>
                <img src="<?php echo $urlFoto; ?>" class="img-thumbnail" alt="<?php echo $linha['nome_banner']; ?>">
                
            </td>
            <td scope="col"><?php echo $linha['nome_banner']; ?></td>
            <td scope="col"><?php echo $linha['status_banner']; ?></td>
            <td><?php echo $linha['id_banner']; ?></td>
            <td><?php echo $linha['id_banner']; ?></td>
        </tr>


    <?php endforeach; ?>