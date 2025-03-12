<?php


class Controller{
    public function carregarViews($views, $dados = array()){

        extract($dados);

        require_once '../app/views/'.$views.'.php';
        // require_once '../app/views/home.php'.$views. $dados;
                        //../app/views/home.php

    }



}
