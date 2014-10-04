 

<div class="contLista">
	<div class="superLista">
	
		<div class="leftListCont"> <!-- Div filtro  -->
		
<!--   -->
		


		
		
<!--   -->
				
		</div>
		 
		<div class="rightListCont"> <!-- Div del listado  -->
		 
		 	<label>Buscar: </label>
		 	<input type="search" id="input-filter" size="15" placeholder="Buscador">
		
		
			<table id="tablaDemo" class="tablesorter">
				<thead>
					<tr>
						<th class="header tablesorter-header" scope="col" title="Prueba de Listas">Orden</th>
						<th class="header tablesorter-header" scope="col">Apellido</th>
						<th class="header tablesorter-header" scope="col">Nombre</th>
						<th class="header tablesorter-header" scope="col">Edad</th>
						<th class="header tablesorter-header" scope="col">Zona</th>
						<th class="header tablesorter-header" scope="col">Sexo</th>
						<th scope="col">Perfil</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>Perez</td>
						<td>Juan</td>
						<td>23</td>
						<td>CABA</td>
						<td>Masculino</td>
						<td><a href="#">Ver</a></td>
					</tr>
					<tr>
						<td>2</td>
						<td>Gomez</td>
						<td>Lucrecia</td>
						<td>22</td>
						<td>Lanus</td>
						<td>Test</td>
						<td><a href="#">Ver</a></td>
					</tr>
					
					<tr>
						<td>3</td>
						<td>Peralta</td>
						<td>Horacio</td>
						<td>23</td>
						<td>San Isidio</td>
						<td>Masculino</td>
						<td><a href="#">Ver</a></td>
					</tr>
					<tr>
						<td>4</td>
						<td>Baez</td>
						<td>Ana</td>
						<td>21</td>
						<td>CABA</td>
						<td>Femenino</td>
						<td><a href="#">Ver</a></td>
					</tr>
				</tbody>
			</table>
		 	<script src="js/jq-2.1.1.js"></script>
			<script src="js/jq.filtertable.min.js"></script>
			<script src="js/jq.tablesorter.js"></script>
			<script src="js/dropdownmenu.js"></script>
			<script>
			$(document).ready(function() {
				$('#tablaDemo').filterTable({ // apply filterTable to all tables on this page
				inputSelector: '#input-filter', // use the existing input instead of creating a new one
				minRows: 1
				});
			});
			$(document).ready(function() 
				    { 
				        $("#tablaDemo").tablesorter({widthFixed: true, widgets: ['zebra'], headers: { 6:{sorter: false}} }) 
				    } 
				); 
		</script>
		
		</div>
		
		
	</div>
</div>