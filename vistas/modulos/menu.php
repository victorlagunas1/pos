<aside class="main-sidebar">

	<section class="sidebar">

		<ul class="sidebar-menu">



				<li>

				<a href="crear-venta2">

					<i class="fa fa-shopping-cart"></i>
					<span>Crear Venta</span>

				</a>
				
			</li>

			<li>

				<a href="reparaciones-sucursal">

					<i class="fa fa-wrench"></i>
					<span>Reparaciones</span>
					

				</a>
				
			</li>

		<!-- 	<li>

				<a href="refacciones">

					<i class="fa fa-wrench"></i>
					<span>Refacciones</span>
					

				</a>
				
			</li>
 -->


<!-- 			<li class="treeview">

				<a href="#">

					<i class="fa fa-percent"></i>
					<span>Cotizaciones</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>

				</a>

				<ul class="treeview-menu">
 -->
				<li>
					<a href="cotizaciones">
						<i class="fa fa-percent"></i>
						<span>Precio reparaciones</span>
					</a>
				</li>


				<!-- <li>
					<a href="cotizacion-cliente">
						<i class="fa fa-file"></i>
						<span>Generar cotización</span>
					</a>
				</li> -->
			
<!-- 
					<li>
					<a href="cotizacion-cliente">
						<i class="fa fa-circle-o"></i>
						<span>Cotización cliente</span>
					</a>
				</li>
			</ul>


		</li> -->

			<li class="treeview">

				<a href="#">

					<i class="fa fa-th"></i>
					<span>Categorias y modelos</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>

				</a>

				<ul class="treeview-menu">

					<li>

				<a href="categorias">

					<i class="fa fa-th"></i>
					<span>Categorias y diseño</span>

				</a>
				
			</li>


				<li>

				<a href="marca-modelos">

					<i class="fa fa-phone"></i>
					<span>Marcas y modelos</span>

				</a>
				
			</li>

		</ul>


</li>
			

			<li>

				<a href="productos">

					<i class="fa fa-product-hunt"></i>
					<span>Productos</span>

				</a>
				
			</li>

<!-- 			<li>

				<a href="clientes">

					<i class="fa fa-users"></i>
					<span>Clientes</span>

				</a>
				
			</li> -->

					<li>
					<a href="ventasdia-sucursal">
						<i class="fa fa-cart-arrow-down"></i>
						<span>Corte del día</span>
					</a>
				</li>


				<?php

if($_SESSION["perfil"] == "Administrador"  ){

  echo 	'
			<li>

				<a href="inicio">

					<i class="fa fa-home"></i>
					<span>Resumen</span>

				</a>

			</li>';

}

?>




			<?php

if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Administrador de Sucursal"){

  echo 	'
			


			<li class="treeview">

				<a href="#">

					<i class="fa fa-adn"></i>
					<span>Administrador</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>

				</a>

				<ul class="treeview-menu">	

				<li>
					<a href="facturacion">
						<i class="fa fa-file-pdf-o"></i>
						<span>Facturación</span>
					</a>
				</li> 

				<li>
					<a href="clientes">
						<i class="fa fa-users"></i>
						<span>Clientes</span>
					</a>
				</li> 

					

				

				<li>
						<a href="ventas">

						<i class="fa fa-line-chart"></i>
						<span>Administrar Ventas</span>

					</a>

				</li>


		

				<li>
					<a href="promocionales">
						<i class="fa fa-ticket"></i>
						<span>Promocionales</span>
					</a>
				</li>

				</ul>

				';

}

?>



<?php

if($_SESSION["perfil"] == "Administrador"){

		date_default_timezone_set('America/Mexico_City');
		$hoy = date("Y-m-d");


  echo 	'
			


			<li class="treeview">

				<a href="#">

					<i class="fa fa-line-chart"></i>
					<span>Finanzas</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>

				</a>

				<ul class="treeview-menu">

					<li>
				
					<a href="index.php?ruta=finanzas&fechaInicial='.$hoy.'&fechaFinal='.$hoy.'">
						<i class="fa fa-area-chart"></i>
						<span>Actividades</span>
					</a>
				</li>

					<li>
						<a href="gastosparciales">

						<i class="fa fa-bar-chart"></i>
						<span>Gastos parciales</span>

					</a>

				</li>

				
				
				<li>
					<a href="nomina">
						<i class="fa fa-users"></i>
						<span>Nomina</span>
					</a>
				</li>

				<li>
					<a href="estadisticos">
						<i class="fa fa-pie-chart"></i>
						<span>Estadisticos</span>
					</a>
				</li>

			

				<li>
					<a href="index.php?ruta=sucursales-estadistico&fechaInicial='.$hoy.'&fechaFinal='.$hoy.'">
						<i class="fa fa-pie-chart"></i>
						<span>Rendimiento</span>
					</a>
				</li>

						<li>
					<a href="reportes">
						<i class="fa fa-download"></i>
						<span>Reporte de ventas</span>
					</a>
				</li>

				</ul>

				';

}

?>


<?php

if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Administrador de Sucursal"){

  echo 	'
			


			<li class="treeview">

				<a href="#">

					<i class="fa fa-cog"></i>
					<span>Configuración</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>

				</a>

				<ul class="treeview-menu">

					<li>
				<a href="usuarios">

					<i class="fa fa-user"></i>
					<span>Usuarios</span>

				</a>
				
			</li>

			<li>
				<a href="sucursales">

					<i class="fa fa-building-o"></i>
					<span>Sucursales</span>

				</a>
				
			</li>

			<li>
				<a href="inventario">

					<i class="fa fa-barcode"></i>
					<span>Escanear invetario</span>

				</a>
				
			</li>

	
	</ul>

</li>

			

				';

}

?>

	

			

		</ul>


	</section>

</aside>