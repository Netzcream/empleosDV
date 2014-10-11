<link href="css/footable.standalone.css" rel="stylesheet" type="text/css" />
<link href="css/footable.core.min.css" rel="stylesheet" type="text/css" />
<script src="js/footable.js" type="text/javascript"></script>
<script src="js/footable.sort.js" type="text/javascript"></script>
<script src="js/footable.paginate.js" type="text/javascript"></script>
<script src="js/footable.filter.js" type="text/javascript"></script>

<link type="text/css" rel="stylesheet" href="css/bootstrap.css"></link>
		
			<p class="buscarTable"><input id="filter" type="text" placeholder="Buscar..."/></p>
			<table class="tablaDemo breakpoint table toggle-circle toggle-medium" data-page-size="10" data-filter="#filter" data-filter-text-only="true">
				<thead>
					<tr>
						<th style="width: 40px;" class="footable-first-column" title="Prueba de Listas" data-sort-ignore="true">Orden</th>
						<th  data-toggle="true">Apellido</th>
						<th >Nombre</th>
						<th data-hide="phone">Edad</th>
						<th data-hide="phone">Zona</th>
						<th data-hide="phone">Sexo</th>
						<th class="footable-last-column" data-sort-ignore="true">Perfil</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
						<img alt="" src="imagenes/no_perfil.png" width="40">
						</td>
						<td>Perez</td>
						<td>Juan</td>
						<td>23</td>
						<td>CABA</td>
						<td>Masculino</td>
						<td><a href="#">Ver</a></td>
					</tr>
					<tr>
						<td>
						<img alt="" src="imagenes/no_perfil.png" width="40">
						</td>
						<td>Gomez</td>
						<td>Lucrecia</td>
						<td>22</td>
						<td>Lanus</td>
						<td>Test</td>
						<td><a href="#">Ver</a></td>
					</tr>
					
					<tr>
							<td>
						<img alt="" src="imagenes/no_perfil.png" width="40">
						</td>
						<td>Peralta</td>
						<td>Horacio</td>
						<td>23</td>
						<td>San Isidio</td>
						<td>Masculino</td>
						<td><a href="#">Ver</a></td>
					</tr>
					<tr>
					<td>
						<img alt="" src="imagenes/no_perfil.png" width="40">
						</td>
						<td>Baez</td>
						<td>Ana</td>
						<td>21</td>
						<td>CABA</td>
						<td>Femenino</td>
						<td><a href="#">Ver</a></td>
					</tr>
					<?php 
					
					for ($i=0;$i <=30;$i++) {
echo "<tr>
	<td>
						<img alt='' src='imagenes/no_perfil.png' width='40'>
						</td>
<td>Baez</td>
<td>Ana</td>
<td>21</td>
<td>CABA</td>
<td>Femenino</td>
<td><a href='#'>Ver</a></td>
</tr>";
					}
					
					?>
				</tbody>
					<tfoot>
		<tr>
			<td colspan="7">
				<div  class="pagination pagination-centered hide-if-no-paging"></div>
			</td>
		</tr>
	</tfoot>
				
				
			</table>
	
	
	
	
	
	
	
	
	<script type="text/javascript">
	$(function () {
		$('.tablaDemo').footable({
			addRowToggle: true
			})

		
		
	
	});

	
</script>