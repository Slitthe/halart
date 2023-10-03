<?php get_header(); ?>
<?php include('helpers.php') ?>
<?php

$title = get_the_title();

$heroImgUrl = '';
$workshop_img = get_field( 'workshop_image' );
if ( $workshop_img ) {
	$heroImgUrl = wp_get_attachment_image_src( $workshop_img, 'large' )[0];
}

$registerButtonName = get_field( 'workshop_register_button_name', 'option' );
$workshopFullBodyContent = get_field( 'workshop_body_content' );
$registerLinkUrl = get_field( 'workshop_register_link' );

$postContent = get_post()->post_content;

?>
<main id="workshop">
    <div class="background-image-container position-absolute position-absolute-cover">
        <div class="background-image position-absolute position-absolute-cover" style="background: url('<?php echo $heroImgUrl; ?>') center/cover no-repeat"></div>
    </div>

    <article class="outline main-content">
        <h1 class="workshop-title text-light text-center text-uppercase">
            <?php echo $title ?>
        </h1>

        <aside class="text-center">
            <div class="d-inline-block">
                <div class="thumbnail-info d-flex flex-column">
                    <?php if ( have_rows( 'workshop_info_box' ) ) : ?>
                        <div class="info-box-body d-flex flex-column text-center text-light p-2">
                            <?php while ( have_rows( 'workshop_info_box' ) ) : the_row(); ?>
                            <?php 
                                $key = get_sub_field( 'info_box_item_key' );
                                $value = get_sub_field( 'info_box_item_value' );
                            ?>
                            <div class="my-1 d-flex">
                                <span class="font-weight-bold">
                                    <?php echo $key; ?>
                                </span>
                                &nbsp;
                                <?php echo $value; ?>
                            </div>

                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                    <div class="d-flex get-tickets-btn btn-bar nav-light d-inline-block mt-2">
                        <a href="<?php echo $registerLinkUrl; ?>" class="btn btn-glass d-flex justify-content-center" target="_blank" rel="noreferrer noopener">
                            <i class="icon-feather"></i>
                            <?php echo $registerButtonName; ?>
                        </a>
                    </div>
                </div>
            </div>
        </aside>

        <section class="container">
            <div id="workshop" class="workshop-body outline">
                <section class="wysiwyg-container section-container margin-top-sm">
                    <?php echo $postContent; ?>
                </section>
                <section class="section-container">
                    <div class="divider-wrapper small-divider position-relative">
                        <div class="divider divider-transparent"></div>
                    </div>
                    <div class="row image-gallery">
                    <?php if (have_rows('workshop_image_gallery')) : ?>
                        <?php while (have_rows('workshop_image_gallery')) : the_row(); ?>
                            <?php
                            $fullImgUrl = '';
                            $smallImgUrl = '';
                            $imgAlt = '';
                            
                            $workshop_gallery_image = get_sub_field( 'workshop_gallery_image' );
                            if ( $workshop_gallery_image ) { 
                                $fullImgUrl = wp_get_attachment_image_src( $workshop_gallery_image, 'full' )[0];
                                $smallImgUrl = wp_get_attachment_image_src( $workshop_gallery_image, 'medium' )[0];;
                                $imgAlt = get_post_meta($workshop_gallery_image , '_wp_attachment_image_alt', true);
                            }

                            $workshopGalleryTitle = get_sub_field('workshop_gallery_title');
                            $workshopGalleryLink = $workshop_gallery_link = get_sub_field('workshop_gallery_link');
                            $caption = generate_gallery_item_caption($workshopGalleryTitle, $workshopGalleryLink['url'], $workshopGalleryLink['title']);
                            ?>

                            <a class="my-4 gallery-item col-12 col-sm-6 col-lg-4 col-xl-3 d-flex align-items-center justify-content-center" href="<?php echo $fullImgUrl; ?>" data-fancybox="<?php echo $galleryName; ?>" data-options='<?php echo $imgGalleryOptions; ?>' data-caption="<?php echo $caption; ?>" target="_blank" rel="noreferrer noopener">
                                <img src="<?php echo $smallImgUrl; ?>" alt="<?php echo $smallImgUrl; ?>" />
                            </a>

                        <?php endwhile; ?>
                    <?php else : ?>
                    <?php endif; ?>
                    </div>
                </section>
                <section class="margin-top-sm">
                    <?php echo sharethis_inline_buttons(); ?>
                 </section>
            </div>


        </section>

    </article>
</main>


<?php get_footer(); ?>