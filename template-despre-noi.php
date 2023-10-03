<?php
/*
Template Name: Despre Noi
 */
?>
<?php get_header(); ?>

<?php

$youtubeOption = 'youtube';
$videoOption = 'video';

$videoType = get_field('about_us_video_type', 'option');
$youtubeId = '';
$videoUrl = '';
if ($videoType == $youtubeOption) {
    $youtubeId = get_field('about_us_youtube_video_id', 'option');
} elseif ($videoType == $videoOption) {
    $videoUrl = get_field('video_mp4_url', 'option');
}

$wysiwygContent = get_field('about_us_main_content', 'option');
$aboutUsTitle = get_field('about_us_container_title', 'option');
$teamTitle = get_field('team_container_title', 'option');

?>

<main id="about-us">
    <section>
        <?php if ($videoType == $youtubeOption) : ?>
            <iframe class="video-player" src="https://www.youtube.com/embed/<?php echo $youtubeId; ?>?controls=1&modestbranding=0&color=white&showinfo=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <?php elseif ($videoType == $videoOption) : ?>
            <video muted controls src="<?php echo $videoUrl; ?>" class="video-player position-relative"></video>
        <?php endif; ?>
    </section>



    <div class="container margin-top">

        <?php if ( have_rows( 'about_us_custom_sections', 'option' ) ) : ?>
            <?php while ( have_rows( 'about_us_custom_sections', 'option' ) ) : the_row(); ?>
                <?php 
                    $sectionTitle = get_sub_field( 'about_us_section_title' );
                    $sectionBody = get_sub_field( 'about_us_section_body' ); ?>

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

        <section id="team-container">

            <?php if (have_rows('about_us_team_members', 'option')) : ?>
                <?php while (have_rows('about_us_team_members', 'option')) : the_row(); ?>
                    <?php
                    $name = get_sub_field('team_member_name');
                    $title = get_sub_field('team_member_title');

                    $descriptionBody = get_sub_field('team_member_description_body');

                    $tallImageUrl = '';
                    $tallImgAlt = '';

                    $member_tall_image = get_sub_field( 'member_tall_image' );
                    if ( $member_tall_image ) { 
                        $tallImageUrl = wp_get_attachment_image_src( $member_tall_image, 'large' )[0];;
                        $tallImgAlt = get_post_meta($member_tall_image , '_wp_attachment_image_alt', true);
                    }

                    $wideImgUrl = '';
                    $wideImgAlt = '';

                    $member_wide_image = get_sub_field( 'member_wide_image' );
                    if ( $member_wide_image ) { 
                        $wideImgUrl = wp_get_attachment_image_src( $member_wide_image, 'large' )[0];;
                        $wideImgAlt = get_post_meta($member_wide_image , '_wp_attachment_image_alt', true);
                    }
                    ?>


                    <section class="row no-gutters team-member p-0 section-container margin-top-sm margin-bottom d-flex">

                        <div class="member-img-container container-img cover no-overlay position-relative col-12 col-lg-5" style="z-index: 1;">
                            <img class="member-image-tall lozad" data-src="<?php echo $tallImageUrl; ?>" alt="<?php echo $tallImgAlt; ?>" />
                            <img class="member-image-wide lozad" data-src="<?php echo $wideImgUrl; ?>" alt="<?php echo $wideImgAlt; ?>" />
                        </div>

                        <div class="d-flex flex-column col-12 col-lg-7 px-3 p-2">
                            <div class="flex-1 d-flex flex-column justify-content-around">
                                <div>
                                    <h3 class="member-title">
                                        <?php echo $name; ?>
                                    </h3>
                                    <h4 class="member-title text-muted">
                                        <?php echo $title; ?>
                                    </h4>
                                </div>
                                <p class="member-description my-5-md">
                                    <?php echo $descriptionBody ?>
                                </p>
                            </div>

                            <div class="member-social-media d-block">
                                <?php if (have_rows('member_social_media_links')) : ?>
                                    <?php while (have_rows('member_social_media_links')) : the_row(); ?>
                                        <?php
                                        $linkIcon = get_sub_field('member_social_media_link_icon');
                                        $link = get_sub_field('member_social_media_link_item');

                                        $link_url = $link['url'];
                                        $link_title = $link['title'];
                                        $link_target = $link['target'] ? $link['target'] : '_self';
                                        ?>
                                        <a class="scale-hover-container social-media-item d-inline-block mb-3" href="<?php echo $link_url; ?>" target="<?php echo $link_target; ?>" rel="noreferrer noopener">
                                            <img data-src="<?php echo $linkIcon; ?>" class="lozad img-icon mr-2 scale-hover-item" /><?php echo $link_title; ?>
                                        </a>
                                        <br>

                                    <?php endwhile; ?>
                                <?php endif; ?>

                            </div>
                        </div>
                    </section>


                <?php endwhile; ?>
            <?php endif; ?>

        </section>
    </div>
</main>


<?php get_footer() ?>
