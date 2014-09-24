<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <title>Go Deals</title>
        <link href='http://fonts.googleapis.com/css?family=Chivo' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php echo base_url() . FOUND; ?>css/foundation.css" />
        <script type="text/javascript" src="<?php echo base_url() . FOUND; ?>js/vendor/modernizr.js"></script>
        <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>web/home.css" />
        <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>web/admin.css" />
        <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>web/cupones.css" />
    </head>
    <body>

        <?php $this->load->view('web/vwStickyMenu'); ?>

        <?php $this->load->view('web/vwHeader'); ?>

        <?php $this->load->view('web/vwMainMenu'); ?>
        <br/>
        <div class="row">
            <div class="large-12 columns">
                <h1  class="text-center">Eventos</h1>
            </div>
            <hr>
        </div>
        <br/><br/>
        
        <div class="eventos">
            <!--- division "viewEvent" que muestra la lista de eventos --->
            <div id="viewEvent" >
                <div class="row">
                    <div class="large-12 columns">
                        <!--- division que contiene el buscador --->
                        <div id="buscar" class="row collapse">
                            <div class="small-10 columns">
                                <input class="txtSearch" id="txtSearchEvent" type="text" placeholder="Busqueda por nombre, lugar, ciudad" />
                            </div>
                            <div class="small-2 columns">
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
								¿Estas seguro que desea eliminar el evento?
								<button class="btnCancelE">Cancelar</button>
								<button class="btnAcceptE">Aceptar</button>
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
										<th width="120px">Fecha
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
                    	<div class="large-6 columns">
                            <div class="row">
                                <div class="medium-10 columns">
                                    <label class="field" id="lblEventName">*Nombre
                                        <input type="text" id="txtEventName" class="radius"/>
                                    </label>
                                    <small id="alertName" class="error" style="display:none">
                                    	Campo vacio. Por favor escriba un nombre
                                    </small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-10 columns">
                                    <label id="lblEventPlace" class="field">*Lugar
                                        <input type="text" id="txtEventPlace" class="radius"/>
                                    </label>
                                    <small id="alertPlace" class="error" style="display:none">
                                    	Campo Vacio. Escriba el lugar del evento
                                    </small>
                                </div>
                            </div>
                            <div class="row">
                            	<div class="medium-10 columns">
                                    <label id="lblEventCity" class="field" >*Ciudad
                                    	<input type="text" id="txtEventCity" list="cityList" autocomplete="on" class="radius" />
                                            <datalist id="cityList"> </datalist>
                                    </label>
                                    <small id="alertCity" class="error" style="display:none">
                                    	Ciudad incorrecta. Por favor escriba una ciudad existente
                                    </small>
                                </div>
                            </div>
                            <div class="row">
                            	<div class="medium-10 columns">
                                    <label id="lblEventWord" class="field">*Palabra Clave
                                            <input type="text" id="txtEventWord" class="radius"></textarea>
                                    </label>
                                    <small id="alertWord" class="error" style="display:none">
                                    	Campo vacio. Por favor escriba una palabra clave
                                    </small>
                                </div>
                            </div>
                            
                           <div class="row">
                                <div class="medium-10 columns" id="imagen">
                                    <label class="field">Destacado</label>
                                    </br>
                                    <input id="checkEventFav" type="checkbox" name="destacado"/>
                                </div>
                            </div>
                            
                        </div>
                        <!-- fin primera columna -->    
                        
                        <!-- segunda columna -->
                    	<div class="large-6 columns">
                            
                            <div class="row">
                                <div class="medium-10 columns" id="imagen">
                                    <a><img id="imgImagen" src="http://placehold.it/500x300&text=[ad]"/></a>
                                    <input type="hidden" id="imagenName" value="0" />
                                    <input style="display:none" type="file" id="fileImagen" style="color:#003" name="archivos[]" multiple />
                                    <small id="alertImage" class="error" style="display:none"></small>
                                </div>
                            </div>
                            <br/><br/>
                            
                            <div class="row">
                                <div class="medium-10 columns">
                                    <label id="lblEventDate" class="field">*Fecha
                                        <input type="date" id="dtEventDate" class="radius" />
                                    </label>
                                    <small id="alertEventDate" class="error" style="display:none"></small>                                    
                                </div>
                            </div>
                            
                             <div class="row">
                                <div class="medium-10 columns">
                                    <button id="btnCancel" class="button small alert radius ">Cancelar</button>
      <!--id="btnagregarCupon" -->  <button id="btnSaveEvent" class="button small success radius ">Guardar</button><!--para guardar cambios de actualizacion -->
      <!--id="btnRegistrarCupon"--> <button  id="btnRegisterEvent" class="button small success radius ">Guardar</button> <!--para regristrar un nuevo elemento -->
                                </div>
                            </div>
                            
                        </div>   
                        
                    </div>
                </div>
            
            
        </div><!-- fin div class"eventos" -->

        
          <!-- Commons -->
        <script>
            var URL_IMG = '<?php echo base_url() . IMG; ?>';
            var URL_BASE = '<?php echo base_url(); ?>';
        </script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . FOUND; ?>js/foundation.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . FOUND; ?>js/foundation/foundation.tab.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . FOUND; ?>js/foundation/foundation.accordion.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/api/hachiko/hachiko.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . JS; ?>web/admin/eventos.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . JS; ?>web/admin/paginadorYBuscador.js"></script>
    
    </body>
</html>


