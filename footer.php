<?php
$footerEmailAddress = get_field( 'email_address', 'option' );
$phoneNumberLabel = get_field( 'phone_number_label', 'option' );
$phoneNumberLink = get_field( 'phone_number_link', 'option' );

$googleMapsLabel = get_field( 'google_maps_address_label', 'option' );
$googleMapsLink = get_field( 'google_maps_address_url', 'option' );


$footerContactHeader = get_field( 'footer_contact_title', 'option' );
$footerSocialHeader = get_field( 'footer_social_media_title', 'option' );

?>

<footer class="page-footer text-light pb-5 mt-5 d-flex justify-content-around row no-gutters position-relative;">
    <section class="contact-details text-center col-12 col-md-6 d-flex flex-column align-items-center">
        <h3 class="text-uppercase d-inline-block h6 double-underline">
            <?php echo $footerContactHeader; ?>
        </h3>
        <div class="contact-details-info d-flex flex-column">
            <a rel="noreferrer noopener" target="_blank" href="<?php echo $googleMapsLink; ?>" class="p-3 p-md-2 p-lg-1 p-xl-0 basic-anchor-with-underline">
                <i class="icon-location"></i><?php echo $googleMapsLabel; ?>
            </a>
            <a href="tel:<?php echo $phoneNumberLink; ?>" class="p-3 p-md-2 p-lg-1 p-xl-0 basic-anchor-with-underline">
                <i class="icon-phone"></i><?php echo $phoneNumberLabel; ?>
            </a>
            <a href="mailto:<?php echo $footerEmailAddress; ?>" class="p-3 p-md-2 p-lg-1 p-xl-0 basic-anchor-with-underline">
                <i class="icon-mail-alt"></i><?php echo $footerEmailAddress; ?>
            </a>
        </div>
    </section>

    <section class="social-media text-center col-12 col-md-6 d-flex flex-column align-items-center mt-5 mt-md-0">
        <h3 class="text-uppercase d-inline-block h6 double-underline">
            <?php echo $footerSocialHeader; ?>
        </h3>
        <div class="d-flex justify-content-around social-media-follow-container flex-wrap">
        <?php if ( have_rows( 'footer_social_media_links', 'option' ) ) : ?>
            <?php while ( have_rows( 'footer_social_media_links', 'option' ) ) : the_row(); ?>
                <?php 
                    $link = get_sub_field( 'social_media_link' );
  
                   $social_media_logo_image = get_sub_field( 'social_media_logo_image' );
                   if ( $social_media_logo_image ) { 
                       $imgUrl = wp_get_attachment_image_src( $social_media_logo_image, 'thumbnail' )[0];
                       $imgAlt = get_post_meta($social_media_logo_image , '_wp_attachment_image_alt', true);
                   }
                ?>
                <a href="<?php echo $link; ?>" class="social-follow-button mx-2 my-2 my-sm-0 basic-anchor d-flex justify-content-center align-items-center" rel="noreferrer noopener" target="_blank">
                    <img src="<?php echo $imgUrl; ?>" alt="<?php echo $imgAlt; ?>" class="h-100 w-100" /> 
                </a>
            <?php endwhile; ?>
        <?php else : ?>
        <?php endif; ?>
        </div>

    </section>

            <span class="copyright text-muted position-absolute left-0 right-0 bottom-0 text-center">
                @Copyright <?php echo date("Y"); ?>
            </span>

    </div>

</footer>


<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<?php wp_footer(); ?>
</body>

</html>