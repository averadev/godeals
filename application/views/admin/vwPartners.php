
<?php
$this->load->view('admin/vwHeader');
?>

<div class="row">
    <div class="page-header header">
        <h1><small>Comercios</small></h1>
        <hr/>
    </div>
    
    <div class="partners">
            <!--- division "vistaPartners" que muestra la lista de Partners --->
            <div id="vistaPartners">
                <div class="row">
                    <div class="large-12 columns">
                        <!--- buscador --->
                        <div class="large-8 large-centered columns">
                            <div id="buscar" class="row collapse">
                                <div class="small-8 medium-10 large-10 columns">
                                    <input class="txtSearch" id="txtSearchPartner" type="text" placeholder="Busqueda por nombre del socio, categoria" />
                                </div>
                                <div class="small-4 medium-2 large-2 columns">
                                        <button class="btnSearch" id="btnSearchPartner"><img src="../assets/img/web/iconSearch.png">Buscar</button>
                                </div>
                            </div>
                        </div>
                        <!--- fin buscador --->
                        
                        <div class="large-8 large-centered columns" id="divMenssage" style="display:none">
                            <div data-alert class="alert-box success" id="alertMessage">
                            </div>
                        </div>
                        <div class="large-8 large-centered columns" id="divMenssagewarning" style="display:none">
                            <div data-alert class="alert-box warning" id="alertMessagewarning">
                                ¿Desea eliminar el socio?
                                <button class="btnCancelarE" id="btnCancelC" >Cancelar</button>
                                <button class="btnAceptarE"  id="btnAcceptC" >Aceptar </button>
                            </div>
                        </div>
                         <!--- division "tabla" --->
                        <!--- contiene la lista de partners --->
                        <div id="tabla" class="large-8 large-centered columns" >
                        
                            <table id="tablePartners">
                                <!--- encabezado de la tabla --->
                            	<thead>
                                    <tr>
                                    	<td id="titulo" colspan="5">Lista de Socios
                                            <button id="btnAddPartner" class="btnAdd">Agregar</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>#</th>
                                	<th width="300px">Nombre</th>
                                	<th width="150px">Categoria</th>
                                        <th width="100px">Telefono</th>
                                	<th>Eliminar</th>
                                    </tr>
                                </thead>
                                <!--- muestra los datos sacados de la BD --->
                                <tbody>
                                <?php 
                                $con = 0;
                                foreach ($partner as $item):
                                $con++;
                                ?>
                                    <tr>
                                        <td><?php echo $con;?></td>
                                        
                                        <td>
                                            <a  class="showPartner"><?php echo $item->name;?><input type="hidden" id="idPartner" value="<?php echo $item->id;?>" ></a>
                                        </td>
                                        <td><?php echo $item->categoryName;?></td>
                                        <td><?php echo $item->phone;?></td>
                                        <td><a class="imageDelete" value="<?php echo $item->id;?>"><img class="imgDelete" src="../assets/img/web/deleteRed.png"/></a></td>
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
                                <li id="btnPaginadorPartner" value="0" class="btnPaginador arrow primero unavailable"><a>&laquo;</a></li>
                                <?php 
                                for($i = 1;$i<=($totalPaginador+1);$i++){
                                    if($i == 1){
				?>
                                        <li value="<?php echo $i ?>" id="btnPaginadorPartner" class="btnPaginador current"><a><?php echo $i ?></a></li>
                                    <?php
                                    }
                                    else {
                                    ?>
                                        <li value="<?php echo $i ?>" class="btnPaginador" id="btnPaginadorPartner"><a><?php echo $i ?></a></li>
                                    <?php	
                                    }
                                }
                                    ?>
  				<li value="<?php echo ($totalPaginador+1) ?>" id="btnPaginadorPartner" class="btnPaginador arrow ultimo"><a>&raquo;</a></li>
                            </ul>
                            
                     
                        <!--- fin division tabla--->
                    </div>
                </div>
            </div>
        
            </div>
            
          <!--- divicion "FormularioCupones" --->
            <!--- muestra el formulario para agregar y modificar cupones --->
            	<div id="FormularioPartners" style="display:none">
                    <div class="row">
                    	<!-- primera columna -->
                    	<div class="small-12 medium-6 large-6 columns">
                            <div class="row">
                                <div class="small-12 medium-11 large-10 columns">
                                    <label id="lblPartnerName" class="field"><strong>*Nombre</strong>
                                    	<input type="text" id="txtPartnerName" class="radius"/>
                                    </label>
                                    <small id="alertPartnerName" class="error" style="display:none">
                                    	Campo vacio. Por favor escriba el nombre del socio
                                    </small>
                                </div>
                            </div>
                            
                            <div class="row">
                            	<div class="small-12 medium-11 large-10 columns">
                                    <label id="lblPartnerMapCat" class="field" ><strong>*Categoria</strong>
                                        <select name="map_category" id="selMapCat">
                                        <option>
                                                
                                        </option>
                                        <?php
                                            foreach ($map_category as $item):
                                        ?>               
                                        <option value=" <?php echo $item->id; ?>  "> 
                                            <?php echo $item->name;?>
                                        </option>
                                        <?php endforeach; ?>
                                        </select>
                                    </label>
                                    <small id="alertPartnerMapCat" class="error" style="display:none">
                                    	Categoria incorrecta. Seleccion una categoria.
                                    </small>
                                </div>
                            </div>
                            
                            <div class="row">
                            	<div class="small-12 medium-11 large-10 columns">
                                    <label id="lblPartnerAddress" class="field"><strong>*Direccion</strong>
                                    	<textarea id="txtPartnerAddress" class="radius"></textarea>
                                    </label>
                                    <small id="alertPartnerAddress" class="error" style="display:none">
                                    	Campo vacio. Por favor escriba la direccion del socio
                                    </small>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="small-12 medium-11 large-10 columns">
                                    <label id="lblPartnerPhone" class="field"><strong>Telefono</strong>
                                        <input type="tel" id="txtPartnerPhone" class="radius" />
                                    </label>
                                    <small id="alertPartnerPhone" class="error" style="display: none">
                                        Campo vacio. Por favor escriba el telefono del socio
                                    </small>
                                </div>
                            </div>
                            
                             <div class="row">
                                <div class="small-12 medium-11 large-10 columns">
                                    <label id="lblPartnerMail" class="field"><strong>Correo</strong>
                                        <input type="email" id="txtPartnerMail" class="radius" placeholder="ejemplo@email.com" />
                                    </label>
                                    <small id="alertPartnerMail" class="error" style="display: none">
                                    </small>
                                </div>
                            </div>
                            
                             <div class="row">
                                <div class="small-12 medium-11 large-10 columns">
                                    <label id="lblPartnerTwitter" class="field"><strong>Twitter</strong>
                                        <input type="text" id="txtPartnerTwitter" class="radius" />
                                    </label>
                                    <small id="alertPartnerTwitter" class="error" style="display: none">
                                        Campo vacio. Por favor escriba la cuenta de Twitter del socio
                                    </small>
                                </div>
                            </div>
                            
                             <div class="row">
                                <div class="small-12 medium-11 large-10 columns">
                                    <label id="lblPartnerFacebook" class="field"><strong>Facebook</strong>
                                        <input type="text" id="txtPartnerFacebook" class="radius" />
                                    </label>
                                    <small id="alertPartnerFacebook" class="error" style="display: none">
                                        Campo vacio. Por favor escriba la cuenta de Facebook del socio
                                    </small>
                                </div>
                            </div>

                           
                        </div>
                        <!-- fin primera columna -->
                        
                   
                        <!-- segunda columna -->
                        <div class="small-12 medium-6 large-6 columns">
                            
                            <div class="row">
                                <div class="small-12 medium-11 large-10 columns" id="imagen">
                                	<label id="lblPartnerImage" class="field"><strong>*Imagen</strong></label>
                                    <a><img id="imgImagen" style="width:200px;height:200px;border:solid 1px #a5a5a5;" src="http://placehold.it/200x200&text=[200x200]"/></a>
                                    <input type="hidden" id="imagenName" value="0" />
                                    <input style="display:none" type="file" id="fileImagen" style="color:#003" name="archivos[]" multiple />
                                    <small id="alertImage" class="error" style="display:none"></small>
                                </div>
                            </div>
                            <br/><br/>
                            
                            <div class="row">
                            	<div class="small-12 medium-11 large-10 columns">
                                    <label id="lblPartnerInfo" class="field"><strong>*Informacion</strong>
                                    	<textarea id="txtPartnerInfo" class="radius"></textarea>
                                    </label>
                                    <small id="alertPartnerInfo" class="error" style="display:none">
                                    	Campo vacio. Por favor escriba la informacion del cliente
                                    </small>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="small-12 medium-11 large-10 columns">
                                    <label id="lblPartnerLatitude" class="field"><strong>Latitud</strong>
                                        <input type="text" id="txtPartnerLatitude" class="radius"/>
                                    </label>
                                    <small id="alertPartnerLatitude" class="error" style="display: none">
                                        Campo vacio. Latitud de la ubicación del socio.
                                    </small>
                                </div>
                            </div>
                           
                            <div class="row">
                                <div class="small-12 medium-11 large-10 columns">
                                    <label id="lblPartnerLongitude" class="field"><strong>Longitud</strong>
                                        <input type="text" id="txtPartnerLongitude" class="radius" />
                                    </label>
                                    <small id="alertPartnerLongitude" class="error" style="display: none">
                                        Campo vacio. Longitud de la ubicacion del socio
                                    </small>
                                </div>
                            </div>
                            <br/>
                            
                            
                            <div class="row">
                                <div class="small-7 medium-9 large-6 columns">
                                    <button id="btnCancel" class="bntSave button small alert radius ">
                                    Cancelar</button>
                                    <button id="btnSavePartner" class="bntSave button small success radius ">
                                    Guardar</button>
                                    <button id="btnRegisterPartner" class="bntSave button small success radius ">
                                    Guardar</button>
                                </div>
                                <div class="loading small-2 medium-2 large-2 columns" id="load1"></div>
                            </div>
                            <div id="cargados"></div>
                        </div>
                        <!-- fin segunda columna -->
                    </div>
            	</div>
                <!--- fin divicion "FormularioCupones" --->
        </div>
    
</div>


<?php
$this->load->view('admin/vwFooter');
?>
    
<script type="text/javascript" src="<?php echo base_url() . FOUND; ?>js/foundation/foundation.tab.js"></script>
<script type="text/javascript" src="<?php echo base_url() . FOUND; ?>js/foundation/foundation.accordion.js"></script>
<script type="text/javascript" src="<?php echo base_url().JS; ?>admin/partners.js"></script>
<script type="text/javascript" src="<?php echo base_url().JS; ?>admin/paginadorYBuscador.js"></script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>




        
        