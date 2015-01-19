				<script type="text/javascript" src="js/jq.min1.7.2.js"></script>
						<script type="text/javascript" src="js/jq.Jcrop.min.js"></script>
		<div class="demo">
				<div class="titleSelRol">Cargar imagen de perfil</div>
					<div class="bbody">

					<!-- upload form -->
					<form id="upload_form" enctype="multipart/form-data" method="post" target="LoadTheForm" action="php/perfilUpload.php" onsubmit="return checkForm();">
						<!-- hidden crop params -->
						<input type="hidden" id="x1" name="x1" />
						<input type="hidden" id="y1" name="y1" />
						<input type="hidden" id="x2" name="x2" />
						<input type="hidden" id="y2" name="y2" />

						<input type="file" name="image_file" id="image_file" onchange="fileSelectHandler()" />
						<input type="button" class="perfilBtnSeeMyCV" value="Cargar imagen" onclick="$('#image_file').click();">
						<div class="error"></div>

						<div class="step2">
							<label class="labelFillDP">Previsualizaci&oacute;n</label>
							<img id="preview" />
							<br>
							<div class="hidden">
							<input class="hidden"  type="text" id="filesize" name="filesize" />
								<input class="hidden"  type="text" id="filetype" name="filetype" />
								 <input class="hidden"  type="text" id="filedim" name="filedim" />
								<input class="hidden" type="text" id="w" name="w" />
								<input class="hidden" type="text" id="h" name="h" />
							</div>

							<input class="perfilBtnSeeMyCV" type="submit" value="Subir" />
							<div id="loadAllAndClose"></div>
							<iframe id="iframeAdios" name="LoadTheForm"></iframe>
						</div>
                </form>
            </div>
        </div>
        
        <script>


        </script>