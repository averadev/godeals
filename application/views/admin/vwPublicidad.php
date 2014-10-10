<?php
$this->load->view('admin/vwHeader');
?>

<div class="row">
	<div class="small-12 medium-12 large-12 columns">
    	<div class="page-header header">
        	<h1><small>Publicidad</small></h1>
        	<hr/>
    	</div>
    </div>
    
    <div class="publicity">
            <!--- division "viewPublicity" que muestra la lista de publicidad --->
            <div id="viewPublicity" >
            	<div class="row">
            		<div class="large-12 columns">
                    
                    	<!--- divicion del buscador --->
                		<div id="buscar" class="row collapse">
                    		<div class="small-8 medium-10 large-10 columns">
                        		<input class="txtSearch" id="txtSearchPublicity" type="text" 
                                placeholder="Busqueda por socio y categoria" />
                            </div>
                            <div class="small-4 medium-2 large-2 columns">
                            	<button class="btnSearch" id="btnSearchPublicity">
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
								¿Desea eliminar la publicidad?
								<button id="btnCancelC" class="btnCancelE">Cancelar</button>
								<button id="btnCancelC" class="btnAcceptE">Aceptar</button>
							</div>
						</div>
                        <!--- fin de los mensajes --->
                        
                        <!--- divicion que muestra la tabla de publicidad ---> 
                        <div id="tabla" >
                        	<table id="tablePublicity">
                            	<thead>
                                	<tr>
                                    	<td class="titulo" colspan="7">Publicidad
                                        	<button id="btnAddPublicity" class="btnAdd">Agregar</button>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<th>#</th>
                                        <th width="250px">socio</th>
                                        <th width="150px">Tipo</th>
                                        <th width="210px">Inicio
                                        	<a class="arrowUp" id="iniDate" value="publicity">
                                        	<img src="../assets/img/web/arrowGreen2.png"></a>
                                        	<a class="arrowDown" id="iniDate" value="publicity">
                                        	<img src="../assets/img/web/arrowGreen.png"></a>
                                        </th>
                                        <th width="185px">Fin
                                        	<a class="arrowUp" id="endDate" value="publicity">
                                        	<img src="../assets/img/web/arrowGreen2.png"></a>
                                        	<a class="arrowDown" id="endDate" value="publicity">
                                        	<img src="../assets/img/web/arrowGreen.png"></a>
                                        </th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                            	<tbody>
                                	<?php
                                    	$con = 0;
										foreach($publicity as $item):
											$con++;
											$category;
												switch ($item->category){
													case 1:
														$category = "Banner";
														break;
													case 2:
														$category = "Cintillo";
														break;
													case 3:
														$category = "Lateral";
														break;
													case 4:
														$category = "Movil";
														break;
												}
									?>
                                    		<tr>
                                            	<td><?php echo $con; ?></td>
                                                <td>
                                                	<a id="showPublicity"><?php echo $item->namePartner;?>
                                                    <input type="hidden" id="idPublicity" value="<?php echo $item->id;?>" >
                                                    </a>
                                                </td>
                                                <td><?php echo $category;?></td>
                                                <td><?php echo $item->iniDate;?></td>
                                                <td><?php echo $item->endDate;?></td>
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
  								<li id="btnPaginadorPublicity" value="0" class="btnPaginador arrow primero unavailable">
                                <a>&laquo;</a></li>
                                <?php 
								for($i = 1;$i<=($totalPaginador+1);$i++){
									if($i == 1){
									?>
                                    <li value="<?php echo $i ?>" id="btnPaginadorPublicity" class="btnPaginador current">
                                    <a><?php echo $i ?></a></li>
                                    <?php
									}
									else {
									?>
                                    <li value="<?php echo $i ?>" id="btnPaginadorPublicity" class="btnPaginador">
                                    <a><?php echo $i ?></a></li>
                                    <?php	
									}
								}
								?>
  								<li value="<?php echo ($totalPaginador+1) ?>" id="btnPaginadorPublicity" 
                                class="btnPaginador arrow ultimo"><a>&raquo;</a></li>
							</ul>
                            <!--- fin del paginador --->
                        </div> <!--- fin de la divicion tabla --->
                    </div>
                </div>    
            </div><!--- fin div "viewPublicity" --->
            
            
            <!--- division "FormPublicity" --->
            <!--- muestra el formulario para agregar y modificar publicidades --->
            <div id="FormPublicity" style="display:none">
            	<div class="row">
                    
                    <div class="small-12 medium-12 large-12 columns">
                    	<!--- primera columna --->
                		<div class="small-12 medium-6 large-6 columns">
                        	<div class="row">
                        		<div class="small-12 medium-11 large-10 columns">
                            		<label class="field" id="lblPublicityPartner">*Socio
                                		<input type="text" id="txtPublicityPartner" list="partnerList" 
                                        autocomplete="on" class="radius"/>
                                        <datalist id="partnerList"> </datalist>
                               		</label>
                                	<small id="alertPartner" class="error" style="display:none">
                                    	Socio incorrecto. Por favor escriba un socio existente
                                	</small>
                            	</div>
                        	</div>
                            <div class="row">
                        		<div class="small-12 medium-11 large-10 columns">
                            		<label class="field" id="lblPublicityCategory">*Categoria
                                    	<select id="sltPublicityCategory">
                                        	<option value="0">Selecione una categoria</option>
                                        	<option value="1">Banner</option>
                                            <option value="2">Cintillo</option>
                                            <option value="3">Lateral</option>
                                            <option value="4">Movil</option>
                                        </select>
                               		</label>
                                	<small id="alertCategory" class="error" style="display:none">
                                		Campo Incorrecto. Por favor Seleccione una categoria
                                	</small>
                            	</div>
                        	</div>
                            <div class="row">
                        		<div class="small-12 medium-11 large-10 columns">
                            		<label class="field" id="lblPublicityIniDate">*Fecha Inicial
                                		<input type="date" id="dtPublicityIniDate" class="radius"/>
                               		</label>
                                	<small id="alertIniDate" class="error" style="display:none"></small>
                            	</div>
                        	</div>
                            <div class="row">
                        		<div class="small-12 medium-11 large-10 columns">
                            		<label class="field" id="lblPublicityEndDate">*Fecha Final
                                		<input type="date" id="dtPublicityEndDate" class="radius"/>
                               		</label>
                                	<small id="alertEndDate" class="error" style="display:none"></small>
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
                                <div class="small-8 medium-9 large-6 columns">
                                    <button id="btnCancel" class="bntSave button small alert radius ">Cancelar</button>
      								<button id="btnSavePublicity" class="bntSave button small success radius ">
      								Guardar</button>
      								<button  id="btnRegisterPublicity" class="bntSave button small success radius ">
      								Guardar</button>
                                </div>
                                <div class="loading small-2 medium-2 large-2 columns" id="load1"></div>
							</div>
                            
                        </div><!--- fin primera columna --->
                    </div>   
                       
                </div>
                 
            </div><!--- fin div "FormPublicity" --->
    </div>
</div>


<?php
$this->load->view('admin/vwFooter');
?>

<script type="text/javascript" src="<?php echo base_url() . FOUND; ?>js/foundation/foundation.tab.js"></script>
<script type="text/javascript" src="<?php echo base_url() . FOUND; ?>js/foundation/foundation.accordion.js"></script>
<script type="text/javascript" src="<?php echo base_url().JS; ?>admin/publicity.js"></script>
<script type="text/javascript" src="<?php echo base_url().JS; ?>admin/paginadorYBuscador.js"></script>




