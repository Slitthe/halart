<?php
/*
    Template Name: Stiri
 */
?>
<?php include('helpers.php'); ?>
<?php get_header(); ?>

<?php
$pageTitle = get_field('news_page_title', 'option');

$news_hero_image = get_field( 'news_hero_img', 'option' );
$heroImgUrl = '';
if ( $news_hero_image ) {
    $heroImgUrl = wp_get_attachment_image_src( $news_hero_image, 'large' )[0];
}

$readMoreButton = get_field('news_read_more_button_text', 'option');

$wpQueryParams = [
    'post_type' => $newsSlugName,
    'posts_per_page' => '-1',
];
?>

<main id="news">
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
                $newsTitle = get_the_title();

                $postDate = DateTime::createFromFormat($dateStoredFormat, get_the_date() . ' ' . get_the_time());

                $thumbnailUrl = '';
                $news_image = get_field( 'news_image' );
                if ( $news_image ) {
                    $thumbnailUrl = wp_get_attachment_image_src( $news_image, 'medium' )[0];
                }

                $smallDescription = get_the_excerpt();

                $authorName = '';
                $authorLink = '';
                $authorImgObject = '';
                $authorImgUrl = '';
                $authorImgAlt = '';

                $authorPostObject = get_field( 'news_author' );
                if ( $authorPostObject ) {
                    $post = $authorPostObject;
                    setup_postdata( $authorPostObject );
                    
                    $authorName = $post->post_title;
                    $authorLink = get_field( 'author_external_link' );

                    $author_image = get_field( 'author_image' );
                    if ( $author_image ) {
                        $authorImgUrl = wp_get_attachment_image_src( $author_image, 'thumbnail' )[0];
                        $authorImgAlt = get_post_meta($author_image, '_wp_attachment_image_alt', true);
                    }

                    wp_reset_postdata();
                }
                ?>

                <section class="news-item outline row no-gutters section-container margin-bottom-sm p-0 basic-anchor">
                    <div class="col-12 col-lg-4 news-item-thumbnail basic-anchor">
                        <div class="container-img cover lozad" data-background-image="<?php echo $thumbnailUrl; ?>"></div>
                    </div>

                    <div class="col-12 col-lg-8 p-2 d-flex flex-column">
                        <div class="news-item-data d-flex align-items-center">
                            <img class="author-image lozad" data-src="<?php echo $authorImgUrl; ?>" alt="<?php echo $authorImgAlt; ?>"/>
                            <div>
                                <a href="<?php echo $authorLink; ?>" class="news-author" target="_blank" rel="noreferrer noopener">
                                    <?php echo $authorName; ?>
                                </a>
                                
                                <div class="news-creation text-muted smally">
                                    <span>
                                        <?php echo $postDate->format($datePrintFormatDateTime) ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <h2 class="h1">
                            <?php echo $newsTitle; ?>
                        </h2>

                        <div class="news-description flex-1 mb-2">
                            <?php echo $smallDescription; ?>
                        </div>

                        <div class="btn-bar d-inline-block nav-light news-item-button">
                            <a href="<?php echo $postPermalink; ?>" class="btn btn-glass">
                                <?php echo $readMoreButton; ?>
                            </a>
                        </div>
                    </div>
                </section>


            <?php endwhile; ?>
        <?php else : ?>
        <?php endif;
        wp_reset_postdata(); ?>
    </section>
</main>

<?php get_footer(); ?>
