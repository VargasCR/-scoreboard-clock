<div class="index-admin-container">
        
        <br>
    <h3 style="margin: 0 0 0 1rem;color:black;">Productos de Atlantic</h3>
    <div style="display: flex;margin: 0 0 1rem 1rem;justify-center:center;align-items:center;  ">
        <a class="button" style="padding: 0.5rem 1.3rem !important;" href="/21232f297a57a5a743894a0e4a801fc3"><</a>
        <a class="button" style="margin-left:1rem;padding: 0.5rem 1.3rem !important;" href="/75dec04d6b22b103f3626021ed748de9">+</a>
        <a class="button" style="margin-left:1rem;padding: 0.5rem !important;" href="/4236a440a662cc8253d7536e5aa17942">Cerrar Sesion</a>

    </div>
    <div style="padding:1rem;">

    <table border="1">
    <thead>
        <tr>
            <th>Imagen</th>
            <th>ID</th>
            <th>Título</th>
            <th>Precio</th>
            <th>Categoría</th>
            <th>Código</th>
            <th class="">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($productos as $producto) { ?>
            <tr style="padding: 1rem; border: #6c757d solid 1px;">
                <td><p class="tableInfoField">Imagen: </p><img width="100px" src="/images/<?= json_decode($producto->imagen)[0] ?>" alt="Imagen del producto"></td>
                <td><p class="tableInfoField">ID: </p><?= $producto->id ?></td>
                <td><p class="tableInfoField">Título: </p><?= $producto->titulo ?></td>
                <td><p class="tableInfoField">Precio: </p><?= $producto->precio ?></td>
                
                <td><p class="tableInfoField">Categoría: </p><?php
                foreach ($categorias as $categoria) {
                    if($producto->category == $categoria->id) {
                        echo $categoria->nombre;
                        break;
                    }
                }
                ?></td>
                <td><p class="tableInfoField">Código: </p><?= $producto->codigo ?></td>
                <td>
                    <!--<a href="/ver_producto?id=<?= $producto->id ?>" value=''>Ver Detalles</a>-->
                    <a href="/d94a5da526ad85f8e50ca84d4be1defd?b80bb7740288fda1f201890375a60c8f=<?= $producto->id ?>" style="margin: 0 0 0 0.5rem;">Editar</a>
                    <button style="background-color: transparent; border: none" onclick="borrarProducto(<?= $producto->id ?>)">Borrar</button>
                    <button style="background-color: transparent; border: none" onclick="activarProducto(<?= $producto->id .','. $producto->activo ?>)"><?php if($producto->activo == '0' || $producto->activo == null) {echo 'Activar';} else {echo 'Desactivar';}?></button>
                    
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

    </div>
</div>
<div style="width: 100%;display:flex;align-items:center;justify-content:center;">
    <div style="display: flex;">
        <?php 
            if($pagina > 1) { ?>
                <a style="padding: 1rem 1.5rem;border-radius:2.5rem;background-color:#474747;color:white;" href="/286e18ee6617beaf7cfd0cb74b4b7824?page=<?php echo intval($pagina)-1; ?>"><</a>
        <?php 
            }
        ?>
        <p style="padding: 1rem"><?php echo $pagina; ?></p>
        <p style="padding: 1rem">/</p>
        <p style="padding: 1rem"><?php echo $totalPaginas; ?></p>
        <?php 
            if($pagina < $totalPaginas) { ?>
                <a style="padding: 1rem 1.5rem; border-radius: 2.5rem; background-color: #474747; color: white;" href="/286e18ee6617beaf7cfd0cb74b4b7824?page=<?php echo intval($pagina) + 1; ?>">></a>

        <?php 
            }
        ?>
    </div>
</div>
<br>