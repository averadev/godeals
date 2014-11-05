
<?php
$this->load->view('admin/vwHeader');
?>


<div class="row">
    <div class="page-header header">
        <h1><small>Sport TV</small></h1>
        <hr/>
    </div>
    
    <div class="Sporttv">
            <!--- division "viewSporttv" que muestra la lista de Sporttv --->
            <div id="viewSporttv" >
                <div class="row">
                    <div class="large-12 columns">
                        <!--- division que contiene el buscador --->
                        <div id="buscar" class="row collapse">
                            <div class="small-8 medium-10 large-10 columns">
                                <input class="txtSearch" id="txtSearchSporttv" type="text" placeholder="Busqueda por nombre, torneo y tipo" />
                            </div>
                            <div class="small-4 medium-2 large-2 columns">
                                <button class="btnSearch" id="btnSearchSporttv">
                                <img src="../assets/img/web/iconSearch.png">Buscar</button>
                            </div>
                        </div>
						<!--- fin de la division buscar --->
						<div class="large-11" id="divMenssage" style="display:none">
							<div data-alert class="alert-box success" id="alertMessage">
							</div>
						</div>
						<div class="large-11" id="divMenssagewarning" style="display:none">
							<div data-alert class="alert-box warning" id="alertMessagewarning">
								¿Desea eliminar el sporttv?
								<button id="btnCancelC" class="btnCancelE">Cancelar</button>
								<button id="btnCancelC" class="btnAcceptE">Aceptar</button>
							</div>
						</div>

						<div id="tabla" class="large-12">

							<table id="tableSporttv">
								<!--- encabezado de la tabla --->
								<thead>
									<tr>
										<td class="titulo" colspan="7">SportTV
											<button id="btnAddSporttv" class="btnAdd">Agregar</button>
										</td>
									</tr>
									<tr>
										<th>#</th>
										<th width="300px">Nombre</th>
										<th width="300px">Torneo</th>
										<!--<th width="200px">tipo</th>-->
										<th width="200px">Fecha
                                        <a class="arrowUp" id="date" value="sporttv">
                                        <img src="../assets/img/web/arrowGreen2.png"></a>
                                        <a class="arrowDown" id="date" value="sporttv">
                                        <img src="../assets/img/web/arrowGreen.png"></a>
                                        </th>
										<th>Eliminar</th>
									</tr>
								</thead>

								<!--- muestra los datos sacados de la BD --->
								<tbody>
									<?php 
									$con = 0;
									foreach ($sporttv as $item):
										$con++;
										?>                                       
										<tr>
											<td><?php echo $con;?></td>
											<td>
												<a  id="showSporttv"><?php echo $item->name;?><input type="hidden" id="idSporttv" value="<?php echo $item->id;?>" ></a>
											</td>
											<td><?php echo $item->torneo;?></td>
											<!--<td><?php echo $item->nameType;?></td>-->
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
  								<li id="btnPaginadorSporttv" value="0" class="btnPaginador arrow primero unavailable">
                                <a>&laquo;</a></li>
                                <?php 
								for($i = 1;$i<=($totalPaginador+1);$i++){
									if($i == 1){
									?>
                                    <li value="<?php echo $i ?>" id="btnPaginadorSporttv" class="btnPaginador current"><a><?php echo $i ?></a></li>
                                    <?php
									}
									else {
									?>
                                    <li value="<?php echo $i ?>" id="btnPaginadorSporttv" class="btnPaginador"><a><?php echo $i ?></a></li>
                                    <?php	
									}
								}
								?>
  								<li value="<?php echo ($totalPaginador+1) ?>" id="btnPaginadorSporttv" 
                                class="btnPaginador arrow ultimo"><a>&raquo;</a></li>
							</ul>
						</div>
						<!--- fin divicion "tabla" --->
                    </div>
                </div>
            </div><!--- fin div "viewSporttv" --->
            
            
            <!--- division "FormSporttv" --->
            <!--- muestra el formulario para agregar y modificar Sporttvos --->
            	<div id="FormSporttv" style="display:none">
					<!--- formulario de sporrtv --->
                    <div class="row">
                        <!-- primera columna -->
                    	<div class="small-12 medium-6 large-6 columns">
                            <div class="row">
                                <div class="small-12 medium-10 large-10 columns">
                                    <label class="field" id="lblSporttvName">*Nombre
                                        <input type="text" id="txtSporttvName" class="radius"/>
                                    </label>
                                    <small id="alertName" class="error" style="display:none">
                                    	Campo vacio. Por favor escriba un nombre
                                    </small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="small-12 medium-10 large-10 columns">
                                    <label id="lblSporttvTournament" class="field">*Torneo
                                        <input type="text" id="txtSporttvTournament" class="radius"/>
                                    </label>
                                    <small id="alertTournament" class="error" style="display:none">
                                    	Campo Vacio. Escriba el torneo
                                    </small>
                                </div>
                            </div>
                            <div class="row">
                            	<div class="small-12 medium-10 large-10 columns">
                                    <label id="lblSporttvType" class="field" >*Tipo
                                    	<select id="txtSporttvType" class="radius" >
                                        	<?php
												foreach ($type as $item):
											?>
                                            	<option value="<?php echo $item->id ?>">
                                                	<?php echo $item->name ?>
                                                </option>
											<?php
												endforeach;
											?>
                                        
                                        </select>
                                    </label>
                                    <small id="alertType" class="error" style="display:none">
                                    	campo vacio. Por favor escriba el tipo de sporttv
                                    </small>
                                </div>
                            </div>
                              <div class="row">
                                <div class="small-12 medium-10 large-10 columns">
                                    <label id="lblSporttvDate" class="field">*Fecha
                                        <input type="datetime-local" id="dtSporttvDate" class="radius" />
                                    </label>
                                    <small id="alertSporttvDate" class="error" style="display:none"></small>                                    
                                </div>
                            </div>
                        
                        </div>
                        <!-- fin primera columna -->    
                        
                        <!-- segunda columna -->
                    	<div class="small-12 medium-6 large-6 columns">
                            
                            <div class="row">
                                <div class="small-12 medium-10 large-10 columns" id="imagen">
                                	<label id="lblSporttvImage"><strong>*Imagen</strong></label>
                                    <a><img id="imgImagen" src="http://placehold.it/440x330&text=[440x330]"/></a>
                                    <input type="hidden" id="imagenName" value="0" />
                                    <input style="display:none" type="file" id="fileImagen" style="color:#003" name="archivos[]" multiple />
                                    <small id="alertImage" class="error" style="display:none"></small>
                                </div>
                            </div>
                            <br/><br/>
                            
                             <div class="row">
                                <div class="small-8 medium-8 large-6 columns">
                                    <button id="btnCancel" class="button small alert radius bntSave">
                                    Cancelar</button>
                                    <button id="btnSaveSporttv" class="button small success radius bntSave">
                                    Guardar</button>
                                    <button  id="btnRegisterSporttv" class="button small success radius bntSave">
                                    Guardar</button>
                                </div>
                                <div class="loading small-2 medium-2 large-2 columns" id="load1">
                                </div>
                            </div>
                            
                        </div>   
                        
                    </div>
					<!--- fin del formulario de sporrtv --->
					
					<!--- formulario de sporttv bar --->
					
					<div class="row">
                    	<hr></hr>
                        <h3  class="text-center">SportTv Bar</h3>
                        <!-- primera columna -->
                    	<div class="small-12 medium-6 large-6 columns">
                            <div class="row">
                                <div class="small-12 medium-11 large-10 columns">
                                    <label id="lblSporttvPartner"><strong>*Partner</strong>
                                    	<input type="text" id="txtSporttvPartner" list="partnerList" 
                                        autocomplete="on" class="radius"> 
                                        <datalist id="partnerList"> </datalist>
                                    </label>
                                    <small id="alertPartner" class="error" style="display:none">
                                    </small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="small-12 medium-11 large-10 columns">
                                	<label id="lblSporttvImageBar"><strong>*Imagen Partner</strong></label>
                                    <a><img id="imgImageSporttv" src="http://placehold.it/500x300&text=[ad]"/></a>
                                    <input type="hidden" id="imagenName" value="0" />
                                    <input style="display:none" type="file" id="fileImageBar" style="color:#003" name="archivos[]" multiple />
                                    <small id="alertImageBar" class="error small-9 medium-11 large-10 columns" 
                                    style="display:none"></small>
                                </div>
                            </div>
                            </br>
                            <div class="row">
                                <div class="medium-10 columns">
                                <button id="btnaddSporttv_bar" class="button tiny success radius ">agregar</button>
                                </div>
                            </div>
                        </div>
                        <!-- fin primera columna -->    
                        
                        <!-- segunda columna -->
                    	<div class="small-12 medium-6 large-6 columns">
                            
                            <div class="row">
                            	<div id="gridImages" class="small-12 medium-12 large-12 columns">
                                </div>
                            </div>
                            <br/><br/>
                            
                             <div class="row">
                                <div class="small-8 medium-6 large-6 columns">
                                    <button id="btnCancel" class="button small alert radius bntSave">
                                    Cancelar</button>
                                    <button id="btnSaveSporttv" class="btnS2 button small success radius bntSave">
                                    Guardar</button>
                                    <button  id="btnRegisterSporttv" class="btnR2 button small success radius bntSave ">
                                    Guardar</button>
                                </div>
                                <div class="loading small-2 medium-2 large-2 columns" id="load2">
                                </div>
                            </div>
                            
                        </div>   
                        
                    </div>
					<!--- fin del formulario de sporttv bar --->
					
                </div>
            
            
        </div><!-- fin div class"Sporttv" -->
    
</div>


<?php
$this->load->view('admin/vwFooter');
?>
    
<script type="text/javascript" src="<?php echo base_url() . FOUND; ?>js/foundation/foundation.tab.js"></script>
<script type="text/javascript" src="<?php echo base_url() . FOUND; ?>js/foundation/foundation.accordion.js"></script>
<script type="text/javascript" src="<?php echo base_url().JS; ?>admin/sporttv.js"></script>
<script type="text/javascript" src="<?php echo base_url().JS; ?>admin/paginadorYBuscador.js"></script>






