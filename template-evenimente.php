<?php
/* 
    Template Name: Evenimente
*/
?>
<?php get_header(); ?>
<?php include('helpers.php'); ?>

<?php

$title = get_field('events_title', 'option');
$pastEventsTitle = get_field('events_past_events_title', 'option');

$hero_image = get_field('events_hero_image', 'option');
$heroImgUrl = '';
if ($hero_image) {
    $heroImgUrl = wp_get_attachment_image_src($hero_image, 'large')[0];
}

$noFutureEventsMessage = get_field('events_no_future_events_message', 'option');

$detailsButton = get_field('events_details_button', 'option');
$ticketsButton = get_field('events_tickets_button', 'option');

$queryParamsForCurrentEvents = getQueryParamsForCurrentEvents('-1', $eventsSlugName, '-1');
$queryParamsForPastEvents = getQueryParamsForPastEvents('-1', $eventsSlugName, '-1');
?>

<main id="events">
    <section class="hero-container position-relative blur-container">
        <h1 class="hero-title position-absolute text-light text-uppercase font-weight-bold">
            <?php echo $title; ?>
        </h1>
        <div class="container-img cover blur-img" style="background-image: url('<?php echo $heroImgUrl; ?>');"></div>
    </section>

    <section class="container outline main-content mx-auto <?php echo $pastEventsTitle != '' ? '' : ' row'; ?>">
        <?php if($pastEventsTitle != '') : ?>
        <section class="current-events row">
        <?php endif ; ?>

            <?php $query = new WP_Query($queryParamsForCurrentEvents); ?>
            <?php if ($query->have_posts()) : ?>
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <?php

                    $permalink = get_permalink();
                    $datetime = new DateTime(get_field('event_datetime'));
                    $duration = get_field('event_duration');
                    $title = get_the_title();
                    $ticketsUrl = get_field('event_link');

                    $thumbnailImgUrl = '';
                    $thumbnailImgAlt = '';
                    $event_image = get_field( 'event_image' );
                    if ( $event_image ) { 
                        $thumbnailImgUrl = wp_get_attachment_image_src( $event_image, 'medium' )[0];
                        $thumbnailImgAlt = get_post_meta($event_image, '_wp_attachment_image_alt', true);
                    }
                    ?>
                    <section class="event col-12 col-lg-6">
                        <div>
                            <div class="event-thumbnail text-light d-flex justify-content-between flex-column">
                                <div class="container-img cover">
                                    <img class="lozad" data-src="<?php echo $thumbnailImgUrl; ?>" alt="<?php echo $thumbnailImgAlt; ?>" />
                                </div>
                                <div class="d-flex flex-column event-datetime-container text-center text-light ml-2 mt-2 info-box-body align-self-start">
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
                                            <?php echo  $datetime->format($eventTimeFormat); ?>
                                        </div>
                                        <div class="flex-1 position-relative event-duration text-light-white d-flex justify-content-center h6 m-0">
                                            <i class="icon-stopwatch h6"></i>
                                            <?php echo $duration; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="event-title text-center w-100 pl-2 py-2 flex-1 d-flex justify-content-center">
                                    <h2 class="mt-2 mb-0">
                                        <?php echo $title; ?>
                                    </h2>
                                </div>
                            </div>
                            <div class="d-flex btn-bar nav-light">
                                <a href="<?php echo $permalink; ?>" class="btn btn-glass rounded-0 flex-1">
                                    <?php echo $detailsButton; ?>
                                </a>
                                <a href="<?php echo $ticketsUrl; ?>" class="btn btn-glass rounded-0 flex-1 d-flex justify-content-center" rel="noreferrer noopener" target="_blank">
                                    <i class="icon-ticket"></i>
                                    <?php echo $ticketsButton; ?>
                                </a>
                            </div>
                        </div>
                    </section>
                <?php endwhile; ?>
            <?php else : ?>
                <div class="section-container py-5 margin-top-sm margin-bottom-sm col-12">
                    <?php echo $noFutureEventsMessage; ?>
                </div>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
        <?php if($pastEventsTitle != '') : ?>
        </section>
        <?php endif ; ?>

        <?php $query = new WP_Query($queryParamsForPastEvents); ?>
        <?php if ($query->have_posts()) : ?>
            <?php if ($pastEventsTitle != '') : ?>
                <div class="margin-top margin-bottom">
                    <div class="section-container margin-top-sm margin-bottom-sm">
                        <div class="divider-wrapper position-relative">
                            <div class="divider divider-transparent "></div>
                            <h2 class="position-absolute divider-title">
                                <?php echo $pastEventsTitle; ?>
                            </h2>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if($pastEventsTitle != '') : ?>
            <section class="past-events row">
            <?php endif ; ?>
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <?php

                    $permalink = get_permalink();
                    $datetime = new DateTime(get_field('event_datetime'));
                    $title = get_the_title();

                    $thumbnailImgUrl = '';
                    $thumbnailImgAlt = '';
                    $event_image = get_field( 'event_image' );
                    if ( $event_image ) { 
                        $thumbnailImgUrl = wp_get_attachment_image_src( $event_image, 'medium' )[0];
                        $thumbnailImgAlt = get_post_meta($event_image, '_wp_attachment_image_alt', true);
                    }
                    ?>
                    <section class="event past-event col-12 col-lg-6">
                        <div>
                            <div class="event-thumbnail text-light d-flex justify-content-between flex-column">
                                <div class="container-img cover">
                                    <img class="lozad" data-src="<?php echo $thumbnailImgUrl; ?>" alt="<?php echo $thumbnailImgAlt; ?>" />
                                </div>
                                <div class="event-title text-center w-100 pl-2 py-2 flex-1 d-flex justify-content-center">
                                    <h2 class="mt-2 mb-0">
                                        <?php echo $title; ?>
                                    </h2>
                                </div>
                            </div>
                            <div class="d-flex btn-bar nav-light">
                                <a href="<?php echo $permalink; ?>" class="btn btn-glass rounded-0 flex-1">
                                    <?php echo $detailsButton; ?>
                                </a>
                            </div>
                        </div>
                    </section>
                <?php endwhile; ?>
            <?php if($pastEventsTitle != '') : ?>
            </section>
            <?php endif ; ?>
        <?php else : ?>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>

    </section>

</main>



<?php get_footer(); ?>
