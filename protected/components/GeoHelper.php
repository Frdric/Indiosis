<?php
/* 
 * - - - - - - - - - - - - - - - - - - - *
 * INDIOSIS                              *
 * The resource optimization community.  *
 * - - - - - - - - - - - - - - - - - - - *
 * 
 * Geo Helper component
 * Component handling all the geographic-related functionalities.
 * 
 * @package     all
 * @author      Frederic Andreae
 * @copyright   Copyright (C) 2011, ROI
 */

// import EGMap
Yii::import('ext.gmaps.*');

class GeoHelper extends CComponent {
    
    
    /**
     * Lookup and update a Location with its correspondong geo-coordinates (lat,lng).
     * (The returned coordinates are based on the city the material is in).
     * @param Location $location The location to which coordinates needs to be added.
     * @return Location The given location updated with the corresponding geo-coordinates.
     */
    public static function lookupCoordinates($location)
    {
        $gMap = new EGMap();
        $geocoded_address = new EGMapGeocodedAddress($location->city.' '.$location->country);
        $geocoded_address->geocode($gMap->getGMapClient());
        $location->lat = $geocoded_address->getLat();
        $location->lng = $geocoded_address->getLng();
        return $location;
    }
    
    
    /**
     * Calculate the distance in kilometers between two locations.
     * @param Location $location_1 Location of the first company or material.
     * @param Location $location_2 Location of the second company or material.
     * @return float The distance in Km between the two locations.
     */
    public static function getSeperatingDistance($location_1,$location_2)
    {
        $loc1 = new EGMapCoord($location_1->lat, $location_1->lng);
        $loc2 = new EGMapCoord($location_2->lat, $location_2->lng);
        return $loc1->distanceFrom($loc2);
    }
    
    /**
     * Places the given Location on a map and displays it.
     * @param Location $location The location to display.
     * @param string $locationInfo Information to be displayed on the map.
     */
    public static function showLocationOnMap($location,$locationInfo)
    {
        $gMap = new EGMap();
        $gMap->zoom = 6;
        $gMap->setCenter($location->lat, $location->lng);
        $icon = new EGMapMarkerImage(Yii::app()->baseUrl.'images/map_factory.png');
        $icon->setSize(32, 37);
        $icon->setAnchor(16, 16.5);
        $icon->setOrigin(0, 0);
        $marker = new EGMapMarker($location->lat, $location->lng, array('title' => $location->label,'icon'=>$icon));
        $gMap->addMarker($marker);
        $gMap->renderMap();
    }
    
}
?>
