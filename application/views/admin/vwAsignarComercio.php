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
            <!--- division "AsigComer" --->
            <div id="viewAsigComer" >
            	<div class="row">
            		<div class="large-12 columns">
                    
                    	<!--- divicion del buscador --->
                		<div id="buscar" class="row collapse">
                    		<div class="small-8 medium-10 large-10 columns">
                        		<input class="txtSearch" id="txtSearchAsigComer" type="text" 
                                placeholder="Busqueda por nombre" />
                            </div>
                            <div class="small-4 medium-2 large-2 columns">
                            	<button class="btnSearch" id="btnSearchAsigComer">
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
                         <input type="hidden" id="idPlace" value="<?php echo $idPlace ?>"  />
                         <input type="hidden" id="valuePartner" value="0"/>
                        	<table id="tableAsigComer">
                            	<thead>
                                	<tr>
                                    	<td class="titulo" colspan="4">Comercios
                                        	<button id="btnAddAsigComer" class="btnAdd">Agregar</button>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<th>#</th>
                                        <th width="25%">Nombre</th>
                                        <th width="75%">descripcion</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                            	<tbody>
                                			<tr>
                                    			<td class="titulo" colspan="4" style="text-align:center;">
                                                	Hospedaje
                                        		</td>
                                    		</tr>
                                	<?php
                                    	$con = 0;
										foreach($comercio as $item):
									?>
                                            <?php 
											if($item->type == 1){
												$con++;
											?>
                                    		<tr>
                                            	<td><?php echo $con; ?></td>
                                                <td>
                                                	<a id="showAsigComer"><?php echo $item->name;?>
                                                    <input type="hidden" id="idAsigComer" value="<?php echo $item->partnerId;?>" >
                                                    </a>
                                                </td>
                                                <td><?php echo $item->info;?></td>
												<td>
                                                	<a id="imageDelete" value="<?php echo $item->partnerId;?>">
                                            			<img class="imgDelete" src="../assets/img/web/deleteRed.png"/>
                                                    </a>
                                                </td>
                                            </tr>
                                    <?php 
											}
										 endforeach;
										 ?>
										 
                                         <tr>
                                    			<td align="center" class="titulo" colspan="4" style="text-align:center;">
                                                	Restaurante
                                        		</td>
                                    	</tr>
                                         
										 <?php
										 foreach($comercio as $item):
										 	if($item->type == 2){
												$con++;
									?> 	
                                    		<tr>
                                            	<td><?php echo $con; ?></td>
                                                <td>
                                                	<a id="showAsigComer"><?php echo $item->name;?>
                                                    <input type="hidden" id="idAsigComerplace" value="<?php echo $item->partnerId;?>" >
                                                    </a>
                                                </td>
                                                <td><?php echo $item->info;?></td>
												<td>
                                                	<a id="imageDelete" value="<?php echo $item->partnerId;?>">
                                            			<img class="imgDelete" src="../assets/img/web/deleteRed.png"/>
                                                    </a>
                                                </td>
                                            </tr>
                                    <?php 
											}
										 endforeach;
										 
									?>
										 
										  <tr>
                                    			<td align="center" class="titulo" colspan="4" style="text-align:center;">
                                                	Restaurante
                                        		</td>
                                    	</tr>
                                         
										 <?php
										 foreach($comercio as $item):
										 	if($item->type == 3){
												$con++;
									?> 		
                                    		<tr>
                                            	<td><?php echo $con; ?></td>
                                                <td>
                                                	<a id="showAsigComer"><?php echo $item->name;?>
                                                    <input type="hidden" id="idAsigComer" value="<?php echo $item->partnerId;?>" >
                                                    </a>
                                                </td>
                                                <td><?php echo $item->info;?></td>
												<td>
                                                	<a id="imageDelete" value="<?php echo $item->partnerId;?>">
                                            			<img class="imgDelete" src="../assets/img/web/deleteRed.png"/>
                                                    </a>
                                                </td>
                                            </tr>
                                    <?php 
											}
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
  								<li id="btnPaginadorAsigComer" value="0" class="btnPaginador arrow primero unavailable">
                                <a>&laquo;</a></li>
                                <?php 
								for($i = 1;$i<=($totalPaginador+1);$i++){
									if($i == 1){
									?>
                                    <li value="<?php echo $i ?>" id="btnPaginadorAsigComer" class="btnPaginador current">
                                    <a><?php echo $i ?></a></li>
                                    <?php
									}
									else {
									?>
                                    <li value="<?php echo $i ?>" id="btnPaginadorAsigComer" class="btnPaginador">
                                    <a><?php echo $i ?></a></li>
                                    <?php	
									}
								}
								?>
  								<li value="<?php echo ($totalPaginador+1) ?>" id="btnPaginadorAsigComer" 
                                class="btnPaginador arrow ultimo"><a>&raquo;</a></li>
							</ul>
                            <!--- fin del paginador --->
                        </div> <!--- fin de la divicion tabla --->
                    </div>
                </div>    
            </div><!--- fin div "viewPublicity" --->
            
            
            <!--- division "FormPublicity" --->
            <!--- muestra el formulario para agregar y modificar AsigComer --->
            <div id="FormAsigComer" style="display:none">
            	<div class="row">
                    
                    <div class="small-12 medium-12 large-12 columns">
                    	<!--- primera columna --->
                		<div class="small-12 medium-6 large-6 columns">
                        
							<div class="row">
                        		<div class="small-12 medium-11 large-10 columns">
                            		<label class="field" id="lblAsigComerType">*tipo
                                		<select id="slAsigComerType" class="radius">
                                        	<option value="0">selecciona una opcion</option>
                                            <option value="1">Hospedajen</option>
                                            <option value="2">Restaurante</option>
                                            <option value="3">Antro/Bar</option>
                                        </select>
                               		</label>
                                	<small id="alertType" class="error" style="display:none">
                                    	Campo incorrecto. Por favor seleccione una opcion
                                	</small>
                            	</div>
							</div>
                        	<div class="row">
                        		<div class="small-12 medium-11 large-10 columns">
                            		<label class="field" id="lblAsigComerPartner">*socio
                                		<input type="text" id="txtAsigComerPartner" list="partnerList" 
                                        autocomplete="on" class="radius"/>
                                        <datalist id="partnerList"> </datalist>
                               		</label>
                                	<small id="alertPartner" class="error" style="display:none">
                                    	ciudad incorrecto. Por favor escriba una ciudad existente
                                	</small>
                            	</div>
                        	</div>
                             <div class="row">
                                <div class="small-8 medium-9 large-6 columns">
      								<button  id="btnNewPartner" class="bntSave button small success radius ">
      								Agregar Partner</button>
                                </div>
                                <div class="loading small-2 medium-2 large-2 columns" id="load1"></div>
							</div>

                    	</div> <!--- fin primera columna --->
                        
                        <!--- segunda columna columna --->
                     	<div class="small-12 medium-6 large-6 columns">
                        <br /><br /><br /><br /><br />
                            <div class="row">
                                <div class="small-8 medium-9 large-6 columns">
                                    <button id="btnCancel" class="bntSave button small alert radius ">Cancelar</button>
      								<button id="btnSaveAsigComer" class="bntSave button small success radius ">
      								Guardar</button>
      								<button  id="btnRegisterAsigComer" class="bntSave button small success radius ">
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
<script type="text/javascript" src="<?php echo base_url().JS; ?>admin/asignarComercio.js"></script>




