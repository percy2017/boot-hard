<section id="section-carousel" class="carousel slide home-section" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php
        $carousel_images = array(
            array('id' => 901, 'alt' => 'Pellets'),
            array('id' => 818, 'alt' => 'Madera'),
            array('id' => 814, 'alt' => 'Troncos'),
        );
        $active = true;
        foreach ($carousel_images as $image) :
            $image_url = wp_get_attachment_url($image['id']);
        ?>
            <div class="carousel-item <?php if ($active) { echo 'active'; $active = false; } ?>">
                <img src="<?php echo esc_url($image_url); ?>" class="d-block w-100" alt="<?php echo esc_attr($image['alt']); ?>">
            </div>
        <?php endforeach; ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#section-carousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#section-carousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</section>
