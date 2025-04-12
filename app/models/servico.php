<?php
//O modelo contém a lógica da aplicação, como regras de negócio, persistência com o banco de dados e classes de entidade
class Servico extends Model
{

    //Listar 4 serviços de forma RAND()
    public function getServicoRand($limite = 4)
    {

        $sql = "SELECT * FROM (select * from tbl_servico where status_servico ='ATIVO' order by RAND() Limit :limite) as sub order by nome_servico";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    
    public function getTodosServico()
    {
        $sql = "SELECT 
        tbl_servico.id_servico, 
        tbl_servico.nome_servico, 
        tbl_servico.descricao_servico, 
        tbl_servico.valor_servico, 
        tbl_servico.tempo_exec_servico, 
        tbl_servico.foto_servico, 
        tbl_servico.alt_tipo, 
        tbl_servico.tipo_servico, 
        tbl_servico.status_servico, 
        tbl_especialidade.nome_especialidade  
    FROM tbl_servico  
    INNER JOIN tbl_especialidade 
        ON tbl_servico.id_especialidade = tbl_especialidade.id_especialidade 
    WHERE tbl_servico.status_servico = 'ATIVO' 
    ORDER BY tbl_servico.nome_servico LIMIT 10";


        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //Pegar dados do serviço pelo ID
    public function getDadosServico($id)
    {
        $sql = "SELECT * FROM tbl_servico WHERE id_servico = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }



    public function addServico($dados)
    {
        $sql = "INSERT INTO tbl_servico (nome_servico, descricao_servico, valor_servico, tempo_exec_servico, foto_servico, alt_tipo, tipo_servico, id_especialidade, status_servico) 
                VALUES (:nome_servico, :descricao_servico, :valor_servico, :tempo_exec_servico,  :foto_servico, :alt_tipo, :tipo_servico, :id_especialidade, :status_servico)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome_servico', $dados['nome_servico'], PDO::PARAM_STR);
        $stmt->bindValue(':descricao_servico', $dados['descricao_servico'], PDO::PARAM_STR);
        $stmt->bindValue(':valor_servico', $dados['valor_servico'], PDO::PARAM_STR);
        $stmt->bindValue(':tempo_exec_servico', $dados['tempo_exec_servico'], PDO::PARAM_INT);
        $stmt->bindValue(':foto_servico', $dados['foto_servico'], PDO::PARAM_STR);
        $stmt->bindValue(':alt_tipo', $dados['alt_tipo'], PDO::PARAM_STR);
        $stmt->bindValue(':tipo_servico', $dados['tipo_servico'], PDO::PARAM_STR);
        $stmt->bindValue(':id_especialidade', $dados['id_especialidade'], PDO::PARAM_INT);
        $stmt->bindValue(':status_servico', $dados['status_servico'], PDO::PARAM_STR);

        var_dump($dados['status_servico']);


        return $stmt->execute();
    }
    

    public function editarServico($dados) {
        $sql = "UPDATE tbl_servico SET 
                nome_servico = :nome,
                descricao_servico = :descricao,
                valor_servico = :valor,
                tempo_exec_servico = :tempo,
                alt_tipo = :alt,
                id_especialidade = :especialidade,
                status_servico = :status";
    
        // Verifica se a foto foi enviada para ser atualizada
        if (!empty($dados['foto_servico'])) {
            $sql .= ", foto_servico = :foto_servico";  // Adiciona a coluna foto_servico no SQL
        }
        
        // Adiciona a cláusula WHERE
        $sql .= " WHERE id_servico = :id";
    
        // Prepara a consulta
        $stmt = $this->db->prepare($sql);
    
        // Faz o binding dos parâmetros
        $stmt->bindValue(':id', (int)$dados['id_servico'], PDO::PARAM_INT);
        $stmt->bindValue(':nome', $dados['nome_servico']);
        $stmt->bindValue(':descricao', $dados['descricao_servico']);
        $stmt->bindValue(':valor', $dados['valor_servico']);
        $stmt->bindValue(':tempo', $dados['tempo_exec_servico']);
        $stmt->bindValue(':alt', $dados['alt_tipo']);
        $stmt->bindValue(':especialidade', $dados['id_especialidade']);
        $stmt->bindValue(':status', $dados['status_servico']);
    
        // Se a foto não estiver vazia, faz o binding do valor
        if (!empty($dados['foto_servico'])) {
            $stmt->bindValue(':foto_servico', $dados['foto_servico']);
        }
    
        // Executa a consulta e retorna o resultado
        return $stmt->execute();
    }
    
    
    
public function desativarServico($id)
{
   
    $sql = "UPDATE tbl_servico SET status_servico = 'DESATIVADO' WHERE id_servico = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    return $stmt->execute();
}

    
}
