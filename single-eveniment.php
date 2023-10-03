<?php get_header(); ?>
<?php include('helpers.php'); ?>

<?php



$eventTitle = get_the_title();

$heroImgUrl = '';
$eventImage = get_field( 'event_image' );
if ( $eventImage ) {
	$heroImgUrl = wp_get_attachment_image_src( $eventImage, 'large' )[0];
}



$datetime = new DateTime(get_field('event_datetime'));
$duration = get_field('event_duration');


$locationLink = get_field('event_location');
$locationLinkUrl = $locationLink ? $locationLink['url'] : '';
$locationLinkTitle = $locationLink ? $locationLink['title'] : '';

$getTicketsButton = get_field('event_get_tickets_button', 'option');
$getTicketsUrl = get_field('event_link');

$bodyContent = get_post()->post_content;


$numOfRelatedEventsToShow = get_field('event_related_events_show_amount', 'option');


$postId = $post->ID;
$queryParamsForCurrentEvents = getQueryParamsForCurrentEvents($numOfRelatedEventsToShow, $eventsSlugName, $postId);
$queryParamsForPastEvents = getQueryParamsForPastEvents($numOfRelatedEventsToShow, $eventsSlugName, $postId);

$queryParamsForCurrentEventsAll = getQueryParamsForCurrentEvents('-1', $eventsSlugName, $postId);
$queryParamsForPastEventsAll = getQueryParamsForPastEvents('-1', $eventsSlugName, $postId);



$allCurrentEventsCount = (new WP_Query($queryParamsForCurrentEventsAll))->post_count;
$allPastEventsCount = (new WP_Query($queryParamsForPastEventsAll))->post_count;

$allCurrentEventsCount2 = (new WP_Query($queryParamsForCurrentEvents))->post_count;
$allPastEventsCount2 = (new WP_Query($queryParamsForPastEvents))->post_count;

$seeMoreEventsUrl = get_field('read_more_events_url', 'option');

$currentEventsSectionTitle = get_field('event_future_events_section_title', 'option');
$pastEventsSectionTitle = get_field('event_past_events_section_title', 'option');

$seeMoreEventsButton = get_field('event_see_all_events_button', 'option');

$noFutureEventsMessage = get_field('event_no_more_events_message', 'option');

?>

