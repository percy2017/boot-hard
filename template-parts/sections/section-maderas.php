<section id="section-maderas" class="py-5 home-section">
    <div class="container-fluid">
        <h2>Troncos y Maderas</h2>
        <hr>
        <div id="gallery-maderas" class="justified-gallery">
            <?php
            $image_ids = array(764, 763, 762, 745, 740, 739, 814, 813, 811);
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
