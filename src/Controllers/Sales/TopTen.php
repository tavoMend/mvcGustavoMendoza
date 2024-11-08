<?php

namespace Controllers\sales;


use controllers\PublicController;
use views\Renderer;


class TopTen extends PublicController{
    public function run():void{
        $viewData=[
            "nombre_programado"=>'Orlando J betancourt',
            "clases"=>[
            'Programacion de portales web 1 ',
            'Programacion de portales web 2 '
            ],
        "contactos"=> [
            ["nombre"=>"Fulano",
            "telefono"=>"763726"],
            ["nombre"=>"Fulano",
            "telefono"=>"763726"],
            ]

        
        ];
        

        Renderer::render('sales/top10', $viewData);
    }
}