<main id="event">
    <div class="background-image-container position-absolute position-absolute-cover">
        <div class="background-image position-absolute position-absolute-cover" style="background: url('<?php echo $heroImgUrl; ?>') center/cover no-repeat;"></div>
    </div>

    <section class="outline main-content">
        <h1 class="event-title text-light text-center text-uppercase">
            <?php echo $eventTitle; ?>
        </h1>

        <section class="text-center">
            <div class="d-inline-block">
                <div class="thumbnail-info d-flex flex-column">
                    <div class="info-box-body d-flex flex-column event-datetime-container text-center text-light">
                        <div>
                            <div class="event-day-text py-1 m-0 h6">
                                <i class="icon-calendar"></i>
                                <?php echo getDayFromDate($datetime); ?>
                            </div>
                            <div class="event-date d-flex justify-content-center flex-0-5 h5 py-1 m-0">
                                <?php echo $datetime->format($eventDateFormat); ?>
                            </div>
                        </div>
                        <div class="event-datetime d-flex">
                            <div class="flex-1 position-relative event-time text-light-white d-flex justify-content-center h6 m-0">
                                <i class="icon-clock h6"></i>
                                <?php echo $datetime->format($eventTimeFormat); ?>
                            </div>
                            <div class="flex-1 position-relative event-duration text-light-white d-flex justify-content-center h6 m-0">
                                <i class="icon-stopwatch h6"></i>
                                <?php echo $duration; ?>
                            </div>
                        </div>

                    </div>
                    <a href="<?php echo $locationLinkUrl; ?>" class="info-box-body text-light text-center mt-2 d-flex p-2 event-location" rel="noreferrer noopener" target="_blank">
                        <i class="icon-location mr-1"></i>
                        <span>
                            <?php echo $locationLinkTitle; ?>
                        </span>
                    </a>
                    <div class="d-flex get-tickets-btn btn-bar nav-light d-inline-block mt-2">
                        <a href="<?php echo $getTicketsUrl; ?>" class="btn btn-glass d-flex justify-content-center" rel="noreferrer noopener" target="_blank">
                            <i class="icon-ticket"></i>
                            <?php echo $getTicketsButton; ?>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <div class="container">
            <div id="single-event" class="event-body outline section-container margin-top-sm">
                <article class="wysiwyg-container">
                    <?php echo $bodyContent; ?>
                </article>

                <section>
                    <?php if (have_rows('event_image_gallery')) : ?>
                        <div class="divider-wrapper position-relative">
                            <div class="divider divider-transparent"></div>
                        </div>
                        <div class="row image-gallery">
                            <?php while (have_rows('event_image_gallery')) : the_row(); ?>
                                <?php

                                $fullImgUrl = '';
                                $smallImgUrl = '';
                                $imgAlt = '';
                                $event_gallery_image = get_sub_field( 'event_gallery_image' );
                                if ( $event_gallery_image ) { 
                                    $fullImgUrl = wp_get_attachment_image_src( $event_gallery_image, 'full' )[0];
                                    $smallImgUrl = wp_get_attachment_image_src( $event_gallery_image, 'medium' )[0];;
                                    $imgAlt = get_post_meta($event_gallery_image, '_wp_attachment_image_alt', true);
                                }

                                $eventGalleryTitle = get_sub_field('event_gallery_title');
                                $eventGalleryLink = $event_gallery_link = get_sub_field('event_gallery_link');
                                $caption = generate_gallery_item_caption($eventGalleryTitle, $eventGalleryLink['url'], $eventGalleryLink['title']);
                                ?>

                                <a class="my-4 gallery-item col-12 col-sm-6 col-lg-4 col-xl-3 d-flex align-items-center justify-content-center" href="<?php echo $fullImgUrl; ?>" data-fancybox="<?php echo $galleryName; ?>" data-options='<?php echo $imgGalleryOptions; ?>' data-caption="<?php echo $caption; ?>">
                                    <img src="<?php echo $smallImgUrl; ?>" alt="<?php echo $imgAlt; ?>" />
                                </a>


                            <?php endwhile; ?>
                        </div>
                    <?php else : ?>
                    <?php endif; ?>

                </section>
            </div>

            <section class="row no-gutters event-sidebar outline section-container margin-top-sm">
                <div class="col-12 col-lg-6">
                    <h2>
                        <?php echo $currentEventsSectionTitle; ?>
                    </h2>
                    <div class="ml-4 current-events">
                        <?php $query = new WP_Query($queryParamsForCurrentEvents); ?>
                        <?php $postsCount = $query->post_count; ?>
                        <?php if ($query->have_posts()) : ?>
                            <?php while ($query->have_posts()) : $query->the_post(); ?>
                                <?php
                                $permalink = get_permalink();
                                $datetime = new DateTime(get_field('event_datetime'));
                                $title = get_the_title();
                                ?>
                                <div class="current-event">
                                    <a href="<?php echo $permalink; ?>">
                                        <h2 class="h4">
                                            <?php echo $title; ?>
                                        </h2>
                                    </a>
                                    <div class="ml-3 text-muted current-event-datetime">
                                        <?php echo $datetime->format($eventsSmallDatePrintFormat); ?>
                                    </div>
                                </div>

                            <?php endwhile; ?>
                            <?php if ($postsCount < $allCurrentEventsCount) : ?>
                                <div class="w-100 text-center mt-3">
                                    <div class="btn-bar d-inline-block nav-light">
                                        <a class="btn btn-glass" href="<?php echo $seeMoreEventsUrl; ?>">
                                            <?php echo $seeMoreEventsButton; ?>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php else : ?>
                            <div class="wysiwyg-container w-100 mt-3">
                                <?php echo $noFutureEventsMessage; ?>
                            </div>

                        <?php endif; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <h2>
                        <?php echo $pastEventsSectionTitle; ?>
                    </h2>
                    <div class="ml-4 past-events">
                        <?php $query = new WP_Query($queryParamsForPastEvents); ?>
                        <?php $postsCount = $query->post_count; ?>
                        <?php if ($query->have_posts()) : ?>
                            <?php while ($query->have_posts()) : $query->the_post(); ?>
                                <?php
                                $permalink = get_permalink();
                                $datetime = new DateTime(get_field('event_datetime'));
                                $title = get_the_title();
                                ?>
                                <div class="past-event">
                                    <a href="<?php echo $permalink; ?>">
                                        <h2 class="h4">
                                            <?php echo $title; ?>
                                        </h2>
                                    </a>
                                    <div class="ml-3 text-muted current-event-datetime">
                                        <?php echo $datetime->format($eventsSmallDatePrintFormat); ?>
                                    </div>
                                </div>

                            <?php endwhile; ?>
                            <?php if ($postsCount < $allPastEventsCount) : ?>
                                <div class="w-100 text-center mt-3">
                                    <div class="nav-light btn-bar d-inline-block">
                                        <a class="btn btn-glass" href="<?php echo $seeMoreEventsUrl; ?>">
                                            <?php echo $seeMoreEventsButton; ?>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php else : ?>

                        <?php endif; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                </div>

            </section>

            <section class="margin-top-sm">
                <?php echo sharethis_inline_buttons(); ?>
            </section>
        </div>
    </section>
</main>
<?php get_footer(); ?>
