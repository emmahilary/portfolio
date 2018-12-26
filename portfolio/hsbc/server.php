<?php
    require( 'includes/PageScraper.php');

    $pageScraper = new PageScraper();
    $pageScraper->setURL( 'https://www.hsbc.com/about-hsbc/contact-us/country-contacts' );


    $countries = $pageScraper->scrapeAll( '#SecondaryContentSection > div' );

    $countryIDs = array();
    $country_list = array();
    $omissions = array('Hong Kong', 'Macau SAR', 'Armenia', 'Isle of Man', 'Channel Islands', 'Monaco', 'Luxembourg', 'Malta', 'Bermuda', 'Bangladesh', 'Qatar', 'Mauritius', 'Israel', 'Kuwait', 'Austria', 'Netherlands', 'Switzerland', 'Singapore', 'Palestinian Territories', 'Bahrain', 'Lebanon', 'Maldives', 'Belgium', 'Czech Republic', 'Oman', 'Algeria', 'Sri Lanka', 'Poland', 'Uruguay', 'UAE');
    $counter = 0;
    foreach($countries as $countryDiv ) {
//        $counter++;
//        if( $counter > 50 ){
//            break;
//        }
        // array_push( $countryIDs, $countryDiv->id );
        $name = $countryDiv( '.custom-popup-heading', 0 )->getPlainText();
        if( $countryDiv( '.link-contact', 0 ) and ( !in_array( trim( $name ), $omissions ) ) ){
            $country_list[ $countryDiv->id ] = array(
                'name' => $name,
                'url' => $countryDiv( '.link-contact', 0 )->getPlainText()
            );
        }
    }

    
    header( 'Content-Type: application/json' );
    echo json_encode( $country_list, JSON_PRETTY_PRINT );




    
