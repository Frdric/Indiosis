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
Yii::import('ext.gmap.*');

class GeoHelper extends CComponent {
    
    
    /**
     * Retrieve coordinates of a given location address.
     * @param Location $location The location address to which coordinates needs to be added.
     * @return EGMapGeocodedAddress The given location updated with the corresponding geo-coordinates.
     */
    public static function lookupCoordinates($location)
    {
        $gMap = new EGMap();
        $geocoded_address = new EGMapGeocodedAddress($location->addressLine1.' '.$location->city.' '.$location->country);
        $geocoded_address->geocode($gMap->getGMapClient());
        return $geocoded_address;
    }
    
    
    /**
     * Retrieve the location of a given set of coordinates.
     * @param EGMapGeocodedAddress $coordinates The coordinates.
     * @return Array The coordinates' closest location address.
     */
    public static function lookupLocation($coordinates)
    {
        $gMap = new EGMap();
        return $gMap->getGMapClient()->getReverseGeocodingInfo($coordinates->getLat(), $coordinates->getLng());
    }
    
    
    /**
     * Places the given Location on a map and displays it.
     * @param EGMapGeocodedAddress $location The location to display.
     */
    public static function showLocationOnMap($location)
    {
        $gMap = new EGMap();
        // set map overall style
        $gMap->setHtmlOptions(array("class"=>"gmap"));
        $gMap->zoom = 5;
        $gMap->mapTypeId = EGMap::TYPE_TERRAIN;
        $gMap->mapTypeControl = false;
        $gMap->zoomControl = false;
        $gMap->streetViewControl = false;
        // set map location info
        $gMap->setCenter($location->getLat(), $location->getLng());
        $icon = new EGMapMarkerImage(Yii::app()->baseUrl.'/images/map_factory_pin.png');
        $icon->setSize(32, 37);
        $icon->setAnchor(16, 37);
        $icon->setOrigin(0, 0);
        $marker = new EGMapMarker($location->getLat(), $location->getLng(), array('icon'=>$icon));
        $gMap->addMarker($marker);
        
        return $gMap;
    }
    
}
?>
