<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD DE PRODUCTOS</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<main class="container" id="vue-container">
    <h1>CRUD DE PRODUCTOS {{ message}}</h1>
    <div class="general row">
        <div class="col-lg-6">    
            <div id="form-producto">
            <h2>Formulario Producto</h2>
            <div class="row">
                <div class="form-group col-lg-6 col-xs-12">
                    <label for="nombre">Nombre</label>
                    <input type="text" v-model="formProducto.nombre" id="nombre" class="form-control" @blur="validarForm">
                </div>
                <div class="form-group  col-lg-6 col-xs-12">
                    <label for="referencia">Referencia</label>
                    <input type="text" v-model="formProducto.referencia" id="referencia" class="form-control" @blur="validarForm">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-12 col-xs-12">
                    <label for="categoria">Categoria</label>
                    <select v-model="formProducto.categoria" id="categoria" class="form-control"@change="validarForm" >
                        <option value="">Seleccione...</option>
                        <option v-for="categoria in categoriasList" :value="categoria.value">{{categoria.text}}</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-6 col-xs-12">
                    <label for="precio">Precio</label>
                    <input type="text" v-model="formProducto.precio" id="precio" class="form-control" @blur="validarForm" @keydown='onlyNumbers'>
                </div>
                <div class="form-group  col-lg-6 col-xs-12">
                    <label for="stock">Stock</label>
                    <input type="text" v-model="formProducto.stock" id="stock" class="form-control" @blur="validarForm"  @keydown='onlyNumbers'>
                </div>                
            </div>
            <button type="submit" :disabled="btnCrearProductoDisabled" @click="submitForm" class="btn btn-primary">Enviar</button>
            <button @click="cancelarEditarProducto" v-show="idProducto > 0" class="btn btn-danger">Cancelar</button>
        </div>
    </div>
        <div class="col-lg-6">
            <h2>Formulario Categoría</h2>
            <div class="row">
                <div class="form-group col-lg-12">
                    <label for="nueva_categoria">Nueva Categoría</label>
                    <input type="text" @keyup="handleOnChange" v-model="formCategoria.nombre" id="nueva_categoria" class="form-control">
                </div>
                <div class="col-lg-12">
                    <button type="submit" :disabled="btnCrearCategiaDisabled" @click="crearCategoria" class="btn btn-primary">Crear</button> 
                </div>
            </div>        
        </div>
    </div>
    <table class="table mt-5">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Referencia</th>
            <th scope="col">Precio</th>
            <th scope="col">Stock</th>
            <th scope="col">Categoría</th>
            <th scope="col">Fecha Creación</th>
            <th scope="col">Última Venta</th>
            <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="producto in productosList">
            <th scope="row">{{producto.producto_id}}</th>
            <td>{{producto.producto_nombre}}</td>
            <td>{{producto.producto_referencia}}</td>
            <td>{{producto.producto_precio}}</td>
            <td>{{producto.producto_stock}}</td>
            <td>{{producto.categoria_nombre}}</td>
            <td>{{producto.fecha_creacion}}</td>
            <td>{{producto.fecha_ult_venta}}</td>
            <td>
                <button @click="editarProducto(producto)"  class="btn btn-primary">Editar</button>
                <button @click="deleteProducto(producto.producto_id, producto.producto_nombre)" class="btn btn-danger">Eliminar</button>
            </td>
            </tr>
        </tbody>
    </table>
</main>
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="index.js"></script>
</body>
</html>