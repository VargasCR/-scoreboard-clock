<div class="index-admin-container">
        
        <br>
    <h3 style="margin: 0 0 0 1rem;color:black;">Imagen PoP-Up de Atlantic</h3>
    <div style="display: flex;margin: 0 0 1rem 1rem;justify-center:center;align-items:center;  ">
        <a class="button" style="padding: 0.5rem 1.3rem !important;" href="/21232f297a57a5a743894a0e4a801fc3"><</a>
        <a class="button" style="margin-left:1rem;padding: 0.5rem 1.3rem !important;" href="/8ae4a90b2a7bc44f4217893f89e28f58">+</a>
        <a class="button" style="margin-left:1rem;padding: 0.5rem !important;" href="/4236a440a662cc8253d7536e5aa17942">Cerrar Sesion</a>

    </div>
    <style>
        .img-popup-container-item img {
            padding: 1rem; 
            max-width: 50rem;
        }

        .img-popup-container-item {
            position: relative; 
            margin: 1rem; 
            padding: 1rem; 
            background-color: gray; 
            display: flex; 
            width: min-content;
        }
        @media (max-width: 995px) {
            .img-popup-container-item {
                display: block;
            }
        }
        .img-popup-container-buttons {
            position: absolute; 
            top: 0; right: 25px; 
            background-color: green; 
            color: white; 
            border: none; 
            padding: 0.5rem;
        }

        .img-popup-container-buttonx {
            position: absolute; 
            top: 0; 
            right: 0; 
            background-color: red; 
            color: white; 
            border: none; 
            padding: 0.5rem;
        }
        
        .img-popup-container {
            margin:1rem;
        }

    </style>
    <div class="img-popup-container" style="">
        <?php foreach ($images as $obj) { ?>
            <div class="img-popup-container-item" style="">
                <!-- Contenido de la imagen -->
                <img style="" src="/images/<?php echo $obj->name; ?>-v.jpg" alt="">
                <img style="" src="/images/<?php echo $obj->name; ?>-h.jpg" alt="">
                <!-- Botón de eliminar flotante -->
                <button onclick="eliminarPopUp(<?php echo $obj->id; ?>)" class="img-popup-container-buttonx" style="">X</button>
                <?php if($obj->index != '0') { ?>
                <form action="" method="POST"> 
                    <button type="submit" class="img-popup-container-buttons" style="">↑</button>
                    <input type="hidden" name="id" value="<?php echo $obj->id; ?>">
                </form> <?php } ?>
            </div>

                
          <?php } ?>
        
    </div>
</div>
<script>
    
    
    function subirPopUp(id) {
        alert(id);
    }
</script>