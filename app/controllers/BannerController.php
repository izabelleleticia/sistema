<?php
class BannerController extends Controller
{
    private $bannerModel;

    public function __construct()
    {
        $this->bannerModel = new Banner();
    }

    public function listar()
    {
        // Criando uma matriz que guardará o título, o caminho e os banners
        $dados = array();
        $dados['titulo'] = 'Banner | Mestre Motores';
        $dados['conteudo'] = 'admin/banner/listar';

        // A chave 'banner' dentro da matriz $dados receberá os dados retornados pela função getTodosBanner
        // A função getTodosBanner está declarada no Model e busca todos os banners para exibição
        $dados['banner'] = $this->bannerModel->getTodosBanner();
        // var_dump($dados['banner']); // (Comentado para fins de debug)

        // Carrega a view principal passando os dados
        $this->carregarViews('admin/index', $dados);
    }
}
