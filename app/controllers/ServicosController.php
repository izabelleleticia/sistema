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
    public function adicionar(){
        $dados = array();

        //se carregamento da página está vindo do form
        if($_SERVER['REQUEST_METHOD'] ==='POST'){

            //Dados dos campos de input - name
            $nome_servico = filter_input(INPUT_POST, 'nome_servico', FILTER_SANITIZE_SPECIAL_CHARS);
            $descricao_servico = filter_input(INPUT_POST, 'descricao_servico', FILTER_SANITIZE_SPECIAL_CHARS);
            $valor_servico = filter_input(INPUT_POST, 'valor_servico', FILTER_SANITIZE_NUMBER_FLOAT);
            $tempo_exec_servico = filter_input(INPUT_POST, 'tempo_exec_servico', FILTER_SANITIZE_SPECIAL_CHARS);
            $alt_servico = $nome_servico;
            $tipo_servico = filter_input(INPUT_POST, 'tipo_servico', FILTER_SANITIZE_SPECIAL_CHARS);
            $id_especialidade = filter_input(INPUT_POST, 'id_especialidade', FILTER_SANITIZE_NUMBER_INT);
            $status_servico = filter_input(INPUT_POST, 'status_servico', FILTER_SANITIZE_SPECIAL_CHARS);
            $foto_servico = filter_input(INPUT_POST, 'foto_servico', FILTER_SANITIZE_SPECIAL_CHARS);

            var_dump($nome_servico);
            var_dump($descricao_servico);
            var_dump($valor_servico);
            var_dump($tempo_exec_servico);
            var_dump($alt_servico);
            var_dump($tipo_servico);
            var_dump($id_especialidade);
            var_dump($status_servico);

            // var_dump('Vim do form');
        }
        $dados['conteudo'] = 'admin/servico/adicionar';

        $this->carregarViews('admin/index', $dados);
    }
}