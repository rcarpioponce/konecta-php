var urlBase = 'http://localhost/producto-crud/controller/';
var urlBaseCategoria = `${urlBase}categoriaController.php`;
var urlBaseProducto = `${urlBase}productoController.php`;
var app = new Vue({
    el: '#vue-container',
    data: {
      formCategoria:{
        nombre: ''
      },
      formProducto:{
          id:0,
          nombre:'',
          referencia:'',
          categoria: '',
          precio: 1,
          stock: 1
      },
      idProducto:0,
      btnCrearProductoDisabled: true,
      btnCrearCategiaDisabled: true,
      message: '',
      categoriasList: [],
      productosList: []
    },
    created: function() {
      this.getCategoriasList();
      this.getProductosList();
    },
    methods:{
      onlyNumbers (evt) {
        const charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57) && !(charCode > 95 && charCode < 106)) {
          evt.preventDefault()
        }
        return true
      },
      validarVacio (valor){
          valor = ''+valor;
        if(valor.trim() === ''){
          return false
        }
        return true
      },
      validarForm (){
        var self = this.formProducto;
        var res = this.validarVacio(self.nombre) 
                  && this.validarVacio(self.referencia) 
                  && this.validarVacio(self.categoria) 
                  && this.validarVacio(self.precio) 
                  && this.validarVacio(self.stock)                
        this.btnCrearProductoDisabled = !res;
      },
      handleOnChange(){
          if(this.formCategoria.nombre.trim().length >= 2){
              this.btnCrearCategiaDisabled = false;
          }else{
              this.btnCrearCategiaDisabled = true;
          }
      },
      crearCategoria(evt){
        evt.preventDefault();
        this.btnCrearCategiaDisabled = true;
        var self = this;
        axios.post(
            `${urlBaseCategoria}?action=add`, 
            self.formCategoria,
            {
              headers: { 
                "Content-Type": "application/x-www-form-urlencoded"
              }
            }          
          ).then(function(response){
            if(response.data.success){
              window.alert("registro satisfactorio");
              self.formCategoria.nombre = '';
              self.btnCrearCategiaDisabled = true;
              self.getCategoriasList()
            }
          })        
      },
      submitForm (evt){
        evt.preventDefault();
        var self = this;
        self.btnCrearProductoDisabled = true;
        if(this.idProducto == 0){
            axios.post(
                `${urlBaseProducto}?action=add`, 
                self.formProducto,
                {
                  headers: { 
                    "Content-Type": "application/x-www-form-urlencoded"
                  }
                }          
              ).then(function(response){
                if(response.data.success){
                  window.alert("registro satisfactorio");
                  self.formProducto.nombre = '';
                  self.formProducto.referencia = '';
                  self.formProducto.categoria = '';
                  self.formProducto.stock = 1;
                  self.formProducto.precio = 1;
                  self.getProductosList();
                }
              }) 
        }else{
            this.handleEditarProducto()
        }
       
        //console.log(this.form);
      },
      getCategoriasList(){
        var self = this;
        axios.get(`${urlBaseCategoria}?action=list`).then(function(response){
          self.categoriasList = response.data;
        })
      },
      getProductosList(){
        var self = this;
        axios.get(`${urlBaseProducto}?action=list`).then(function(response){
          self.productosList = response.data;
        })     
      },
      deleteProducto(id, nombre){
          if( confirm(`desea eliminar el producto ${nombre}`)) {
              var self = this;
              axios.post(`${urlBaseProducto}?action=delete`,{
                  id:id
              },
              {
                headers: { 
                  "Content-Type": "application/x-www-form-urlencoded"
                }
              } ).then(function(response){
                  self.getProductosList();
              })
          }
      },
      editarProducto(producto){
        this.idProducto = producto.producto_id;
        this.formProducto.id = producto.producto_id;
        this.formProducto.nombre = producto.producto_nombre;
        this.formProducto.referencia = producto.producto_referencia;
        this.formProducto.categoria = producto.categoria_id;
        this.formProducto.precio = producto.producto_precio;
        this.formProducto.stock = producto.producto_stock;
      },
      handleEditarProducto(){
        var self = this;
        axios.post(`${urlBaseProducto}?action=edit`,self.formProducto,
        {
          headers: { 
            "Content-Type": "application/x-www-form-urlencoded"
          }
        } ).then(function(response){
            self.idProducto = 0;
            self.formProducto.id = 0;
            self.formProducto.nombre = '';
            self.formProducto.referencia = '';
            self.formProducto.categoria = '';
            self.formProducto.stock = 1;
            self.formProducto.precio = 1;            
            window.alert("actualizacion satisfactoria");
            self.getProductosList();
        })           
      },
      cancelarEditarProducto(){
          this.idProducto = 0; 
          var self = this;
          self.formProducto.id = 0;
          self.formProducto.nombre = '';
          self.formProducto.referencia = '';
          self.formProducto.categoria = '';
          self.formProducto.stock = 1;
          self.formProducto.precio = 1;                   
      }      
    }
  })