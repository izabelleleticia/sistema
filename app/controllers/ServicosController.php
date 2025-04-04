<?php


class ServicosController extends Controller
{
    private $servicoModel;
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $this->servicoModel = new Servico();
    }

    public function index()
    {
        $dados = array();
        $dados['titulo'] = 'Servicos - Site Mestre Motores';
    
        // Buscar todos os serviços
        $dados['todosServico'] = $this->servicoModel->getTodosServico();
    
        // Buscar serviços aleatórios (por exemplo, 3 serviços)
        $dados['servicosRandomicos'] = $this->servicoModel->getServicoRand();
    
        // Carregar a view com os dados
        $this->carregarViews('servicos', $dados);
    }
    

    public function detalheServico($id)
    {
        // var_dump($id);
        $linkServico = $this->gerarLinkServico($id);
        $dadosServico = $this->servicoModel -> getDadosServico($id);

        if ($dadosServico) {
            $dados['titulo'] = $dadosServico['nome_servico'] . ' - Mestre Motores';
            $dados['detalhe'] = $dadosServico;
            $this->carregarViews('detalheServico', $dados);

        } else {
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
    public function listar()
    {

        $dados = array();
        $dados['conteudo'] = 'admin/servico/listar';


        $dados['servicos'] = $this->servicoModel->getTodosServico();
        // var_dump($dados['servicos']);
        //View sempre última
        $this->carregarViews('admin/index', $dados);
    }

    public function adicionar()
    {
        $dados = array();
    
       
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome_servico = filter_input(INPUT_POST, 'nome_servico', FILTER_SANITIZE_SPECIAL_CHARS);
            $descricao_servico = filter_input(INPUT_POST, 'descricao_servico', FILTER_SANITIZE_SPECIAL_CHARS);
            $valor_servico = filter_input(INPUT_POST, 'valor_servico', FILTER_SANITIZE_NUMBER_FLOAT);
            $tempo_exec_servico = filter_input(INPUT_POST, 'tempo_exec_servico', FILTER_SANITIZE_SPECIAL_CHARS);
            $alt_tipo = $nome_servico;
            $tipo_servico = filter_input(INPUT_POST, 'tipo_servico', FILTER_SANITIZE_SPECIAL_CHARS);
            $id_especialidade = filter_input(INPUT_POST, 'id_especialidade', FILTER_SANITIZE_NUMBER_INT);
            $status_servico = filter_input(INPUT_POST, 'status_servico', FILTER_SANITIZE_SPECIAL_CHARS);
    
           
            if ($nome_servico && $descricao_servico) {
    
                var_dump($_FILES['foto_servico']); 
    
              
                $arquivo = null;
                if (isset($_FILES['foto_servico']) && $_FILES['foto_servico']['error'] == 0) {
                    
                    $arquivo = $this->uploadFoto($_FILES['foto_servico'], $nome_servico);
                    var_dump($arquivo); 
                }
    
             
                $dadosServico = array(
                    'nome_servico' => $nome_servico,
                    'descricao_servico' => $descricao_servico,
                    'valor_servico' => $valor_servico,
                    'tempo_exec_servico' => $tempo_exec_servico,
                    'alt_tipo' => $alt_tipo,
                    'tipo_servico' => $tipo_servico,
                    'id_especialidade' => $id_especialidade,
                    'status_servico' => $status_servico,
                    'foto_servico' => $arquivo
                );
    
            
                $idServico = $this->servicoModel->addServico($dadosServico);
    
              
                if ($idServico) {
                    $_SESSION['mensagem'] = 'Serviço adicionado com sucesso';
                    $_SESSION['tipo_msg'] = 'sucesso';
                    header('Location: http://localhost/sistema/public/servicos/listar');
                    exit;
                } else {
                    $_SESSION['mensagem'] = 'Erro ao adicionar o serviço - Ao enviar para a base de dados';
                    $_SESSION['tipo_msg'] = 'erro';
                    header('Location: http://localhost/sistema/public/servicos/adicionar');
                    exit;
                }
            } else {
             
                $_SESSION['mensagem'] = 'Erro ao adicionar o serviço - Informe todos os dados';
                $_SESSION['tipo_msg'] = 'erro';
                header('Location: http://localhost/sistema/public/servicos/adicionar');
                exit;
            }
        }

        


           // Buscar as especialidades
           $especialidade = new Especialidade();
           $dados['especialidade'] = $especialidade->getTodasEspecialidades();
           var_dump($dados['especialidade']);  
    
        $dados['conteudo'] = 'admin/servico/adicionar';
        $this->carregarViews('admin/index', $dados);
    }

    
        public function uploadFoto($file, $nome)
    {

        $dir = 'public/uploads/servico/';
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $nome_foto = uniqid() . $nome . '.' . $ext;
        if (move_uploaded_file($file['tmp_name'], $dir . $nome_foto)) {
            return 'servico/' . $nome_foto;
        }
        return false;
    }

     // 3 - Método para editar Servico
     public function editar($id = null){
        $dados = array();
 
        $dadosServico = $this->servicoModel->getDadosServico($id);
        
 
        // Se carregamento da página está vindo don FORM
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
                $id_servico = filter_input(INPUT_POST, 'id_servico', FILTER_SANITIZE_SPECIAL_CHARS);
                $nome_servico = filter_input(INPUT_POST, 'nome_servico', FILTER_SANITIZE_SPECIAL_CHARS);
                $descricao_servico = filter_input(INPUT_POST, 'descricao_servico', FILTER_SANITIZE_SPECIAL_CHARS);
                $valor_servico = filter_input(INPUT_POST, 'valor_servico', FILTER_SANITIZE_NUMBER_FLOAT);
                $tempo_exec_servico = filter_input(INPUT_POST, 'tempo_exec_servico', FILTER_SANITIZE_SPECIAL_CHARS);
                $alt_tipo = $nome_servico;
               
                $id_especialidade = filter_input(INPUT_POST, 'id_especialidade', FILTER_SANITIZE_NUMBER_INT);
                $status_servico = filter_input(INPUT_POST, 'status_servico', FILTER_SANITIZE_SPECIAL_CHARS);
 
            if($nome_servico && $descricao_servico){
 
                if($dadosServico['foto_servico'] == ''){
                    if(isset($_FILES['foto_servico']) && $_FILES['foto_servico']['error'] == 0){
 
                        // Realizar o upload da imagem
                        $arquivo = $this->uploadFoto($_FILES['foto_servico'], $nome_servico);
   
                    }
                } else {
                    $arquivo = $dadosServico['foto_servico'];
                }
 
               
 
                $dadosServico = array(
                    'id_servico' => $id_servico,
                    'nome_servico' => $nome_servico,
                    'descricao_servico' => $descricao_servico,
                    'valor_servico' => $valor_servico,
                    'tempo_exec_servico' => $tempo_exec_servico,
                    'alt_tipo' => $alt_tipo,

                    'id_especialidade' => $id_especialidade,
                    'status_servico' => $status_servico,
                    'foto_servico' => $arquivo
                );
                
 
                // EDITAR NA BASE DE DADOS
 
                $idServico = $this->servicoModel->editarServico($dadosServico);
 
                if($idServico){
                    $_SESSION['mensagem'] = 'Serviço editado com sucesso';
                    $_SESSION['tipo-msg'] = 'sucesso';
                    header('Location: http://localhost/sistema/public/servicos/listar');
                    exit;
 
                }else{
                    $dados['mensagem'] = 'Erro ao editar o serviço - Ao enviar para a base de dados';
                    $dados['tipo-msg'] = 'erro';
 
                }
 
            }else{
                $dados['mensagem'] = 'Erro ao editar o serviço - Informe todos os dados';
                $dados['tipo-msg'] = 'erro';
            }
 
        }
 
       
 
        
        $dados['dadosServico'] = $dadosServico;
 
        if(!$dadosServico){
            header('Location: '.BASE_URL.'servicos/listar');
            exit;
            // var_dump($dadosServico);
        }
 
        // Buscar as especialidades
        $especialidade = new Especialidade();
        $dados['especialidade'] = $especialidade->getTodasEspecialidades();
 
        $dados['conteudo'] = 'admin/servico/editar';
 
        $this->carregarViews('admin/index', $dados);
    }
}