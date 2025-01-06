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
    ?>

    <div class="form-rest mb-6 mt-6"></div>
        <form action="./backend/object/Publication.php" method="POST">
            <div class="columns is-multiline is-mobile">
                <div class="column">
                    <!-- Carusel -->
                    <section class="section">
                        <div id="carousel-demo" class="carousel">
                            <?php foreach ($images as $img) { ?>
                                <div class="item-1">
                                    <figure class="image is-3by2">
                                        <img src="<?php echo $img; ?>" alt="Imagen propiedad">
                                    </figure>
                                </div>
                            <?php } ?>
                        </div> 
                    </section>
                </div>  
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
		bulmaCarousel.attach('#carousel-demo', {
			slidesToScroll: 1,
			slidesToShow: 4
		});
</script>
