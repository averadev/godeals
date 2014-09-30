
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
                        <div class="small-10 columns">
                            <input class="txtSearch" id="txtSearchCoupon" type="text" 
                            placeholder="Busqueda por descripcion, cliente, ubicacion" />

                        </div>
                        <div class="small-2 columns">
                            <button class="btnSearch" id="txtSearchCoupon"><img src="../assets/img/web/iconSearch.png">Buscar</button>
                        </div>
                    </div>
                    <!--- fin de la divicion buscar --->
                    <div class="large-11" id="divMenssage" style="display:none">
                        <div data-alert class="alert-box success" id="alertMessage">
                        </div>
                    </div>
                    <div class="large-11" id="divMenssagewarning" style="display:none">
                        <div data-alert class="alert-box warning" id="alertMessagewarning">
                        estas seguro que desea eliminar el coupon
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
                                    <th width="150px">Fecha Fin
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
                    <div class="large-6 columns">
                        <div class="row">
                            <div class="medium-10 columns">
                                <label id="labelDescription"><strong>*Description</strong>
                                    <input type="text" id="txtDescription" class="radius"/>
                                </label>
                                <small id="alertDescription" class="error" style="display:none">
                                    Campo vacio. Por favor escriba una descripcion
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="medium-10 columns">
                                <label id="labelPartner"><strong>*Partner</strong>
                                    <input type="text" id="txtPartner" list="partnerList" autocomplete="on" class="radius"> 
                                            <datalist id="partnerList"> </datalist>
                                </label>
                                <small id="alertPartner" class="error" style="display:none">
                                    Partner incorrecto. Por favor escriba un partner existente
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="medium-10 columns">
                                <label id="labelCity"><strong>*City</strong>
                                    <input type="text" id="txtCity" list="cityList" autocomplete="off" class="radius" />
                                            <datalist id="cityList"> </datalist>
                                </label>
                                <small id="alertCity" class="error" style="display:none">
                                    city incorrecto. Por favor escriba una ciudad existente
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="medium-10 columns">
                                <label id="labelDetail"><strong>*Clausulas</strong>
                                    <textarea id="txtDetail" class="radius" rows="10"></textarea>
                                </label>
                                <small id="alertDetail" class="error" style="display:none">
                                    Campo vacion. Por favor escriba detail.
                                </small>
                            </div>
                        </div>

                        <!-- columna catalogo entretenimiento -->             
                        <div class="large-6 columns">
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
                        <div class="large-6 columns">
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
                            <div class="large-12 columns">
                                <small id="alertCatalogo" class="error" style="display:none">
                                    opciones vacias. Por favor seleciona el menos una opcion
                                </small>
                            </div>
                        </div>

                    </div>
                    <!-- fin primera columna -->


                    <!-- segunda columna -->
                    <div class="large-6 columns">

                        <div class="row">
                            <div class="medium-10 columns" id="imagen">
                                <a><img id="imgImagen" src="http://placehold.it/500x300&text=[ad]"/></a>
                                <input type="hidden" id="imagenName" 
                                value="http://placehold.it/500x300&text=[ad]" />
                                <input style="display:none" type="file" id="fileImagen" style="color:#003" name="archivos[]" multiple />
                                <small id="alertImage" class="error" style="display:none"></small>
                            </div>
                        </div>
                        <br/><br/>
                        <div class="row">
                            <div class="medium-10 columns" id="imagen">
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
                                <small id="alertImage" class="error" style="display:none"></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="medium-10 columns">
                                <label id="labelIniDate"><strong>*Fecha Inicio</strong>
                                    <input type="date" id="dateIniDate" class="radius" />
                                </label>
                                <small id="alertIniDate" class="error" style="display:none"></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="medium-10 columns">
                                <label id="labelEndDate"><strong>*Fecha Fin</strong>
                                    <input type="date" id="dateEndDate" class="radius" />
                                </label>
                                <small id="alertEndDate" class="error" style="display:none"></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="medium-10 columns">
                                <button id="btnCancel" class="button small alert radius ">Cancelar</button>
                                <button id="btnSaveCoupon" class="button small success radius ">Guardar</button>
                                <button id="btnRegisterCoupon" class="button small success radius ">Guardar</button>
                            </div>
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





