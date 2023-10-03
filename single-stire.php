<?php get_header(); ?>
<?php include('helpers.php'); ?>


<?php

$title = get_the_title();
$postDate = DateTime::createFromFormat($dateStoredFormat, get_the_date() . ' ' . get_the_time());


$heroImgUrl = '';
$news_image = get_field( 'news_image' );
if ( $news_image ) {
	$heroImgUrl = wp_get_attachment_image_src( $news_image, 'large' )[0];
}


$authorName = '';
$authorLink = '';

$authorImgUrl = '';
$authorImgAlt = '';
$authorPostObject = get_field('news_author');
if ($authorPostObject) {
    $post = $authorPostObject;
    setup_postdata($authorPostObject);

    $authorName = $post->post_title;
    $authorLink = get_field('author_external_link');

    $author_image = get_field( 'author_image' );
    $authorImgUrl = '';
    $authorImgAlt;
    if ( $author_image ) {
        $authorImgUrl = wp_get_attachment_image_src( $author_image, 'thumbnail' )[0];
        $authorImgAlt = get_post_meta($author_image, '_wp_attachment_image_alt', true);
    }

    wp_reset_postdata();
}

$readMoreButtonUrl = get_field('read_more_news_link', 'option');

$content = get_post()->post_content;

$recentNewsSeeMoreButton = get_field('recent_news_button', 'option');
$recentNewsTitle = get_field('recents_news_title', 'option');
$recentsNewsHowManyToShow = get_field('recent_news_number', 'option');

$postId = get_post()->ID;

$wpQueryParams = [
    'post_type' => $newsSlugName,
    'posts_per_page' => $recentsNewsHowManyToShow,
    'post__not_in' => array($postId),
];

?>

<main id="news-item">
    <div class="background-image-container position-absolute position-absolute-cover">
        <div class="background-image position-absolute position-absolute-cover" style="background: url('<?php echo $heroImgUrl; ?>') center/cover no-repeat"></div>
    </div>

    <h1 class="news-title text-uppercase text-center text-white position-relative">
        <?php echo $title; ?>
    </h1>
    <article class="position-relative container">
        <div class="news-article section-container margin-bottom">
            <section class="news-item-data d-flex align-items-center">
                <img src="<?php echo $authorImgUrl; ?>" class="author-image" <?php echo $authorImgAlt != '' ? 'alt="' . $authorImgAlt . '"' : '' ?>/>
                <div>
                    <a href="<?php echo $authorLink; ?>" class="news-author" rel="noreferrer noopener" target="_blank">
                        <?php echo $authorName; ?>
                    </a>
                    <div class="news-creation text-muted smally">
                        <span>
                            <?php echo $postDate->format($datePrintFormatDateTime); ?>
                        </span>
                    </div>
                </div>
            </section>

            <div class="divider-wrapper small-divider position-relative">
                <div class="divider divider-transparent"></div>
            </div>

            <section class="news-body">
                <?php echo $content; ?>
            </section>
            <section>
                <div class="divider-wrapper position-relative">
                    <div class="divider divider-transparent"></div>
                </div>
                <div class="row image-gallery">

                    <?php if (have_rows('news_image_gallery')) : ?>
                        <?php while (have_rows('news_image_gallery')) : the_row(); ?>
                            <?php

                            $fullImgUrl = '';
                            $smallImgUrl = '';
                            $imgAlt = '';
                            
                            $news_gallery_image = get_sub_field( 'news_gallery_image' );
                            if ( $news_gallery_image ) { 
                                $fullImgUrl = wp_get_attachment_image_src( $news_gallery_image, 'full' )[0];
                                $smallImgUrl = wp_get_attachment_image_src( $news_gallery_image, 'medium' )[0];;
                                $imgAlt = get_post_meta($news_gallery_image , '_wp_attachment_image_alt', true);
                            }

                            $newsGalleryTitle = get_sub_field('news_gallery_title');
                            $newsGalleryLink = $news_gallery_link = get_sub_field('news_gallery_link');
                            $caption = generate_gallery_item_caption($newsGalleryTitle, $newsGalleryLink['url'], $newsGalleryLink['title']);
                            ?>

                            <a class="my-4 gallery-item col-12 col-sm-6 col-lg-4 col-xl-3 d-flex align-items-center justify-content-center" href="<?php echo $fullImgUrl; ?>" data-fancybox="<?php echo $galleryName; ?>" data-options='<?php echo $imgGalleryOptions; ?>' data-caption="<?php echo $caption; ?>">
                                <img src="<?php echo $smallImgUrl; ?>" alt="<?php echo $imgAlt; ?>" />
                            </a>


                        <?php endwhile; ?>
                    <?php else : ?>
                    <?php endif; ?>
                </div>
            </section>
        </div>
    </article>



    <section class="margin-top-sm container">
        <?php echo sharethis_inline_buttons(); ?>
    </section>
</main>


<?php get_footer(); ?>