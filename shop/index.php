<?php
include_once 'funciones.php';
include_once 'Carrito.php';
include_once 'header_tienda.php';
?>


    <script src="js/jquery.js" type="text/javascript"></script>








    <div class="container">


        <div class="col col-lg-12">
            <br><br>
            <div class="form">

                <form action="busqueda.php" method="get" role="form" class="contactForm">
                    <div class="form-group">
                        <input type="text" name="campobusqueda" class="form-control input-text" id="campobusqueda" required placeholder="Realizar búsqueda" />
                        <div class="validation"></div>
                    </div>
                    <div class="text-center"><button type="submit" class="input-btn">Buscar</button></div>
                </form>
            </div>


            <div id="loader" class="text-center"> <img src="loader.gif"></div>
            <div class="outer_div"></div>

            <!-- Datos ajax Final -->


            <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
            <!-- Latest compiled and minified JavaScript -->


            <script>
                $(document).ready(function(){
                    load(1);
                });

                function load(page){
                    var parametros = {"action":"ajax","page":page};
                    $("#loader").fadeIn('slow');
                    $.ajax({
                        url:'tabla_articulos.php',
                        data: parametros,
                        beforeSend: function(objeto){
                            $("#loader").html("<img src='loader.gif'>");
                        },
                        success:function(data){
                            $(".outer_div").html(data).fadeIn('slow');
                            $("#loader").html("");
                        }
                    })
                }
            </script>

        </div>
    </div>
<?php
include_once 'footer_tienda.php';

