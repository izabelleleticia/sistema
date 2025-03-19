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
        $sql = "SELECT * FROM tbl_servico where status_servico = 'ATIVO' order by nome_servico";
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

    //Método para Adicionar um Serviço

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
        $stmt->bindValue(':status_servico', $dados['status_servico'], PDO::PARAM_INT);
      

        return $stmt->execute();

    }
}