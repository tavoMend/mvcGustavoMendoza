<?php

namespace Dao\Carros;

use Dao\Table;

class Carros extends Table{
    public static function obtenerCarros(){
        $sqlstr='SELECT * FROM carros1;';
        $carros=self::obtenerRegistros($sqlstr,[]);
        return $carros;
    }
    public static function obtenerCarroPorId($id){
        $sqlstr='SELECT * FROM carros1 where codigo =:codigo;';
        $carro= self::obtenerUnRegistro($sqlstr,["codigo"=> $id]);
        return $carro;
        
    }

    public static function agregarCarro($carro){
        
        
        unset($carro['codigo']);
        unset($carro['creado']);
        unset($carro['actualizado']);
        
        $sqlstr='insert into carros1 (
          modelo, marca, 
          anio, kilometraje, chasis, 
          color, registro, cilindraje, 
          notas, rodeje, estado, 
          creado,precioventa,preciominimo, 
          actualizado
        )values
        ( :modelo, :marca, :anio, :kilometraje, :chasis, 
          :color, :registro, :cilindraje, :notas, :rodeje, 
          :estado, now(), :precioventa, :preciominimo, now()
        );';
        return self::executeNonQuery($sqlstr,$carro);
    }

    public static function actualizarCarro($carro)
    {
        unset($carro['creado']);
        unset($carro['actualizado']);
        $sqlstr = "update carros1 set modelo = :modelo, marca = :marca, anio = :anio, kilometraje = :kilometraje, 
            chasis = :chasis, color = :color, registro = :registro, cilindraje = :cilindraje, notas = :notas,
            rodeje = :rodeje, estado = :estado, precioventa = :precioventa, preciominimo = :preciominimo, 
            actualizado = now() where codigo = :codigo;";

        return self::executeNonQuery($sqlstr, $carro);
    }

    public static function eliminarCarro($codigo)
    {
        $sqlstr = "delete from carros1 where codigo = :codigo;";
        return self::executeNonQuery($sqlstr, ["codigo" => $codigo]);
    }

}