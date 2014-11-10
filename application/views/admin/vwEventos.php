<?php
$this->load->view('admin/vwHeader');
?>

<div class="row">
    <div class="page-header header">
        <h1><small>Eventos</small></h1>
        <hr/>
    </div>
    
    <div class="eventos">
            <!--- division "viewEvent" que muestra la lista de eventos --->
            <div id="viewEvent" >
                <div class="row">
                    <div class="large-12 columns">
                        <!--- division que contiene el buscador --->
                        <div id="buscar" class="row collapse">
                            <div class="small-8 medium-10 large-10 columns">
                                <input class="txtSearch" id="txtSearchEvent" type="text" placeholder="Busqueda por nombre, lugar, ciudad" />
                            </div>
                            <div class="small-4 medium-2 large-2 columns">
                                <button class="btnSearch" id="btnSearchEvent"><img src="../assets/img/web/iconSearch.png">Buscar</button>
                            </div>
                        </div>
						<!--- fin de la division buscar --->
						<div class="large-11" id="divMenssage" style="display:none">
							<div data-alert class="alert-box success" id="alertMessage">
							</div>
						</div>
						<div class="large-11" id="divMenssagewarning" style="display:none">
							<div data-alert class="alert-box warning" id="alertMessagewarning">
								¿Desea eliminar el evento?
								<button id="btnCancelC" class="btnCancelE">Cancelar</button>
								<button id="btnCancelC" class="btnAcceptE">Aceptar</button>
							</div>
						</div>

						<div id="tabla" class="large-12">

							<table id="tableEvents">
								<!--- encabezado de la tabla --->
								<thead>
									<tr>
										<td class="titulo" colspan="7">Eventos
											<button id="btnAddEvent" class="btnAdd">Agregar</button>
										</td>
									</tr>
									<tr>
										<th>#</th>
										<th width="250px">Nombre</th>
										<th width="210px">Lugar</th>
										<th width="200px">Ciudad</th>
										<th width="120px">Fecha&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a class="arrowUp" id="date" value="event">
                                        <img src="../assets/img/web/arrowGreen2.png"></a>
                                        <a class="arrowDown" id="date" value="event">
                                        <img src="../assets/img/web/arrowGreen.png"></a>
                                        </th>
										<th>Eliminar</th>
									</tr>
								</thead>

								<!--- muestra los datos sacados de la BD --->
								<tbody>
									<?php 
									$con = 0;
									foreach ($event as $item):
										$con++;
										?>                                       
										<tr>
											<td><?php echo $con;?></td>
											<td>
												<a  id="showEvent"><?php echo $item->name;?><input type="hidden" id="idEvento" value="<?php echo $item->id;?>" ></a>
											</td>
											<td><?php echo $item->place;?></td>
											<td><?php echo $item->city;?></td>
											<td><?php echo $item->date;?></td>
											<td><a id="imageDelete" value="<?php echo $item->id;?>"><img class="imgDelete" src="../assets/img/web/deleteRed.png"/></a></td>
										</tr>

									<?php endforeach;
										$totalPaginador = intval($total/10);
										if($total%10 == 0){
											$totalPaginador = $totalPaginador - 1;		
										}
									?>
								</tbody>
							</table>
                            <!--- muestra la paginacion --->
                            <ul class="pagination">
  								<li id="btnPaginadorEvent" value="0" class="btnPaginador arrow primero unavailable"><a>&laquo;</a></li>
                                <?php 
								for($i = 1;$i<=($totalPaginador+1);$i++){
									if($i == 1){
									?>
                                    <li value="<?php echo $i ?>" id="btnPaginadorEvent" class="btnPaginador current"><a><?php echo $i ?></a></li>
                                    <?php
									}
									else {
									?>
                                    <li value="<?php echo $i ?>" id="btnPaginadorEvent" class="btnPaginador"><a><?php echo $i ?></a></li>
                                    <?php	
									}
								}
								?>
  								<li value="<?php echo ($totalPaginador+1) ?>" id="btnPaginadorEvent" class="btnPaginador arrow ultimo"><a>&raquo;</a></li>
							</ul>
						</div>
						<!--- fin divicion "tabla" --->
                    </div>
                </div>
            </div><!--- fin div "viewEvent" --->
            
            
            <!--- division "FormEvent" --->
            <!--- muestra el formulario para agregar y modificar eventos --->
            	<div id="FormEvent" style="display:none">
                    <div class="row">
                        
                        <!-- primera columna -->
                    	<div class="small-12 medium-6 large-6 columns">
                            
                           <div class="row">
                               
                               <div class="medium-5 columns">
                                    <label id="lblEventDate" class="field">*Fecha Inicio
                                        <input type="datetime-local" id="dtEventDate" class="radius" />
                                    </label>
                                    <small id="alertEventDate" class="error" style="display:none"></small>     
                               </div>
                               <div class="medium-5 columns">
                                    <label id="lblEventEndDate" class="field">fecha final
                                        <input type="datetime-local" id="dtEventEndDate" class="radius"></textarea>
                                    </label>
                                    <small id="alertEndDate" class="error" style="display:none">
                                    </small>
                                </div>
                               <div class="medium-2 columns">&nbsp;</div>
                            </div>
                            
                            <div class="row">
                                <div class="small-12 medium-11 large-10 columns">
                                    <label class="field" id="lblEventName">*Nombre
                                        <input type="text" id="txtEventName" class="radius"/>
                                    </label>
                                    <small id="alertName" class="error" style="display:none">
                                    	Campo vacio. Por favor escriba un nombre
                                    </small>
                                </div>
                            </div>
                            
                            <div class="row">
                                
                            </div>
                            
                            <div class="row">
                                <div class="small-12 medium-11 large-10 columns">
                                    <label class="field" id="lblEventInfo">*Descripcion
                                        <textarea type="text" id="txtEventInfo" class="radius" rows="5"></textarea>
                                    </label>
                                    <small id="alertInfo" class="error" style="display:none">
                                    	Campo vacio. Por favor escriba la descripcion del evento
                                    </small>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="medium-5 columns">
                                    <label id="lblEventPlace" class="field">*Lugar
                                        <input type="text" id="txtEventPlace" class="radius"/>
                                    </label>
                                    <small id="alertPlace" class="error" style="display:none">
                                    	Campo Vacio. Escriba el lugar del evento
                                    </small>
                                </div>
                                <div class="medium-5 columns">
                                    <label id="lblEventCity" class="field" >*Ciudad
                                    	<input type="text" id="txtEventCity" list="cityList" autocomplete="on" class="radius" />
                                        <datalist id="cityList"> </datalist>
                                    </label>
                                    <small id="alertCity" class="error" style="display:none">
                                    	Ciudad incorrecta. Por favor escriba una ciudad existente
                                    </small>
                                </div>
                                <div class="medium-2 columns">&nbsp;</div>
                            </div>
                            
                            <div class="row">
                                <div class="medium-5 columns">
                                    <label id="lblEventType" class="field" >*Categoria
                                    	<input type="text" id="txtEventType" list="typeList" autocomplete="on" class="radius" />
                                        <datalist id="typeList"> </datalist>
                                    </label>
                                    <small id="alertType" class="error" style="display:none">
                                    	Categoria incorrecta. Por favor escriba una categoria existente
                                    </small>
                                </div>
                                <div class="medium-5 columns">
                                    <label id="lblEventWord" class="field">Palabra Cupon Destacado
                                        <input type="text" id="txtEventWord" class="radius"></textarea>
                                    </label>
                                    <small id="alertWord" class="error" style="display:none">
                                    	Campo vacio. Por favor escriba una palabra para destacados
                                    </small>
                                </div>
                                <div class="medium-2 columns">&nbsp;</div>
                            </div>
                        
                            <div class="row">
                            	<div class="medium-5 columns">
                                    <label id="lblEventTags" class="field">Palabras Clave
                                        <input type="text" id="txtEventTags" class="radius"></textarea>
                                    </label>
                                    <small id="alertTags" class="error" style="display:none">
                                    	Campo vacio. Por favor escriba al menos una palabra clave
                                    </small>
                                </div>
                                <div class="medium-4 columns">
                               		<br />
                                    <label class="field"><input id="checkEventFav" type="checkbox" name="destacado"/> Destacado</label>
                               </div>
                                <div class="medium-2 columns">&nbsp;</div>
                            </div>
                            
                            <div class="row">
                                <div class="medium-5 columns">
                                    <label id="lblEventLatitude" class="field">*Latitud
                                        <input type="text" id="txtEventLatitude" class="radius"/>
                                    </label>
                                    <small id="alertLatitude" class="error" style="display:none">
                                    	Campo Vacio. Escriba la latitud del evento
                                    </small>
                                </div>
                                <div class="medium-5 columns">
                                    <label id="lblEventLongitude" class="field" >*Longitud
                                    	<input type="text" id="txtEventLongitude" class="radius" />
                                    </label>
                                    <small id="alertLongitude" class="error" style="display:none">
                                    	Campo vacio. Escriba la longitud del evento
                                    </small>
                                </div>
                                <div class="medium-2 columns">&nbsp;</div>
                            </div>
                            
                        </div>
                        <!-- fin primera columna -->    
                        
                        <!-- segunda columna -->
                    	<div class="small-12 medium-6 large-6 columns">
                            
                            <div class="row">
                                <!---<div class="small-12 medium-8 large-8 columns" id="imagen">
                                    <label id="labelImage"><strong>*Imagen Max</strong> </label>
                                    <a><img id="imgImagen" src="http://placehold.it/700x525&text=[700x525]"/></a>
                                    <input style="display:none" type="file" id="fileImagen" style="color:#003" 
                                        name="archivos[]" multiple />
                                    <small id="alertImage" class="error" style="display:none"></small>
                                </div>

                                <div class="small-6 medium-4 large-4 columns" id="imagen">
                                    <label id="labelImageMin"><strong>*Imagen Min</strong> </label>
                                    <a><img id="imgImagenMin" src="http://placehold.it/320x240&text=[320x240]"/ 
                                        style="height:100px;"></a>
                                    <input style="display:none" type="file" id="fileImagenMin" style="color:#003" 
                                        name="archivos[]" multiple />
                                    <small id="alertImageMin" class="error" style="display:none"></small>
                                </div>--->

                                <div class="small-12 medium-8 large-8 columns" id="imagen">
                                    <label id="labelImageApp"><strong>*App</strong> </label>
                                    <a><img id="imgImagenApp" src="http://placehold.it/440x330&text=[440x330]" /></a>
                                    <input type="hidden" id="imagenName" value="0" />
                                    <input style="display:none" type="file" id="fileImagenApp" style="color:#003" 
                                        name="archivos[]" multiple />
                                    <small id="alertImageApp" class="error" style="display:none"></small>
                                </div>
                            </div>
                            
                            <hr>
                            <div class="row">
                                <div class="small-12 medium-8 large-8 columns" id="imagen">
                                    <label id="labelImageFull"><strong>*Imagen Full</strong> </label>
                                    <a><img id="imgImagenFull" src="http://placehold.it/700x525&text=[700x_]"/></a>
                                    <input type="hidden" id="imagenName" value="0" />
                                    <input style="display:none" type="file" id="fileImagenFull" style="color:#003" 
                                        name="archivos[]" multiple />
                                    <small id="alertImageFull" class="error" style="display:none"></small>
                                </div>

                                <div class="small-6 medium-4 large-4 columns" id="imagen">
                                    <label id="labelImageFullApp"><strong>*App Full</strong> </label>
                                    <a><img id="imgImagenFullApp" src="http://placehold.it/440x330&text=[440x_]" 
                                        style="height:100px;"/></a>
                                    <input style="display:none" type="file" id="fileImagenFullApp" style="color:#003" 
                                        name="archivos[]" multiple />
                                    <small id="alertImageFullApp" class="error" style="display:none"></small>
                                </div>

                                <div class="small-6 medium-4 large-4 columns" id="imagen">
                                    <label id="labelImageDestacado"><strong>Destacado</strong> </label>
                                    <a><img id="imgImagenDestacado" src="http://placehold.it/250 x 437&text=[250 x 437]"/ 
                                        style="width:133px;"></a>
                                    <input style="display:none" type="file" id="fileImagenDestacado" style="color:#003" 
                                        name="archivos[]" multiple />
                                    <small id="alertImageDestacado" class="error" style="display:none"></small>
                                </div>
                            </div>
                            <br/><br/>
                            
                             <div class="row">
                                <div class="small-8 medium-9 large-6 columns">
                                    <button id="btnCancel" class="bntSave button small alert radius ">Cancelar</button>
      <!--id="btnagregarCupon" -->  <button id="btnSaveEvent" class="bntSave button small success radius ">
      Guardar</button><!--para guardar cambios de actualizacion -->
      <!--id="btnRegistrarCupon"--> <button  id="btnRegisterEvent" class="bntSave button small success radius ">
      Guardar</button> <!--para regristrar un nuevo elemento -->
                                </div>
                                <div class="loading small-2 medium-2 large-2 columns" id="load1"></div>
                            </div>
                            
                        </div>   
                        
                    </div>
                </div>
            
        </div>
    
</div>


<?php
$this->load->view('admin/vwFooter');
?>

<script type="text/javascript" src="<?php echo base_url() . FOUND; ?>js/foundation/foundation.tab.js"></script>
<script type="text/javascript" src="<?php echo base_url() . FOUND; ?>js/foundation/foundation.accordion.js"></script>
<script type="text/javascript" src="<?php echo base_url().JS; ?>admin/eventos.js"></script>
<script type="text/javascript" src="<?php echo base_url().JS; ?>admin/paginadorYBuscador.js"></script>




