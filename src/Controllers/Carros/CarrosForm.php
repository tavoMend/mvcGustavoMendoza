<?php


namespace Controllers\Carros;

use Controllers\Funciones\Funcion;
use Controllers\PublicController;
use Dao\Carros\Carros;
use Views\Renderer;
use Utilities\Site;

class CarrosForm extends PublicController{

    private $viewData=[];
    private $modeDscArr=[
        "INS"=>"Crear nuevo carro ",
        "UPD"=>"Editando %s (%s)",
        "DSP"=>"Detalle de %s (%s)",
        "DEL"=>"Eliminando %s (%s)",

    ];
    private $mode='';

    private$carro=[
        "codigo"=> 0 ,
        "modelo"=>'' ,
        "marca"=>'' , 
        "anio" =>0, 
        "kilometraje"=>0 ,
        "chasis"=> '', 
        "color"=>'' ,
        "registro"=>'' ,
        "cilindraje"=> 0, 
        "notas"=>  '',
        "rodeje"=>'' ,
        "estado"=> 'ACT',
        "creado"=>  null,
        "precioventa"=>0 ,
        "preciominimo"=>0 ,
        "actualizado"=> null
    ];
    

    public function run(): void
    {
        // ciclo de vida del formulario
        
        $this->inicializarForm();
        if($this->isPostBack()){
            $this->cargarDatosDelFormulario();
            $this->procesarAccion();
        }
        $this->generarViewData();
        Renderer::render('carros/carros_form', $this->viewData);
    }
    private function inicializarForm(){
        if(isset($_GET["mode"]) && isset($this->modeDscArr[$_GET["mode"]])) {
            $this->mode = $_GET["mode"];
        }else{
            
            Site::redirectToWithMsg("index.php?page=Carros-CarrosList","Algo Sucedio Mal Intente de nuevo");
            die();
        }
        if($this->mode!=='INS' && isset($_GET["codigo"])){
            $this->carro["codigo"]=$_GET["codigo"];
            $this->cargarDatosCarro();

            

        }


    }

    private function cargarDatosCarro(){
        $tmpCarro=  Carros::obtenerCarroPorId($this->carro ["codigo"]);
        $this->carro=$tmpCarro;
           
    }

    private function cargarDatosDelFormulario()
    {
        $this->carro["modelo"] = $_POST["modelo"];
        $this->carro["marca"] = $_POST["marca"];
        $this->carro["anio"] = intval($_POST["anio"]);
        $this->carro["kilometraje"] = intval($_POST["kilometraje"]);
        $this->carro["chasis"] = $_POST["chasis"];
        $this->carro["color"] = $_POST["color"];
        $this->carro["registro"] = $_POST["registro"];
        $this->carro["cilindraje"] = intval($_POST["cilindraje"]);
        $this->carro["notas"] = $_POST["notas"];
        $this->carro["rodeje"] = $_POST["rodeje"];
        $this->carro["estado"] = $_POST["estado"];
        $this->carro["precioventa"] = floatval($_POST["precioventa"]);
        $this->carro["preciominimo"] = floatval($_POST["preciominimo"]);
    }

    private function procesarAccion()
    {
        switch ($this->mode) {
            case 'INS':
                $result = Carros::agregarCarro($this->carro);
                if ($result) {
                    Site::redirectToWithMsg("index.php?page=Carros-CarrosList", "Carro registrado satisfactoriamente");
                }
                break;
            case 'UPD':
                $result = Carros::actualizarCarro($this->carro);
                if ($result) {
                    Site::redirectToWithMsg("index.php?page=Carros-CarrosList", "Carro actualizado satisfactoriamente");
                }
                break;
            case 'UPD':
                $result = Carros::eliminarCarro($this->carro['$codigo']);
                if ($result) {
                    Site::redirectToWithMsg("index.php?page=Carros-CarrosList", "Carro eliminado satisfactoriamente");
                }
                break;    
            
        }

    }
    private function generarViewData(){
        $this->viewData["modes_dsc"]=sprintf(
        $this->modeDscArr[$this->mode],
        $this->carro["modelo"],
        $this->carro["codigo"]
    );
    $this->viewData["carro"]=$this-> carro;
    }
}