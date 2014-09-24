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
    </head>
    <body>

        <?php $this->load->view('web/vwStickyMenu'); ?>

        <?php $this->load->view('web/vwHeader'); ?>

        <?php $this->load->view('web/vwMainMenu'); ?>
        <br/>
        <div class="row">
            <div class="large-12 columns">
                <h1  class="text-center">SportTv</h1>
            </div>
            <hr>
        </div>
        <br/><br/>
        
        <div class="Sporttv">
            <!--- division "viewSporttv" que muestra la lista de Sporttv --->
            <div id="viewSporttv" >
                <div class="row">
                    <div class="large-12 columns">
                        <!--- division que contiene el buscador --->
                        <div id="buscar" class="row collapse">
                            <div class="small-10 columns">
                                <input class="txtSearch" id="txtSearchSporttv" type="text" placeholder="Busqueda por nombre, torneo y tipo" />
                            </div>
                            <div class="small-2 columns">
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
								¿Estas seguro que desea eliminar el sporttv?
								<button class="btnCancelE">Cancelar</button>
								<button class="btnAcceptE">Aceptar</button>
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
										<th width="250px">Nombre</th>
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
                    <div class="row">
                        
                        <!-- primera columna -->
                    	<div class="large-6 columns">
                            <div class="row">
                                <div class="medium-10 columns">
                                    <label class="field" id="lblSporttvName">*Nombre
                                        <input type="text" id="txtSporttvName" class="radius"/>
                                    </label>
                                    <small id="alertName" class="error" style="display:none">
                                    	Campo vacio. Por favor escriba un nombre
                                    </small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-10 columns">
                                    <label id="lblSporttvTournament" class="field">*Torneo
                                        <input type="text" id="txtSporttvTournament" class="radius"/>
                                    </label>
                                    <small id="alertTournament" class="error" style="display:none">
                                    	Campo Vacio. Escriba el torneo
                                    </small>
                                </div>
                            </div>
                            <div class="row">
                            	<div class="medium-10 columns">
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
                                <div class="medium-10 columns">
                                    <label id="lblSporttvDate" class="field">*Fecha
                                        <input type="datetime-local" id="dtSporttvDate" class="radius" />
                                    </label>
                                    <small id="alertSporttvDate" class="error" style="display:none"></small>                                    
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
                                    <button id="btnCancel" class="button small alert radius ">Cancelar</button>
                                    <button id="btnSaveSporttv" class="button small success radius ">Guardar</button>
                                    <button  id="btnRegisterSporttv" class="button small success radius ">Guardar</button>
                                </div>
                            </div>
                            
                        </div>   
                        
                    </div>
                </div>
            
            
        </div><!-- fin div class"Sporttv" -->

        
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
        <script type="text/javascript" src="<?php echo base_url() . JS; ?>web/admin/sporttv.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . JS; ?>web/admin/paginadorYBuscador.js"></script>
    
    </body>
</html>


