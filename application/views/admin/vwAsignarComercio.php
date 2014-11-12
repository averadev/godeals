<?php
$this->load->view('admin/vwHeader');
?>

<div class="row">
	<div class="small-12 medium-12 large-12 columns">
    	<div class="page-header header">
        	<h1><small>Asignar Comercio</small></h1>
        	<hr/>
    	</div>
    </div>
    
    <div class="place">
    
    		 <!--- division "FormPublicity" --->
            <!--- muestra el formulario para agregar y modificar AsigComer --->
            <div class="small-12 medium-6 large-5 columns">
				<div id="FormAsigComer">
					<div class="row">
						<div class="small-12 medium-12 large-12 columns">
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
      								
                                    <div class="row">
                                <div class="small-8 medium-9 large-6 columns">
      								<button  id="btnRegisterAsigComer" class="bntSave button small success radius ">
      								Guardar</button>
                                </div>
                                <div class="loading small-2 medium-2 large-2 columns" id="load1"></div>
							</div>
                                    
                                </div>
                                <div class="loading small-2 medium-2 large-2 columns" id="load1"></div>
							</div>
						</div>   
					</div>   
				</div>
            </div><!--- fin div "FormPublicity" --->
    
            <!--- division "AsigComer" --->
			<div class="small-12 medium-6 large-7 columns">
				<div id="viewAsigComer" >
					<div class="row">
						<div class="large-12 columns">
                        
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
											</td>
										</tr>
										<tr>
											<th>#</th>
											<th width="50%">Nombre</th>
											<th width="50%">Tipo</th>
											<th>Eliminar</th>
										</tr>
									</thead>
									<tbody>
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
                                                	<?php echo $item->name;?>
                                                </td>
                                                <td><?php echo "Hospedaje"; ?></td>
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
                                         
										 <?php
										 foreach($comercio as $item):
										 	if($item->type == 2){
												$con++;
									?> 	
                                    		<tr>
                                            	<td><?php echo $con; ?></td>
                                                <td>
                                                	<?php echo $item->name;?>
                                                </td>
                                                <td><?php echo "Restaurante"; ?></td>
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
                                         
										 <?php
										 foreach($comercio as $item):
										 	if($item->type == 3){
												$con++;
									?> 		
                                    		<tr>
                                            	<td><?php echo $con; ?></td>
                                                <td>
                                                	<?php echo $item->name;?>
                                                </td>
                                                <td><?php echo "Antro/Bar"; ?></td>
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
				</div>
            </div><!--- fin div "viewPublicity" --->
            
            
           
    </div>
</div>


<?php
$this->load->view('admin/vwFooter');
?>

<script type="text/javascript" src="<?php echo base_url() . FOUND; ?>js/foundation/foundation.tab.js"></script>
<script type="text/javascript" src="<?php echo base_url() . FOUND; ?>js/foundation/foundation.accordion.js"></script>
<script type="text/javascript" src="<?php echo base_url().JS; ?>admin/asignarComercio.js"></script>




