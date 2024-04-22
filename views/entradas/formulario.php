<fieldset>
    <legend>Información del Blog</legend>

    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="entrada[titulo]" placeholder="Titulo del Blog" value="<?php echo s($entrada->titulo); ?>">

    <label for="subtitulo">Subtítulo:</label>
    <input type="text" id="subtitulo" name="entrada[subtitulo]" placeholder="Subtitulo del Blog" value="<?php echo s($entrada->subtitulo); ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen accept=" image/jpeg, image/png" name="entrada[imagen]">

    <?php if ($entrada->imagen) { ?>
        <img src="../../imagenes/<?php echo $entrada->imagen ?>" class="imagen-small">
    <?php } ?>

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="entrada[descripcion]" cols="30" rows="10"><?php echo s($entrada->descripcion) ?></textarea>

    <label for="creador">Creador:</label>
    <input type="text" id="creador" name="entrada[creador]" placeholder="Creador del Blog" value="<?php echo s($entrada->creador); ?>">
</fieldset>
