<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Producto;

class Productos extends Component
{
    public $productos, $descripcion, $cantidad, $id_producto;
    public $modal = false;

    public function render()
    {
        $this->productos = Producto::all();
        return view('livewire.productos');
    }

    public function crear()
    {
        $this->limpiarCampos();
        $this->abrirModal();
    }
    public function abrirModal(){

        $this->modal=true;
    }
    public function cerrarModal(){

        $this->modal=false;
    }
    public function limpiarCampos(){

        $this->descripcion= '';
        $this->cantidad= '';
        $this->id_productos= '';
    }
public function editar($id){
$producto = Producto::findOrFail($id);
$this->id_producto = $id;
$this->descripcion= $producto->descripcion;
$this->cantidad= $producto->cantidad;
$this->abrirModal();
}
public function borrar($id){
    Producto::find($id)->delete();
}
public function guardar(){
    Producto::updateOrCreate(['id'=>$this->id_producto],
    [
        'descripcion' =>$this->descripcion,
        'cantidad' =>$this->cantidad,
    ]);

    session()->flash('message',
            $this->id_producto ? '¡Actualización exitosa!' : '¡El producto ha sido guardado exitosamente!');

    $this->cerrarModal();
    $this->limpiarCampos();
}

}
