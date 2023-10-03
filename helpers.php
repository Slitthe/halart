<?php

$newsSlugName = 'stire';
$workShopsSlugName = 'atelier';
$eventsSlugName = 'eveniment';

if ( have_rows( 'nume_melci_slug', 'option' ) ) :
	while ( have_rows( 'nume_melci_slug', 'option' ) ) : the_row();
        $newsSlugName = get_sub_field( 'news_slug_name' );
        $workShopsSlugName = get_sub_field( 'workshops_slug_name' );
        $eventsSlugName = get_sub_field( 'events_slug_name' );
	endwhile;
endif;

$galleryName = 'galerie-imagini';
$imgGalleryOptions = '{"buttons":["download","close"]}';


$dateStoredFormat = 'd/m/Y H:i';
$datePrintFormatDateTime = 'd M Y H:i';
$datePrintFormatDateOnly = 'd M Y';
$eventDateFormat = 'j M Y';
$eventTimeFormat = 'H:m';
$eventsSmallDatePrintFormat = 'd M Y H:m';

$wp_queries_args = [
    "news_list" => ['post_type' => $newsSlugName]
];

function generate_gallery_item_caption($title, $linkUrl, $linkText) {
    $htmlString = '';
    $htmlString .= '<strong>' . $title . '</strong>';
    $htmlString .= '<br>';
    $htmlString .= '<a href="' . $linkUrl . '" target="_blank" rel="noreferrer noopener">';
    $htmlString .= $linkText . '</a>';

    return htmlspecialchars($htmlString);
}

function getDayFromDate($dateTime)
{
    switch ($dateTime->format('N')) {
        case 1:
            return 'Monday';
            break;
        case 2:
            return 'Tuesday';
            break;
        case 3:
            return 'Wednesday';
            break;
        case 4:
            return 'Thursday';
            break;
        case 5:
            return 'Friday';
            break;
        case 6:
            return 'Saturday';
            break;
        case 7:
            return 'Sunday';
            break;
    };
}

function getQueryParamsForCurrentEvents($itemsToShow, $slugName, $postId) {
    return array(
        'post_type' => $slugName,
        'post__not_in' => array($postId),
        'orderby' => 'meta_value',
        'meta_key' => 'event_datetime',
        'order' => 'ASC',
        'posts_per_page' => $itemsToShow,
        'meta_query' => array(
            array(
                'key' => 'event_datetime',
                'value' => date("Y-m-d"),
                'compare' => '>=',
                'type' => 'DATE'
                )
            ),
        );
}
    
function getQueryParamsForPastEvents($itemsToShow, $slugName, $postId) {
    return array(
        'post_type' => $slugName,
        'post__not_in' => array($postId),
        'orderby' => 'meta_value',
        'meta_key' => 'event_datetime',
        'order' => 'ASC',
        'posts_per_page' => $itemsToShow,
        'meta_query' => array(
            array(
                'key' => 'event_datetime',
                'value' => date("Y-m-d"),
                'compare' => '<',
                'type' => 'DATE'
                )
            ),
        );
}
