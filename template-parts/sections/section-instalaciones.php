<section id="section-instalaciones" class="py-5 home-section">
    <div class="container-fluid">
        <h2>Nuestras Instalaciones</h2>
        <hr>
        <div id="gallery-instalaciones" class="justified-gallery">
            <?php
            $image_ids = array(871, 765, 746, 744, 743, 742, 738, 737, 736, 735, 734, 733, 732, 719);
            foreach ($image_ids as $id) :
                $image_url = wp_get_attachment_url($id);
                $image_alt = get_post_meta($id, '_wp_attachment_image_alt', TRUE);
            ?>
                <a href="<?php echo esc_url($image_url); ?>">
                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" />
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
