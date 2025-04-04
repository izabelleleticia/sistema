<?php


class HomeController extends Controller{

    
    public function index(){
        $dados = array();
        $dados['titulo'] = 'Site Mestre Motores';

        //Obter os serviços de forma RAND()
        $servicoModel = new Servico();
        $randServico = $servicoModel->getServicoRand();

        
        // var_dump($randServico);
        $dados ['randServico'] = $randServico;

        // var_dump($dados);

        $this->carregarViews('home', $dados);
       
    }


}