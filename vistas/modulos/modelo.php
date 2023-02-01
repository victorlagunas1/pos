

<div class="content-wrapper">



  <section class="content-header">

    
    <h1>
      
      Administrar marcas y modelos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar marcas y modelos</li>
    
    </ol>

  </section>

  <section class="content">
    <div class="row">

  <div class="col-md-12 col-xs-12">
    
    <div class="box box-warning">

      <div class="box-header with-border">
  
        <button class="btn btn-warning" data-toggle="modal" data-target="#modalNuevaMarca">
          
          Nueva marca

        </button>

      </div>
      
      <div class="box-body">
        
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Categoria</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $categorias = ControladorCategorias::ctrMostrarMarcas($item, $valor);

          foreach ($categorias as $key => $value) {
           
            echo ' <tr>

                    <td>'.($key+1).'</td>

                  

                    <td class="text-uppercase">'.$value["marca"].'</td>

            
                   <td>

                   <div class="btn-group">';
                        
                   if($_SESSION["perfil"] == "Administrador"){

                       echo '<button class="btn btn-warning btnEditarMarca" idMarcaEditar="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarMarca"><i class="fa fa-pencil"></i></button>

                        <button class="btn btn-danger btnEliminarMarca" idMarcaEditar="'.$value["id"].'"><i class="fa fa-times"></i></button> ';}

                     echo' </div>  

                    </td>

                  </tr>';
          }

        ?>

        

        </tbody>



       </table>



      </div>

    </div>

  </div>

 


  </section>




</div>











