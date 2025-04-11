<?php
    if(session_status() == PHP_SESSION_NONE){
      session_start();
    }
    if(isset ($_SESSION['mensagem']) && isset ($_SESSION['tipo-msg'])) {
      //Exibir Mensagem
 
      $mens = $_SESSION['mensagem'];
      $tipo = $_SESSION['tipo-msg'];
 
      if($tipo == 'sucesso'){
 
        echo '<div class="alert alert-success" role="alert">' . $mens . '</div>';
 
      }else if($tipo == 'erro'){
 
        echo '<div class="alert alert-danger" role="alert">' . $mens . '</div>';
 
      }
 
      unset($_SESSION['mensagem']);
      unset($_SESSION['tipo-msg']);
    }
 
 
?>
<a href="http://localhost/sistema/public/servicos/adicionar" class="btn btn-primary">Cadastrar Servico</a>
 
<table class="table table-dark table-striped">
  <thead>
    <tr>
        <th scope="col">Foto</th>
        <th scope="col">Servico</th>
        <th scope="col">Descrição</th>
        <th scope="col">Valor (R$)</th>
        <th scope="col">Tempo Execução</th>
        <th scope="col">Tipo</th>
        <th scope="col">Especialidade</th>
        <th>Editar</th>
        <th>Desativar</th> 
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
 
              if($linha['foto_servico'] != '') {
                  // Verifica se a imagem existe na URL
                  if(@getimagesize($caminhoFoto)) {
                      $urlFoto = $caminhoFoto;
                  } else {
                      // Caso não exista, utiliza a imagem padrão
                      $urlFoto = $caminhoBase . 'semfoto.png';
                  }
              } else {
                  // Se não houver foto no banco de dados, utiliza a imagem padrão
                  $urlFoto = $caminhoBase . 'semfoto.png';
              }
 
 
              //$urlFoto =  $linha['foto_servico'] != '' && file_exists($caminhoFoto)
              //? $caminhoFoto : $caminhoBase . 'semfoto.png';
 
            ?>
            <div class="img-tbl">
            <img src="<?php echo $urlFoto; ?> " class="img-thumbnail" alt="<?php echo $linha['nome_servico']; ?>">
            </div>
          </td>
          <td scope="col"><?php echo $linha['nome_servico'];?></td>
          <td scope="col"><?php echo $linha['descricao_servico'];?></td>
          <td scope="col"><?php echo $linha['valor_servico'];?></td>
          <td scope="col"><?php echo $linha['tempo_exec_servico'];?></td>
          <td scope="col"><?php echo $linha['tipo_servico'];?></td>
          <td scope="col"><?php echo $linha['nome_especialidade'];?></td>
          <td>
            <a href="http://localhost/sistema/public/servicos/editar/<?php echo $linha['id_servico'];?>"
              type ="button" class="btn btn-primary"><i class="bi bi-pencil-fill"></i></a>
          </td>
          <td>
            <a href="#"
              type ="button" class="btn btn-danger" title="Desativar"
              onclick="abrirModal(<?php echo $linha['id_servico']; ?>); return false;">
              <i class="bi bi-trash-fill"></i>
            </a>
          </td>
      </tr>
 
    <?php  endforeach ?>
   
  </tbody>
</table>
 
 
 
<!-- Modal -->
<div class="modal fade" id="desativarModal" tabindex="-1" aria-labelledby="desativarModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="desativarModalLabel">Desativar Serviço</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h2>Deseja realmente desativar o serviço?</h2>
        <input type="hidden" id="idParaDesativar" value="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnDesativar">Desativar</button>
      </div>
    </div>
  </div>
</div>
 
 <script>document.addEventListener('DOMContentLoaded', function(){

function abrirModal(id_servico) {
  // Verifica se o modal já está aberto
  const modalElement = document.getElementById('desativarModal');
  const modal = new bootstrap.Modal(modalElement);

  // Se o modal não estiver visível, o abre
  if (!modalElement.classList.contains('show')) {
    document.getElementById('idParaDesativar').value = id_servico;
    modal.show();
  }
}

document.getElementById('btnDesativar').addEventListener('click', function(){
  const idServico = document.getElementById('idParaDesativar').value;
  if(idServico){
    console.log("Id recuperado: " + idServico);
    desativarServico(idServico);
  }
});

function desativarServico(idServico){
  fetch(`http://localhost/sistema/public/servicos/desativar/${idServico}`,{
    method: 'POST',
    headers:{
      'Content-Type': 'application/json'
    }
  })
  .then(response => {
    if(!response.ok){
      throw new Error(`Erro HTTP: ${response.status}`);
    }
    return response.json();
  })
  .then(data => {
    // Resposta com sucesso
    const modal = bootstrap.Modal.getInstance(document.getElementById('desativarModal'));
    modal.hide();
    location.reload();
  })
  .catch(error => {
    alert("Erro na requisição. Verifique a conexão com o servidor");
  })
}

window.abrirModal = abrirModal;
});
</script>
