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
    <main>
        <!--Inicio do Sobre-->
        <?php require_once('template/sobre.php'); ?>
        <!-- Fim do Sobre -->
        </section>
        <!--Inicio dos Serviços-->
        <?php require_once('template/servico.php'); ?>
        <!-- Fim dos Serviços -->
        <!--Inicio Especialidades-->
        <?php require_once('template/especialidade.php'); ?>
        <!--Fim especialidades-->

        <!--Inicio Galeria-->
        <?php require_once('template/galeria.php'); ?>
        <!--Fim Galeria-->
        <!--Inicio do Blog-->
        <?php require_once('template/blog.php'); ?>
        <!-- Fim do Blog -->
    </main>

    <?php require_once('template/rodape.php'); ?>