<?php
//O modelo contém a lógica da aplicação, como regras de negócio, persistência com o banco de dados e classes de entidade
class Banner extends Model
{

    public function getTodosBanner()
    {
        $sql = "SELECT * FROM tbl_banner where status_banner = 'ATIVO' order by nome_banner";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    //Pegar dados do banner pelo ID
    public function getDadosBanner($id)
    {
        $sql = "SELECT * FROM tbl_banner WHERE id_banner = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}