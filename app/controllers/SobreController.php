<?php


class SobreController extends Controller{

    
    public function index(){
        $dados = array();
        $dados['titulo'] = 'Site Mestre Motores';

        $this->carregarViews('sobre', $dados);
       
    }


}