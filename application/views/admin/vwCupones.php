<?php
$this->load->view('admin/vwHeader');
?>

<div class="row">
    <div class="page-header header">
        <h1><small>Cupones</small></h1>
        <hr/>
    </div>
    
    <div class="cupones">
        <!--- divicion "viewEvent" que muestra la lista de cupones --->
        <div id="viewEvent">
            <div class="row">
            
                <div class="large-12 columns">
                    <!--- divicion que contiene el buscador --->
                    <div id="buscar" class="row collapse">
                        <div class="small-8 medium-10 large-10 columns columns">
                            <input class="txtSearch" id="txtSearchCoupon" type="text" 
                            placeholder="Busqueda por descripcion, cliente, ubicacion" />

                        </div>
                        <div class="small-4 medium-2 large-2 columns">
                            <button class="btnSearch" id="txtSearchCoupon"><img src="../assets/img/web/iconSearch.png">Buscar</button>
                        </div>
                    </div>
                    <!--- fin de la divicion buscar --->
                    <div class="small-12 large-11" id="divMenssage" style="display:none">
                        <div data-alert class="alert-box success" id="alertMessage">
                        </div>
                    </div>
                    <div class="small-12 large-11" id="divMenssagewarning" style="display:none">
                        <div data-alert class="alert-box warning" id="alertMessagewarning">
                        	¿desea eliminar el coupon?
                        	<button class ="btnCancelC" id="btnCancelC">cancelar</button>
                        	<button class="btnAcceptC" id="btnAcceptC">aceptar</button>
                        
                        </div>
                    </div>
                    <!--- divicion "tabla" --->
                    <!--- contiene la lista decupones --->
                    <div id="tabla" class="large-11">

                        <table id="tableCoupon">
                        <!--- encabezado de la tabla --->
                            <thead>
                                <tr>
                                    <td id="titulo" colspan="7">lista de Cupones
                                    <button id="btnAddCoupon" class="btnAdd">Agregar</button>
                                    </td>
                                </tr>
                                <tr>
                                    <th>#</th>
                                    <th width="250px">Descripcion</th>
                                    <th width="170px">Cliente</th>
                                    <th width="150px">Ciudad</th>
                                    <th width="160px">Fecha Inicio
                                        <a class="arrowUp" id="iniDate" value="coupon">
                                        <img src="../assets/img/web/arrowGreen2.png"></a>
                                        <a class="arrowDown" id="iniDate" value="coupon">
                                        <img src="../assets/img/web/arrowGreen.png"></a>
                                    </th>
                                    <th width="150px">Fecha Fin&nbsp;&nbsp;&nbsp;
                                        <a class="arrowUp" id="endDate" value="coupon">
                                        <img src="../assets/img/web/arrowGreen2.png"></a>
                                        <a class="arrowDown" id="endDate" value="coupon">
                                        <img src="../assets/img/web/arrowGreen.png"></a>
                                    </th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <!--- muestra los datos sacados de la BD --->
                            <tbody>
                            <?php 
                            $con = 0;
                            foreach ($coupon as $item):
                            $con++;
                            ?>
                                <tr>
                                    <td><?php echo $con;?></td>
                                    <td>
                                    <a  id="showCoupon"><?php echo $item->description;?><input type="hidden" id="idCoupon" value="<?php echo $item->id;?>" ></a>
                                    </td>
                                    <td><?php echo $item->partnerName;?></td>
                                    <td><?php echo $item->cityName;?></td>
                                    <td><?php echo $item->iniDate;?></td>
                                    <td><?php echo $item->endDate;?></td>
                                    <td><a id="imageDelete" value="<?php echo $item->id;?>"><img id="imgDelete" src="../assets/img/web/deleteRed.png"/></a></td>
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
                            <li id="btnPaginadorCoupon" value="0" class=btnPaginador "arrow primero unavailable">
                            <a>&laquo;</a></li>
                            <?php 
                            for($i = 1;$i<=($totalPaginador+1);$i++){
                                if($i == 1){
                                ?>
                                <li value="<?php echo $i ?>" id="btnPaginadorCoupon" class="btnPaginador current">
                                <a><?php echo $i ?></a></li>
                                <?php
                                }
                                else {
                                ?>
                                <li value="<?php echo $i ?>" id="btnPaginadorCoupon" class="btnPaginador">
                                <a><?php echo $i ?></a></li>
                                <?php	
                                }
                            }
                            ?>
                            <li value="<?php echo ($totalPaginador+1) ?>" id="btnPaginadorCoupon" 
                            class="btnPaginador arrow ultimo"><a>&raquo;</a></li>
                        </ul>
                    </div>
                    <!--- fin divicion "tabla" --->
                </div>
            </div>
        </div>
        <!--- fin de la divicion "viewEvent" --->

        <!--- divicion "FormEvent" --->
        <!--- muestra el formulario para agregar y modificar cupones --->
            <div id="FormEvent" style="display:none">
                <div class="row">
                    <!-- primera columna -->
                    <div class="small-12 medium-6 large-6 columns">
                        <div class="row">
                            <div class="small-12 medium-10 large-10 columns">
                                <label id="labelDescription"><strong>*Descripcion</strong>
                                    <input type="text" id="txtDescription" class="radius"/>
                                </label>
                                <small id="alertDescription" class="error" style="display:none">
                                    Campo vacio. Por favor escriba una descripcion
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="small-12 medium-5 large-5 columns">
                                <label id="labelPartner"><strong>*Socios</strong>
                                    <input type="text" id="txtPartner" list="partnerList" autocomplete="on" class="radius"> 
                                            <datalist id="partnerList"> </datalist>
                                </label>
                                <small id="alertPartner" class="error" style="display:none">
                                    Partner incorrecto. Por favor escriba un socio existente
                                </small>
                            </div>
                            <div class="small-12 medium-5 large-5 columns">
                                <label id="labelCity"><strong>*Ciudad</strong>
                                    <input type="text" id="txtCity" list="cityList" autocomplete="off" class="radius" />
                                            <datalist id="cityList"> </datalist>
                                </label>
                                <small id="alertCity" class="error" style="display:none">
                                    city incorrecto. Por favor escriba una ciudad existente
                                </small>
                            </div>
                            <div class="medium-2 columns">&nbsp;</div>
                        </div>
                        <div class="row">
                            
                        </div>
                         <div class="row">
                            <div class="small-12 medium-10 large-10 columns">
                                <label id="labelValidity"><strong>*Valides</strong>
                                    <input type="text" id="txtValidity" class="radius" />
                                </label>
                                <small id="alertValidity" class="error" style="display:none">
                                    Campo vacion. Por favor escriba la validacion.
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="small-12 medium-10 large-10 columns">
                                <label id="labelDetail"><strong>*Descripcion de la promocion</strong>
                                    <textarea id="txtDetail" class="radius" rows="5"></textarea>
                                </label>
                                <small id="alertDetail" class="error" style="display:none">
                                    Campo vacion. Por favor escriba la decripcion.
                                </small>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="small-12 medium-10 large-10 columns">
                                <label id="labelClauses"><strong>*Clausulas</strong>
                                    <textarea id="txtClauses" class="radius" rows="5"></textarea>
                                </label>
                                <small id="alertClauses" class="error" style="display:none">
                                    Campo vacion. Por favor escriba las clausulas.
                                </small>
                            </div>
                        </div>
                        
                        <!-- columna catalogo entretenimiento -->             
                        <div class="small-6 medium-6 large-6 columns">
                            <div class="row">
                                <label id="labelEntretenimiento"><strong>Entretenimiento</strong> </label>
                                <div class="medium-12 columns">
                                    <table id="tableEntretenimiento">
                                    <?php foreach ($entretenimiento as $item):?>
                                        <tr>
                                            <td> 
                                                <input value="<?php echo $item->id ?>" type="checkbox" 
                                                name="catalog" /> <?php echo $item->name ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </table>        
                                </div>
                            </div>
                        </div>


                        <!-- columna catalogo servicio -->
                        <div class="small-6 medium-6 large-6 columns">
                            <div class="row">
                                <label id="labelProductos"><strong>Productos y Servicios</strong> </label>
                                <div class="medium-12 columns">
                                    <table id="tableProductos">  
                                    <?php foreach ($servicio as $item):?>
                                        <tr>
                                            <td> 
                                                <input value="<?php echo $item->id ?>" type="checkbox" name="catalog" /> <?php echo $item->name ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </table>    
                                 </div>
                            </div>

                        </div>  

                        <div class="row">
                            <div class="small-12 medium-10 large-10 columns">
                                <small id="alertCatalogo" class="error" style="display:none">
                                    opciones vacias. Por favor seleciona el menos una opcion
                                </small>
                            </div>
                        </div>

                    </div>
                    <!-- fin primera columna -->


                    <!-- segunda columna -->
                    <div class="small-12 medium-6 large-6 columns">

                        <div class="row">
                            <div class="small-12 medium-8 large-8 columns" id="imagen">
                        		<label id="labelImage"><strong>*Imagen Max</strong> </label>
                                <a><img id="imgImagen" src="http://placehold.it/700x525&text=[700x525]"/></a>
                                <input type="hidden" id="imagenName" value="0" />
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
                            </div>

                            <div class="small-6 medium-4 large-4 columns" id="imagen">
                        		<label id="labelImageApp"><strong>*App</strong> </label>
                                <a><img id="imgImagenApp" src="http://placehold.it/440x330&text=[440x330]" 
                                	style="height:100px;"/></a>
                                <input style="display:none" type="file" id="fileImagenApp" style="color:#003" 
                                	name="archivos[]" multiple />
                                <small id="alertImageApp" class="error" style="display:none"></small>
                            </div>
                        </div>
                        
                        <br/><br/>
                        
                        <div class="row">
                            <div class="small-12 medium-10 large-10 columns" id="imagen">
                                <table id="tableEntretenimiento">
                                    <tr>
                                        <th>
                                            <label id="labelDay"><strong>Dias Disponibles</strong></label>
                                        <th>
                                    <tr>
                                    <tr>
                                        <td>
                                            <input value="8" type="checkbox" name="days" class="allDays"/>
                                            &nbsp;&nbsp;Todos
                                        </td>
                                        
                                        <td>
                                            <input value="4" type="checkbox" name="days" class="someDays"/>
                                            &nbsp;&nbsp;Jueves
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input value="1" type="checkbox" name="days" class="someDays"/>
                                            &nbsp;&nbsp;Lunes
                                        </td>
                                        
                                        <td>
                                            <input value="5" type="checkbox" name="days" class="someDays"/>
                                            &nbsp;&nbsp;Viernes
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input value="2" type="checkbox" name="days" class="someDays"/>
                                            &nbsp;&nbsp;Martes
                                        </td>
                                        
                                        <td>
                                            <input value="6" type="checkbox" name="days" class="someDays"/>
                                            &nbsp;&nbsp;Sabado
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input value="3" type="checkbox" name="days" class="someDays"/>
                                            &nbsp;&nbsp;Miercoles
                                        </td>
                                        
                                        <td>
                                            <input value="7" type="checkbox" name="days" class="someDays"/>
                                            &nbsp;&nbsp;Domingo
                                        </td>
                                    </tr>
                                    
                                    </table>
                                <small id="alertDay" class="error" style="display:none">
                                Selecione al menos una opcion
                                </small>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="small-12 medium-10 large-10 columns" id="imagen">
                                <table id="tableEntretenimiento">
                                    <tr>
                                        <th>
                                            <label><strong>Tiempo limitado</strong></label>
                                        <th>
                                    <tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="tiempoLimitado"/>
                                            selecione si es por tiempo limitado
                                        </td>
                                    </tr>
                                    </table>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="small-12 medium-10 large-10 columns">
                                <label id="labelIniDate"><strong>*Fecha Inicio</strong>
                                    <input type="date" id="dateIniDate" class="radius" />
                                </label>
                                <small id="alertIniDate" class="error" style="display:none"></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="small-12 medium-10 large-10 columns">
                                <label id="labelEndDate"><strong>*Fecha Fin</strong>
                                    <input type="date" id="dateEndDate" class="radius" />
                                </label>
                                <small id="alertEndDate" class="error" style="display:none"></small>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="small-8 medium-9 large-6 columns">
                                <button id="btnCancel" class="bntSave button small alert radius ">Cancelar</button>
                                <button id="btnSaveCoupon" class="bntSave button small success radius ">Guardar</button>
                                <button id="btnRegisterCoupon" class="bntSave button small success radius ">
                                Guardar</button>
                            </div>
                            <div class="loading small-2 medium-2 large-2 columns" id="load1"></div>
                        </div>
                        <div id="cargados"></div>
                    </div>
                    <!-- fin segunda columna -->
                </div>
            </div>
            <!--- fin divicion "FormEvent" --->
    </div>
    
</div>


<?php
$this->load->view('admin/vwFooter');
?>
    
<script type="text/javascript" src="<?php echo base_url() . FOUND; ?>js/foundation/foundation.tab.js"></script>
<script type="text/javascript" src="<?php echo base_url() . FOUND; ?>js/foundation/foundation.accordion.js"></script>
<script type="text/javascript" src="<?php echo base_url().JS; ?>admin/cupones.js"></script>
<script type="text/javascript" src="<?php echo base_url().JS; ?>admin/paginadorYBuscador.js"></script>





