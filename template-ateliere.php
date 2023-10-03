<?php
/* 
    Template Name: Ateliere
*/
?>
<?php get_header(); ?>
<?php include('helpers.php'); ?>

<?php

$wpQueryParams = [
    'post_type' => $workShopsSlugName,
    'posts_per_page' => '-1',
];

$pageTitle = get_field('workshops_page_title', 'option');;
$readMoreButtonName = get_field('workshops_read_more_button_name', 'option');
$registerButtonName = get_field('workshops_register_button_name', 'option');

$workshops_hero_image = get_field('workshops_hero_image', 'option');
$heroImgUrl = '';
if ($workshops_hero_image) {
    $heroImgUrl = wp_get_attachment_image_src($workshops_hero_image, 'large')[0];
}

?>

<main id="workshops">
    <section class="hero-container position-relative blur-container">
        <h1 class="hero-title position-absolute text-light text-uppercase font-weight-bold">
            <?php echo $pageTitle; ?>
        </h1>
        <div class="container-img cover blur-img" style="background-image: url('<?php echo $heroImgUrl; ?>');"></div>
    </section>

    <section class="container main-content">


        <?php $query = new WP_Query($wpQueryParams); ?>
        <?php if ($query->have_posts()) : ?>
            <?php while ($query->have_posts()) : $query->the_post(); ?>
                <?php

                $postPermalink =  get_permalink();
                $workshopTitle = get_the_title();
                $registerLink = get_field('workshop_register_link');
                $body = get_the_excerpt();
                $currentPostIndex = $query->current_post;


                $workshop_image = get_field('workshop_image');
                $smallImgUrl = '';
                $smallImgAlt = '';
                if ($workshop_image) {
                    $smallImgUrl = wp_get_attachment_image_src($workshop_image, 'medium')[0];
                    $smallImgAlt = get_post_meta($workshop_image, '_wp_attachment_image_alt', true);
                }


                ?>


                <section class="row no-gutters workshop p-0 section-container<?php echo $currentPostIndex == 0 ? '' : ' margin-top-sm' ?> margin-bottom">
                    <div class="col-12 col-lg-4 workshop-thumbnail position-relative d-flex justify-content-center basic-anchor">
                        <div class="container-img cover w-100">
                            <img class="lozad" data-src="<?php echo $smallImgUrl; ?>" alt="<?php echo $smallImgAlt; ?>" />
                        </div>


                        <?php if (have_rows('workshop_info_box')) : ?>
                            <div class="d-flex flex-column text-light info-box-body workshop-small-details position-relative mb-lg-2 my-3 py-1 px-1 mx-2">
                                <?php while (have_rows('workshop_info_box')) : the_row(); ?>
                                    <?php
                                    $key = get_sub_field('info_box_item_key');
                                    $value = get_sub_field('info_box_item_value');
                                    ?>

                                    <?php if (get_sub_field('workshop_info_row_shop_in_small_format') == 1) { ?>
                                        <div>
                                            <span class="font-weight-bold">
                                                <?php echo $key; ?>
                                            </span>
                                            &nbsp;
                                            <?php echo $value ?>
                                        </div>
                                    <?php } else { ?>

                                    <?php } ?>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>





                    </div>
                    <div class="col-12 col-lg-8 workshop-body d-flex flex-column justify-content-between">
                        <h2 class="workshop-title px-3 py-1">
                            <?php echo  $workshopTitle; ?>
                        </h2>
                        <div class="workshop-body p-3">
                            <div class="workshop-description">
                                <?php echo $body; ?>
                            </div>
                        </div>

                        <div class="d-flex btn-bar nav-light">
                            <a href="<?php echo $postPermalink; ?>" class="btn btn-glass rounded-0 flex-1">
                                <?php echo $readMoreButtonName; ?>
                            </a>
                            <a href="<?php echo $registerLink; ?>" target="_blank" rel="noreferrer noopener" class="btn btn-glass rounded-0 flex-1 d-flex justify-content-center">
                                <i class="icon-feather"></i>
                                <?php echo $registerButtonName; ?>
                            </a>
                        </div>
                    </div>
                </section>




            <?php endwhile; ?>
        <?php else : ?>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>




    </section>

</main>
<?php get_footer(); ?>