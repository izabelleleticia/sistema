<h1>Cadastro de serviços</h1>
<form class="row g-3" method="POST" action="http://localhost/sistema/public/servicos/adicionar"
    enctype="multipart/form-data">

<div class="col-md-2 ">
        <img id="preview" class="rounded-2" src="http://localhost/sistema/public/uploads/servico/" alt="" style="width:100%; cursor: pointer;"
            title="Clique na imagem para selecionar uma foto">
            <input type="file" name="foto_servico" id="foto_servico" style="display:none;" accept="image/">

    </div>

    <div class="col-md-6">
        <label for="inputName" class="form-label">Nome</label>
        <input type="text" class="form-control" id="nome_servico" name="nome_servico" required>
    </div>
   
    <div class="col-md-6">
        <label for="inputDescription" class="form-label">Descrição</label>
        <input type="text" class="form-control" id="descricao_servico" name ="descricao_servico" required>
    </div>
    <div class="col-md-6">
        <label for="inputAddress" class="form-label">Valor</label>
        <input type="number" class="form-control" id="valor_servico" name="valor_servico" required>
    </div>
    <div class="col-md-6">
        <label for="inputAddress2" class="form-label">Tempo de execução</label>
        <input type="time" class="form-control" id="tempo_exec_servico" name="tempo_exec_servico" required>
    </div>
    <div class="col-md-6">
        <label for="inputCity" class="form-label">Tipo</label>
        <input type="text" class="form-control" id="tipo_servico" name="tipo_servico" required>
    </div>
    <div class="col-md-4">
        <label for="inputState" class="form-label">Status</label>
        <select id="inputState" class="form-select" id="status_servico" name="status_servico" required>
            <option selected>Insira o status</option>
            <option value="ATIVO">ATIVO</option>
            <option value="INATIVO">INATIVO</option>
            <option value="DESATIVADO">DESATIVADO</option>
        </select>
    </div>
    <div class="col-md-4">
    <label for="inputState" class="form-label">Especialidade</label>
    <select id="inputState" class="form-select" id="id_especialidade" name="id_especialidade" required>
        <option value="">Insira a Especialidade</option>
        <?php foreach ($especialidade as $linha): ?>
            <option value="<?php echo $linha['id_especialidade']; ?>">
                <?php echo $linha['nome_especialidade']; ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

   

    <div class="col-12">
        <button type="submit" class="btn btn-primary">Cadastrar</button>
        <button type="submit" class="btn btn-secondary">Cancelar</button>


    </div>

</form>
<script>
    
    document.addEventListener('DOMContentLoaded', function () {

        const visualizarImg = document.getElementById('preview');
        const arquivo = document.getElementById('foto_servico');

        visualizarImg.addEventListener('click', function () {
            arquivo.click();
        })

        arquivo.addEventListener('change', function (){
            if (arquivo.files && arquivo.files[0]){
                let render = new FileReader();
                render.onload = function(e){
                    visualizarImg.src = e.target.result
                }
                render.readAsDataURL(arquivo.files[0])
            }
        })
    })
</script>