<?php 
/*
    Template Name: Contact
*/
?>
<?php get_header(); ?>

<?php


$contact_us_title = get_field( 'write_to_use_container_title', 'option' );
$google_maps_embed_url = get_field( 'google_maps_embed_url', 'option' );

$contact_us_form = get_field( 'contact_us_form', 'option' );
$contact_us_hero_image = get_field( 'contact_us_hero_image', 'option' );
$page_title = get_field( 'contact_us_page_title', 'option' );

$heroImgUrl = '';

$contact_us_hero_image = get_field( 'contact_us_hero_image', 'option' );
if ( $contact_us_hero_image ) { 
    $heroImgUrl = wp_get_attachment_image_src( $contact_us_hero_image, 'large' )[0];;
}


?>

<main id="contact">
    <section class="hero-container position-relative blur-container">
        <h1 class="hero-title position-absolute text-light text-uppercase font-weight-bold">
            <?php echo $page_title; ?>
        </h1>
        <div class="container-img cover blur-img" style="background-image: url('<?php echo $heroImgUrl; ?>');"></div>
    </section>

    <section class="container outline main-content">
        <section class="section-container margin-top-sm margin-bottom-sm">
            <div class="google-maps-container">
                <iframe src="<?php echo $google_maps_embed_url; ?>" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
            </div>
        </section>
        <?php if ( have_rows( 'contact_custom_sections', 'option' ) ) : ?>
            <?php while ( have_rows( 'contact_custom_sections', 'option' ) ) : the_row(); ?>
                <?php 
                    $sectionTitle = get_sub_field( 'contact_section_title' );
                    $sectionBody = get_sub_field( 'contact_section_body' ); ?>

                    <section class="margin-top-sm margin-bottom-sm section-container">
                        <?php if($sectionTitle != ''): ?>
                        <div class="divider-wrapper small-divider position-relative">
                            <div class="divider divider-transparent "></div>
                            <h2 class="position-absolute divider-title">
                                <?php echo $sectionTitle; ?>
                            </h2>
                        </div>
                        <?php endif; ?>
                        

                        <?php if($sectionBody) : ?>
                            <div class="wysiwyg-container">
                                <?php echo $sectionBody; ?>
                            </div>
                        <?php endif; ?> 
                    </section>
                    
            <?php endwhile; ?>
        <?php endif ; ?>
    </section>

</main>

<?php get_footer(); ?>