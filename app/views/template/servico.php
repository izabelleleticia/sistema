<section class="servico wow animate__animated animate__backInUp" data-wow-delay=".3s">
    <article class="site">
        <div class="textoServiço">
            <div>
                <h3>Cuidando do Coração do Seu Veículo</h3>
                <h2>Serviços Mestre Motores</h2>
            </div>
            <button>ver todos os serviços</button>
        </div>
        <div class="conteudoServico">
            <?php foreach ($randServico as $linha): ?>
                
                <div>
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
                </div>

            <?php endforeach; ?>



        </div>
    </article>
</section>