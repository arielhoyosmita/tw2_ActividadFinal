<div style="text-align: center;">
    <!-- Título del catálogo -->
    <h1 class="catalog-title">
        Catálogo
        <?= $this->Text->toList(h($tags)) ?>
    </h1>

    <!-- Contenedor de los bookmarks -->
    <div class="row">
        <?php $count = 0; ?>
        <?php foreach ($bookmarks as $bookmark): ?>
            <?php if ($count % 3 === 0): ?>
                <!-- Cerrar la fila anterior y abrir una nueva fila cada tres bookmarks -->
                </div><div class="row">
            <?php endif; ?>
            <!-- Artículo para cada bookmark -->
            <article class="bookmark column">
                <!-- Enlace al título del bookmark -->
                <h4><?= $this->Html->link($bookmark->title, $bookmark->url, ['class' => 'bookmark-title']) ?></h4>
                <!-- URL del bookmark -->
                <small class="bookmark-url"><?= h($bookmark->url) ?></small>
                <!-- Descripción del bookmark -->
                <div class="bookmark-description"><?= $this->Text->autoParagraph(h($bookmark->description)) ?></div>
            </article>
            <!-- Incrementar contador -->
            <?php $count++; ?>
        <?php endforeach; ?>
    </div>
</div>
