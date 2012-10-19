<?php
/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * - -- - - - - - - - - - - - *
 *
 * CONTROLLER : Profile
 * Handles all profile related actions.
 *
 * @package     profile
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */

class ProfileController extends IndiosisController
{

    /**
     * Specify the access rules for this controller.
     */
    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('index'),
                'users'=>array('@'),
            ),
            array('deny',
                'actions'=>array('index')
            ),
        );
    }

    public function actionIndex()
    {
        $this->breadcrumbsLinks = array('My Company'=>'index','Profile');

        // retrieve organisation data
        $organization = Organization::model()->findByAttributes(array('id'=>Yii::app()->user->organizationId));
        if(count($organization->locations)==0) {
            $orgLocation = new Location;
            $orgLocation->country = "India";
            //Helpers::getFromLinkedIn('company');
        }
        else {
            $orgLocation = $organization->locations[0];
        }

        $geoLocation = GeoHelper::lookupCoordinates($orgLocation);

        $vmapMarkers = array(   "latLng" => array($geoLocation->getLat(),$geoLocation->getLng()),
                                "r" => 3,
                                "fill" => "#2582A9",
                                "name" => $organization->acronym);

        $this->render('profile',array(  'organization'=>$organization,
                                        'org_location'=>$orgLocation,
                                        'vmapMarkers'=>$vmapMarkers,
                                        'org_commeans'=>$organization->communicationMeans));
    }
}