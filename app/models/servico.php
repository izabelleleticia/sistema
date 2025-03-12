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

}