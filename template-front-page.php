<?php 
/* 
    Template Name: Front Page
*/
?>
<?php get_header(); ?>
<?php include ('helpers.php'); ?>

<?php

$readMoreButton = get_field( 'home_read_more_button_name', 'option' );
$carouselItems = array();
$howManyToTake = get_field( 'front_page_carousel_items_how_many', 'option' );
$carouselDescMaxLen = get_field( 'carousel_description_max_length', 'option' );

class CarouselItem
{
    public function __construct($thumbnailImg, $fullImg, $title, $permalink, $description)
    {
        $this->thumbnailImg = $thumbnailImg;
        $this->fullImg = $fullImg;
        $this->title = $title;
        $this->permalink = $permalink;
        $this->description = $description;
    }
}

// Current events query
$queryParamsForCurrentEvents = getQueryParamsForCurrentEvents('-1', $eventsSlugName, '-1');
$query = new WP_Query($queryParamsForCurrentEvents);
if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post();
        if(count($carouselItems) >= $howManyToTake) {
            break;
        }
        array_push($carouselItems, new CarouselItem(
            wp_get_attachment_image_src( get_field( 'event_image' ), 'large' )[0],
            wp_get_attachment_image_src( get_field( 'event_image' ), 'full' )[0],
            get_the_title(),
            get_permalink(),
            get_the_excerpt()
        ));
    endwhile;
endif;
wp_reset_postdata();

// News query
if(count($carouselItems) <= $howManyToTake) {
    $newsWpQueryParams = [
        'post_type' => $newsSlugName,
        'posts_per_page' => '-1',
    ];
    $query = new WP_Query($newsWpQueryParams);
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            if(count($carouselItems) >= $howManyToTake) {
                break;
            }
            
            array_push($carouselItems, new CarouselItem(
                wp_get_attachment_image_src( get_field( 'news_image' ), 'large' )[0],
                wp_get_attachment_image_src( get_field( 'news_image' ), 'full' )[0],
                get_the_title(),
                get_permalink(),
                get_the_excerpt()
            ));
        endwhile;
    endif;
    wp_reset_postdata();
}

// Workshops query
if(count($carouselItems) <= $howManyToTake) {
    $workshopsWpQueryParams = [
        'post_type' => $workShopsSlugName,
        'posts_per_page' => '-1',
    ];
    $query = new WP_Query($workshopsWpQueryParams);
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            if(count($carouselItems) >= $howManyToTake) {
                break;
            }
            
            array_push($carouselItems, new CarouselItem(
                wp_get_attachment_image_src( get_field( 'workshop_image' ), 'large' )[0],
                wp_get_attachment_image_src( get_field( 'workshop_image' ), 'full' )[0],
                get_the_title(),
                get_permalink(),
                get_the_excerpt()
            ));
        endwhile;
    endif;
    wp_reset_postdata();
}

?>

<main id="home">
    <section class="hero-container slider-nav position-relative">
        <?php for ($i = 0; $i < count($carouselItems); $i++) : ?>
            <?php $carouselItem = $carouselItems[$i]; ?>
            <div class="carousel-img lozad" data-background-image="<?php echo $carouselItem->fullImg; ?>"></div>
        <?php endfor; ?>

    </section>

    <div class="container main-content">

        <section class="section-container">
            <div class="slider-for">
                <?php for ($i = 0; $i < count($carouselItems); $i++) : ?>
                    <?php $carouselItem = $carouselItems[$i]; ?>
                    <div class="news-item outline row no-gutters section-container margin-bottom-sm p-0 basic-anchor mx-3">
                        <div class="col-12 news-item-thumbnail basic-anchor">
                            <div class="container-img cover blur-img no-overlay" style="background-image: url('<?php echo $carouselItem->thumbnailImg; ?>');"></div>
                        </div> 
                        <div class="col-12 p-2 d-flex flex-column">
                            <h2>
                                <?php echo $carouselItem->title; ?>
                            </h2>
                            <div class="wysiwyg-container text-break">
                                <?php echo substr($carouselItem->description, 0, $carouselDescMaxLen); ?>
                                <?php echo strlen($carouselItem->description) > $carouselDescMaxLen ? '. . .' : ''; ?>
                            </div>

                            <div class="btn-bar d-inline-block news-item-button nav-light">
                                <a href="<?php echo $carouselItem->permalink; ?>" class="btn btn-glass">
                                    <?php echo $readMoreButton; ?>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        </section>


        <?php if ( have_rows( 'front_page_custom_sections', 'option' ) ) : ?>
            <?php while ( have_rows( 'front_page_custom_sections', 'option' ) ) : the_row(); ?>
                <?php 
                    $sectionTitle = get_sub_field( 'front_page_section_title' );
                    $sectionBody = get_sub_field( 'front_page_section_body' ); 
                ?>

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

        <section class="margin-top-sm margin-bottom-sm section-container">        
            <div class="wysiwyg-container">
                <?php curator_feed( ); ?>
            </div>
        </section>
    </div>
</main>

<?php get_footer(); ?>
