<?php

class Especialidade extends Model{
    public function getTodasEspecialidades(){
        $sql = "SELECT * from tbl_especialidade WHERE status_especialidade = 'ATIVO' ORDER BY nome_especialidade ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
