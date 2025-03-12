<?php


class ContatoController extends Controller{

    
    public function index(){
        $dados = array();
        $dados['titulo'] = 'Contato Mestre Motores';

        $this->carregarViews('contato', $dados);
       
    }


}