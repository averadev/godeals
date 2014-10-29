<?php
$this->load->view('admin/vwHeader');
?>

<div class="row">
	<div class="small-12 medium-12 large-12 columns">
    	<div class="page-header header">
        	<h1><small>Place</small></h1>
        	<hr/>
    	</div>
    </div>
    
    <div class="place">
            <!--- division "viewPublicity" que muestra la lista de publicidad --->
            <div id="viewPlace" >
            	<div class="row">
            		<div class="large-12 columns">
                    
                    	<!--- divicion del buscador --->
                		<div id="buscar" class="row collapse">
                    		<div class="small-8 medium-10 large-10 columns">
                        		<input class="txtSearch" id="txtSearchPlace" type="text" 
                                placeholder="Busqueda por nombre, ciudad o clave" />
                            </div>
                            <div class="small-4 medium-2 large-2 columns">
                            	<button class="btnSearch" id="btnSearchPlace">
                                <img src="../assets/img/web/iconSearch.png">Buscar
                                </button>
                            </div>
                        </div> <!---fin de la divicion del buscador --->
                        
                        <!---muestra los mensajes que indican que se inserto los datos --->
                        <div class="large-11" id="divMenssage" style="display:none">
							<div data-alert class="alert-box success" id="alertMessage">
							</div>
						</div>
						<div class="large-11" id="divMenssagewarning" style="display:none">
							<div data-alert class="alert-box warning" id="alertMessagewarning">
								¿Desea eliminar el lugar?
								<button id="btnCancelC" class="btnCancelE">Cancelar</button>
								<button id="btnCancelC" class="btnAcceptE">Aceptar</button>
							</div>
						</div>
                        <!--- fin de los mensajes --->
                        
                        <!--- divicion que muestra la tabla de publicidad ---> 
                        <div id="tabla" >
                        	<table id="tablePlace">
                            	<thead>
                                	<tr>
                                    	<td class="titulo" colspan="7">Place
                                        	<button id="btnAddPlace" class="btnAdd">Agregar</button>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<th>#</th>
                                        <th width="250px">Nombre</th>
                                        <th width="150px">Ciudad</th>
                                       	<th width="250px">Titulo</th>
                                        <th width="150px">Clave</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                            	<tbody>
                                	<?php
                                    	$con = 0;
										foreach($place as $item):
											$con++;
									?>
                                    		<tr>
                                            	<td><?php echo $con; ?></td>
                                                <td>
                                                	<a id="showPlace"><?php echo $item->name;?>
                                                    <input type="hidden" id="idplace" value="<?php echo $item->id;?>" >
                                                    </a>
                                                </td>
                                                <td><?php echo $item->nameCity;?></td>
                                                <td><?php echo $item->title;?></td>
                                                <td><?php echo $item->weatherKey;?></td>
												<td>
                                                	<a id="imageDelete" value="<?php echo $item->id;?>">
                                            			<img class="imgDelete" src="../assets/img/web/deleteRed.png"/>
                                                    </a>
                                                </td>
                                            </tr>
                                    <?php 
										 endforeach;
										 $totalPaginador = intval($total/10);
										 if($total%10 == 0){
											$totalPaginador = $totalPaginador - 1;		
										 }
									?>
                                </tbody>
                            </table>
                            <!--- muestra la paginacion --->
                            <ul class="pagination">
  								<li id="btnPaginadorPlace" value="0" class="btnPaginador arrow primero unavailable">
                                <a>&laquo;</a></li>
                                <?php 
								for($i = 1;$i<=($totalPaginador+1);$i++){
									if($i == 1){
									?>
                                    <li value="<?php echo $i ?>" id="btnPaginadorPlace" class="btnPaginador current">
                                    <a><?php echo $i ?></a></li>
                                    <?php
									}
									else {
									?>
                                    <li value="<?php echo $i ?>" id="btnPaginadorPlace" class="btnPaginador">
                                    <a><?php echo $i ?></a></li>
                                    <?php	
									}
								}
								?>
  								<li value="<?php echo ($totalPaginador+1) ?>" id="btnPaginadorPlace" 
                                class="btnPaginador arrow ultimo"><a>&raquo;</a></li>
							</ul>
                            <!--- fin del paginador --->
                        </div> <!--- fin de la divicion tabla --->
                    </div>
                </div>    
            </div><!--- fin div "viewPublicity" --->
            
            
            <!--- division "FormPublicity" --->
            <!--- muestra el formulario para agregar y modificar publicidades --->
            <div id="FormPlace" style="display:none">
            	<div class="row">
                    
                    <div class="small-12 medium-12 large-12 columns">
                    	<!--- primera columna --->
                		<div class="small-12 medium-6 large-6 columns">
                        
							<div class="row">
                        		<div class="small-12 medium-11 large-10 columns">
                            		<label class="field" id="lblPlaceName">*Nombre
                                		<input type="text" id="txtPlaceName" class="radius"/>
                               		</label>
                                	<small id="alertName" class="error" style="display:none">
                                    	Campo vacio. Por favor escriba el nombre del lugar
                                	</small>
                            	</div>
							</div>
                        	<div class="row">
                        		<div class="small-12 medium-11 large-10 columns">
                            		<label class="field" id="lblPlaceCity">*Ciudad
                                		<input type="text" id="txtPlaceCity" list="cityList" 
                                        autocomplete="on" class="radius"/>
                                        <datalist id="cityList"> </datalist>
                               		</label>
                                	<small id="alertCity" class="error" style="display:none">
                                    	ciudad incorrecto. Por favor escriba una ciudad existente
                                	</small>
                            	</div>
                        	</div>
                           	<div class="row">
                        		<div class="small-12 medium-11 large-10 columns">
                            		<label class="field" id="lblPlaceTitle">*Titulo
                                		<input type="text" id="txtPlaceTitle" class="radius"/>
                               		</label>
                                	<small id="alertTitle" class="error" style="display:none">
                                    	Campo vacio. Por favor escriba el titulo del lugar
                                	</small>
                            	</div>
							</div>
                            <div class="row">
                        		<div class="small-12 medium-11 large-10 columns">
                            		<label class="field" id="lblPlaceTxtMin">*Texto minimo
                                        <textarea id="txtPlaceTxtMin" class="radius" rows="8"></textarea>
                               		</label>
                                	<small id="alertTxtMin" class="error" style="display:none">
                                    	Campo vacio. Por favor escriba el texto
                                	</small>
                            	</div>
							</div>
                            <div class="row">
                        		<div class="small-12 medium-11 large-10 columns">
                            		<label class="field" id="lblPlaceTxtMax">*Texto Maximo
                                        <textarea id="txtPlaceTxtMax" class="radius" rows="8"></textarea>
                               		</label>
                                	<small id="alertTxtMax" class="error" style="display:none">
                                    	Campo vacio. Por favor escriba el texto
                                	</small>
                            	</div>
							</div>
                            <div class="row">
                                <div class="small-12 medium-12 large-12 columns">
      								<button  id="btnAssignTrade" class="bntSave button small success radius ">
      								Asignar Comercio</button>
                                    <button  id="btnGaleria" class="bntSave button small success radius ">
      								Galeria</button>
                                </div>
							</div>

                    	</div> <!--- fin primera columna --->
                        
                        <!--- segunda columna columna --->
                     	<div class="small-12 medium-6 large-6 columns">
                        	<div class="row">
                                <div class="small-12 medium-11 large-10 columns" id="imagen">
                                	<label id="lblPublicityImage" class="field">*Imagen</label>
                                    <a><img id="imgImagen" src="http://placehold.it/500x300&text=[ad]"/></a>
                                    <input type="hidden" id="imagenName" value="0" />
                                    <input style="display:none" type="file" id="fileImagen" style="color:#003" name="archivos[]" multiple />
                                    <small id="alertImage" class="error small-9 medium-11 large-10 columns" style="display:none"></small>
                                </div>
                            </div>
                            <br/><br/>
                            <div class="row">
                        		<div class="small-12 medium-11 large-10 columns">
                            		<label class="field" id="lblPlaceWeatherKey">*Clave
                                		<input type="text" id="txtPlaceWeatherKey" class="radius"/>
                               		</label>
                                	<small id="alertWeatherKey" class="error" style="display:none">
                                    	Campo vacio. Por favor escriba el nombre del lugar
                                	</small>
                            	</div>
							</div>
                            <div class="row">
                        		<div class="small-12 medium-11 large-10 columns">
                            		<label class="field" id="lblPlaceLatitude">*latitud
                                		<input type="text" id="txtPlaceLatitude" class="radius"/>
                               		</label>
                                	<small id="alertLatitude" class="error" style="display:none">
                                    	Campo vacio. Por favor escriba la latitud del lugar
                                	</small>
                            	</div>
							</div>
                            <div class="row">
                        		<div class="small-12 medium-11 large-10 columns">
                            		<label class="field" id="lblPlaceLongitude">*longitud
                                		<input type="text" id="txtPlaceLongitude" class="radius"/>
                               		</label>
                                	<small id="alertLongitude" class="error" style="display:none">
                                    	Campo vacio. Por favor escriba la longitud del lugar
                                	</small>
                            	</div>
							</div>
                            <div class="row">
                                <div class="small-8 medium-9 large-6 columns">
                                    <button id="btnCancel" class="bntSave button small alert radius ">Cancelar</button>
      								<button id="btnSavePlace" class="bntSave button small success radius ">
      								Guardar</button>
      								<button  id="btnRegisterPlace" class="bntSave button small success radius ">
      								Guardar</button>
                                </div>
                                <div class="loading small-2 medium-2 large-2 columns" id="load1"></div>
							</div>
                            
                        </div><!--- fin primera columna --->
                    </div>   
                       
                </div>
                 
            </div><!--- fin div "FormPlace" --->
            
            <div id="galleryPlace" style="display:none">
            	
                <!--- formulario de galeria --->
					
					<div class="row">
                        <h3  class="text-center">Galeria</h3>
                        <!-- primera columna -->
                        <div class="small-12 medium-12 large-12 columns">
                    	<div class="small-12 medium-4 large-4 columns">
                            
                            <div class="row">
                                <div class="small-12 medium-11 large-10 columns">
                                	<label id="lblImageGallery"><strong>*Imagen galeria</strong></label>
                                    <a><img id="imgImageGallery" src="http://placehold.it/500x300&text=[ad]" style="width:300px; height:200px;"/></a>
                                    <input style="display:none" type="file" id="fileImageGallery" name="archivos[]" multiple />
                                    <small id="alertImageGallery" class="error small-9 medium-11 large-10 columns" 
                                    style="display:none"></small>
                                </div>
                            </div>
                            </br>
                            <div class="row">
                                <div class="medium-10 columns">
                                <button id="btnAddGallery" class="button tiny success radius ">agregar</button>
                                </div>
                            </div>
                        </div>
                        <!-- fin primera columna -->    
                        
                        <!-- segunda columna -->
                    	<div class="small-12 medium-8 large-8 columns">
                            
                            <div class="row">
                            	<div id="gridImages" class="small-12 medium-12 large-12 columns">
                                </div>
                            </div>
                            <br/><br/>
                            
                             <div class="row">
                                <div class="small-10 medium-6 large-6 columns">
                                    <button id="btnCancelGallery" class="button small alert radius bntSave">
                                    Cancelar</button>
                                    <button id="btnSaveGallery" class="btnS2 button small success radius bntSave">
                                    Guardar</button>
                                </div>
                                <div class="loading small-2 medium-2 large-2 columns" id="load2">
                                </div>
                            </div>
                            
                        </div>   
                        
                    </div>
					<!--- fin del formulario de galleria --->
                    </div>
                
            </div>
    </div>
</div>


<?php
$this->load->view('admin/vwFooter');
?>

<script type="text/javascript" src="<?php echo base_url() . FOUND; ?>js/foundation/foundation.tab.js"></script>
<script type="text/javascript" src="<?php echo base_url() . FOUND; ?>js/foundation/foundation.accordion.js"></script>
<script type="text/javascript" src="<?php echo base_url().JS; ?>admin/place.js"></script>
<script type="text/javascript" src="<?php echo base_url().JS; ?>admin/paginadorYBuscador.js"></script>