<?php
/**
 * Created by PhpStorm.
 * User: MoLy
 * Date: 18/04/2018
 * Time: 20:34
 */
include_once 'funciones.php';
include_once 'header.php';

?>
<style>
    a{
        color:black;
    }

    a:hover{
        color:greenyellow;
    }
</style>


        <!--c-logo-part-end-->
        <section class="main-section team" id="team">
            <!--main-section team-start-->
            <div class="container">

                <?php
                echo "<h2 class='text-center'>Torneos Activos</h2>";
                getTorneosActivos();
                echo "<hr>";
                echo "<h2 class='text-center'>Torneos Finalizados</h2>";
                getTorneosFinalizados();
                ?>

                </div>
            </div>
        </section>
        <!--main-section team-end-->


<?php
include_once 'footer.php';

?>