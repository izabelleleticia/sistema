<?php require_once('template/topo.php') ?>

<body>
  <!-- Cabeçalho -->
  <header>
    <?php require_once('template/banner.php'); ?>
    <?php require_once('template/menu.php'); ?>
  </header>

  <!-- Conteúdo principal -->
  <section class="servico wow animate__animated animate__backInUp" data-wow-delay=".3s">
    <article class="site">
      <div class="textoServiço">
        <div>
          <h3>Cuidando do Coração do Seu Veículo</h3>
          <h2>Serviços Mestre Motores</h2>
        </div>
        <button>ver todos os serviços</button>
      </div>

      <div class="conteudoServico list-servico">
        <?php foreach ($dados['servicosRandomicos'] as $linha): ?>
          <div>
            <a href="servicos/detalheServico/<?php echo htmlspecialchars($linha['id_servico'], ENT_QUOTES, 'UTF-8'); ?>">
              <img src="<?php
                $caminhoImg = $_SERVER['DOCUMENT_ROOT'] . '/sistema/public/uploads/' . $linha['foto_servico'];
                if ($linha['foto_servico'] != "") {
                  echo file_exists($caminhoImg) ? "uploads/".$linha['foto_servico'] : 'uploads/semfoto.png';
                } else {
                  echo 'uploads/semfoto.png';
                }
              ?>" alt="<?php echo htmlspecialchars($linha['nome_servico'], ENT_QUOTES, 'UTF-8'); ?>" />
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

  <!-- Scripts no final da página -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
