<?php


class ServicosController extends Controller
{
    private $servicoModel;
    public function __construct(){

        $this->servicoModel = new Servico();
    }

    public function index()
    {
        $dados = array();
        $dados['titulo'] = 'Servicos - Site Mestre Motores';

       
        $todosServico = $this->servicoModel->getTodosServico();
        $dados['todosServico'] = $todosServico;
        $this->carregarViews('servicos', $dados);

    }
    public function detalheServico  ($id)
    {
        // var_dump($id);
        $linkServico = $this->gerarLinkServico($id);
        $dadosServico = $this->servicoModel-getDadosServico($id);
        
        if($dadosServico){
            $dados['titulo'] = $dadosServico['nome_servico'] . ' - Mestre Motores';
            $dados['detalhe'] = $dadosServico;
            $this->carregarViews('detalheServico', $dados);
            
        }else{
            $dados['titulo'] = ' Serviços - Mestre Motores';
            $this->carregarViews('detalheServico', $dados);
        }



        // var_dump($linkServico);
        $dados = array();
        $dados['titulo'] = 'Servicos = Site Mestre Motores';

        $this->carregarViews('detalheServico', $dados);
    }
    public function gerarLinkServico($id)
    {
        $servicoModel = new Servico();
        $dadosServico = $servicoModel->getDadosServico($id);
        $link = strtolower(trim(preg_replace('/[^a-zA-z0-9]/', '-', $dadosServico['nome_servico'])));

        $link = $link . '-' . $id;

        return $link;
    }


    //BACK-END DASHBOARD SERVIÇO

    //MÉTODO LISTAR TODOS OS SERVIÇOS
    public function listar(){

        $dados = array();
        $dados['conteudo'] = 'admin/servico/listar';
        

        $dados['servicos'] = $this->servicoModel->getTodosServico();
        // var_dump($dados['servicos']);







        //View sempre última
        $this->carregarViews('admin/index', $dados);
    }
}