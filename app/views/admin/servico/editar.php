<form class="row g-3" method="POST" enctype="multipart/form-data"
      action="<?php echo BASE_URL; ?>servicos/editar/<?php echo $dadosServico['id_servico']; ?>">

    <div class="col-md-3 text-center">
        <img id="preview" src="<?php echo BASE_URL . 'uploads/' . $dadosServico['foto_servico']; ?>" 
             alt="Imagem do Serviço"
             style="width: 100%; cursor: pointer;"
             title="Clique na imagem para selecionar uma foto">

        <input type="file" name="foto_servico" id="foto_servico" style="display: none;" accept="image/*">        
    </div>

    <div class="col-md-9">
        <div class="row">
            <div class="col-12">
                <label for="nome_servico" class="form-label">Nome do Serviço</label>
                <input type="text" class="form-control" id="nome_servico" name="nome_servico" required 
                       value="<?php echo $dadosServico['nome_servico']; ?>">
            </div>

            <div class="col-12">
                <label for="descricao_servico" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao_servico" name="descricao_servico" rows="3" required>
                    <?php echo trim($dadosServico['descricao_servico']); ?>
                </textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="valor_servico" class="form-label">Valor</label>
                <input type="number" step="0.01" min="0" class="form-control" id="valor_servico" 
                       name="valor_servico" required value="<?php echo $dadosServico['valor_servico']; ?>">
            </div>

            <div class="col-md-6">
                <label for="tempo_exec_servico" class="form-label">Tempo de Execução</label>
                <input type="time" class="form-control" id="tempo_exec_servico" name="tempo_exec_servico" required 
                       value="<?php echo $dadosServico['tempo_exec_servico']; ?>">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <label for="alt_tipo" class="form-label">Tipo</label>
                <input type="text" class="form-control" id="alt_tipo" name="alt_tipo" required 
                       value="<?php echo $dadosServico['alt_tipo']; ?>">
            </div>

            <div class="col-md-4">
                <label for="id_especialidade" class="form-label">Especialidade</label>
                <select class="form-select" id="id_especialidade" name="id_especialidade" required>
                    <option value="" disabled selected>Selecione uma especialidade</option>
                    <?php foreach ($especialidade as $linha): ?>
                        <option value="<?php echo $linha['id_especialidade']; ?>"
                            <?php echo ($linha['id_especialidade'] == $dadosServico['id_especialidade']) ? 'selected' : ''; ?>>
                            <?php echo $linha['nome_especialidade']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-4">
                <label for="status_servico" class="form-label">Status</label>
                <select class="form-select" id="status_servico" name="status_servico" required>
                    <option value="<?php echo $dadosServico['status_servico']; ?>" selected>
                        <?php echo $dadosServico['status_servico']; ?>
                    </option>
                    <option value="ATIVO">ATIVO</option>
                    <option value="INATIVO">INATIVO</option>
                    <option value="DESATIVADO">DESATIVADO</option>
                </select>
            </div>
        </div>

        <div class="col-md-12" style="display: flex; justify-content: space-between; margin-top: 20px;">
            <button type="submit" class="btn btn-primary">Editar Serviço</button>
            <button type="reset" class="btn btn-danger">Limpar</button>
        </div>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const previewImg = document.getElementById('preview');
    const fileInput = document.getElementById('foto_servico');

    previewImg.addEventListener("click", function () {
        fileInput.click();
    });

    fileInput.addEventListener('change', function () {
        if (fileInput.files && fileInput.files[0]) {
            let reader = new FileReader();
            reader.onload = function (e) {
                previewImg.src = e.target.result;
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    });
});
</script>
