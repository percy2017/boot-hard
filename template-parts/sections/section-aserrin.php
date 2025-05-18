<section id="aserrin" class="py-5">
    <div class="container-fluid">
        <h2>Aserrín</h2>
        <hr>
        <div id="gallery-aserrin" class="justified-gallery">
            <?php
            $image_ids = array(761, 760, 741, 715, 714, 706);
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
