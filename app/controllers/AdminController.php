<?php

class AdminController extends Controller
{


    public function index()
    {
        $dados = array();
        $dados['titulo'] = 'Dashboard | Mestre Motores';

        $this->carregarViews('admin/index', $dados);

    }


    
   

}