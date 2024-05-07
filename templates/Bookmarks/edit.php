<?php
/**
 * Vista para editar una entrada de Película, Serie o Anime.
 *
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bookmark $bookmark
 * @var string[]|\Cake\Collection\CollectionInterface $users
 * @var string[]|\Cake\Collection\CollectionInterface $tags
 */
// Cambio manual del idioma de la página a español.
?>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <!-- Encabezado de la barra lateral -->
            <h4 class="heading"><?= __('Acciones') ?></h4>
            <!-- Enlace para eliminar la entrada -->
            <?= $this->Form->postLink(
                __('Eliminar'), // Texto del enlace
                ['action' => 'delete', $bookmark->id], // URL para eliminar la entrada
                ['confirm' => __('¿Estás seguro de que quieres eliminar # {0}?', $bookmark->id), 'class' => 'side-nav-item'] // Confirmación y clase CSS
            ) ?>
            <!-- Enlace para volver a la lista de Películas, Series y Anime -->
            <?= $this->Html->link(__('Listas de Peliculas, Series y Anime'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="bookmarks form content">
            <!-- Formulario para editar la entrada -->
            <?= $this->Form->create($bookmark) ?>
            <fieldset>
                <legend><?= __('Editar Peliculas, Series o Anime') ?></legend>
                <!-- Campo para el título -->
                <?php echo $this->Form->control('Título', ['name' => 'title', 'value' => $bookmark->title]); ?>
                <!-- Campo para la descripción -->
                <?php echo $this->Form->control('Descripción', ['name' => 'description', 'value' => $bookmark->description]); ?>
                <!-- Campo para la URL -->
                <?php echo $this->Form->control('URL', ['name' => 'url', 'value' => $bookmark->url]); ?>
                <!-- Campo para las etiquetas -->
                <?php echo $this->Form->control('Etiquetas', ['name' => 'tags._ids', 'options' => $tags, 'value' => $bookmark->tags]); ?>
            </fieldset>
            <!-- Botón de enviar formulario -->
            <?= $this->Form->button(__('Enviar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

