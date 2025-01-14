<?php
include "./backend/inc/btn_back.php";
require_once "./backend/php/main.php";

$id = (isset($_GET['id_property_view'])) ? $_GET['id_property_view'] : 0;

?>
<div class="container is-fluid mb-6">
    <h1 class="title">Propiedad</h1>
</div>

<div class="container pb-6 pt-6">
    <?php
    $check_propiedad = conexion();
    $check_propiedad = $check_propiedad->query("SELECT * FROM propiedades WHERE id_property='$id'");


    if ($check_propiedad->rowCount() > 0) {
        $datos = $check_propiedad->fetch();
        $images = json_decode($datos['picture'], true) ?: [];
        $num_foto = isset($_GET['num_foto']) ? $_GET['num_foto'] : $images[0];
    ?>

    <div class="form-rest mb-6 mt-6"></div>
    <form action="./backend/object/Publication.php" method="POST">
        <div class="columns is-multiline is-mobile">
                <div class="column is-half">
                    <div class="box">
                        <h2 class="title has-text-centered"><?php echo htmlspecialchars($datos['title']); ?></h2>
                        <p><strong>Ubicación:</strong> <?php echo htmlspecialchars($datos['ubication']); ?></p>
                        <p><strong>Descripción:</strong> <?php echo htmlspecialchars($datos['description']); ?></p>
                        <p><strong>Observaciones:</strong> <?php echo htmlspecialchars($datos['observations']); ?></p>
                        <p><strong>Precio:</strong> USD <?php echo number_format($datos['value'], 2); ?></p>
                        <p><strong>Tipo:</strong> 
                            <?php
                            $tipo = conexion()->query("SELECT type_name FROM tipo_propiedad WHERE id_type = '{$datos['id_type']}'")->fetchColumn();
                            echo htmlspecialchars($tipo);
                            ?>
                        </p>
                        <p><strong>Operación:</strong> 
                            <?php
                            $operacion = conexion()->query("SELECT operation_name FROM operacion_inmobiliaria WHERE id_operation = '{$datos['id_operation']}'")->fetchColumn();
                            echo htmlspecialchars($operacion);
                            ?>
                        </p>
                    </div>
                </div>    
                <div class="column is-half">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3476.9558109071627!2d-66.34241857118006!3d-33.28432508428671!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses-419!2sar!4v1645188876080!5m2!1ses-419!2sar" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
        
        <div class="column">
            <h2> Galeria </h2>
            <div>
                <!-- Foto principal -->
                <div id="fotoGrande">
                    <img src="<?php echo $num_foto; ?>" alt="Imagen propiedad">  
                </div>
                <div>
                        <!-- Galeria -->   
                        <?php foreach ($images as $indice=>$img) { 
                            echo '<a href="index.php?vista=publicacion&id_property_view=' . $datos['id_property'] . ' &num_foto=' . $img . '"    >';
                            echo '<img  src=" '. $img .'" width="100" height="121"  /> ';
                            echo '</a>';
                        } ?>    
                </div> 
        </div>  
        <div class="column">
            <!-- Carusel 
            <div class="carousel" data-autoplay="true" data-loop="true">
             <?php foreach ($images as $img) { ?>
                    <div class="item-1">
                        <figure class="image is-3by2">
                            <img src="<?php echo $img; ?>" alt="Imagen propiedad">
                        </figure>
                    </div>
                <?php } ?>
            </div> -->
        </div>      
    </form>
    </div>    
    <?php
    } else {
        include "./backend/inc/error_alert.php";
    }
    $check_propiedad = null;
    
    ?>
   
</div>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        bulmaCarousel.attach('.carousel', {
            slidesToScroll: 1,
            slidesToShow: 1,
            autoplay: true,
            loop: true,
            navigation: true,
            pagination: true
        });
    });
</script>
