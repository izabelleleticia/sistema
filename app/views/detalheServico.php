<?php require_once('template/topo.php') ?>

<body class=""><!--Inicio do corpo-->
    <!--Inicio Cabeçalho-->
    <header>
        <!--banner-->
        <?php require_once('template/banner.php'); ?>
        <!--menu-->
        <?php require_once('template/menu.php'); ?>
    </header>
    <!-- Inicio conteudo -->
   

   
<section class="servico wow animate__animated animate__backInUp" data-wow-delay=".3s">
    <article class="site">
        <div class="textoServiço">
            <div>
                <h2><?php echo $detalhe['nome_servico']; ?></h2>
                <h3>Home <span>Serviços</span></h3>
            </div>
            <button>ver todos os serviços</button>
        </div>
        <div class="conteudoServico list-servico">
            <?php foreach ($todosServico as $linha): ?>
                
                <div>
                   
                    <a href="servicos/detalheServico/<?php echo htmlspecialchars($linha['id_servico'], ENT_QUOTES, 'UTF-8'); ?>">
    <?php echo htmlspecialchars($linha['id_servico'], ENT_QUOTES, 'UTF-8'); ?>


                    <img src="<?php

                    $caminhoImg = $_SERVER['DOCUMENT_ROOT'] . '/sistema/public/uploads/' . $linha['foto_servico'];
                    

                    if ($linha['foto_servico'] != "") { 
                        if (file_exists($caminhoImg)) { 
                            echo "uploads/".$linha['foto_servico'];
                        }   else {
                            echo 'uploads/semfoto.png';
                        }
                     } else {
                        echo 'uploads/semfoto.png';
                    }
                    


                     //>assets/img/fotoServico1.png"

                    //     alt="<?php echo htmlspecialchars($linha['alt_servico'], ENT_QUOTES, 'UTF-8'); ?>" />
                    <div>
                        <h4><?php echo htmlspecialchars($linha['nome_servico'], ENT_QUOTES, 'UTF-8'); ?></h4>
                        <p><?php echo htmlspecialchars($linha['descricao_servico'], ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                    </a>
                </div>

            <?php endforeach; ?>



        </div>
    </article>
</section>
<?php require_once('template/rodape.php'); ?>