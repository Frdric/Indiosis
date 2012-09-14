<?php
/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 *
 * Main Configuration File
 * Describes all the configuration variables of Indiosis.
 *
 * @package     all
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI 2012
 */

// Include helper functions
require_once( dirname(__FILE__) . '/../components/helpers.inc');

// Define home folder path
$homePath = dirname(__FILE__) . '/../..';

// Simple function to join paths
function _joinpath($dir1, $dir2) {
    return realpath($dir1 . DIRECTORY_SEPARATOR . $dir2);
}

return array(

    // Path to the protected folder
    'basePath'=>_joinpath($homePath, 'protected'),

    // Name of the application
    'name'=>'Indiosis',

    // Default controller to use
    'defaultController'=>'home',

    // Path to runtime folder
    'runtimePath' => _joinpath($homePath, 'runtime'),

    // User language
    'language'=>'en',

    // Message and views language
    'sourceLanguage'=>'en',

    // Application charset
    'charset'=>'utf-8',

    // Preloading 'log' component
    'preload'=>array('log'),

    // Autoloading model and component classes
    'import'=>array(
        'application.models.*',
        'application.models.forms.*',
        'application.components.*'
    ),

    //To be uncommented when auto-creation panel is needed.
    'modules'=>array(
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'primeroi',
            'generatorPaths'=>array(
                'application.gii',   // a path alias
            )
        ),
    ),

    'components'=>array(

        // Setup user authentication rules
        'user'=>array(
            'allowAutoLogin'=>true,
            'loginUrl'=> '/indiosis/',
        ),

        // Simplify URLs
        'urlManager'=>array(
            'urlFormat'=>'path',
            'showScriptName'=>'false',
            'rules'=>array(
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            )
        ),

        // Setup the DB connexion
        'db'=>array(
                'connectionString' => 'mysql:host=127.0.0.1;dbname=indiosis',
                'emulatePrepare' => true,
                'username' => 'indiosis',
                'password' => 'roi',
                'charset' => 'utf8',
        ),

        // Redirect errors to Indiosis error page
        'errorHandler'=>array(
            // use 'home/error' action to display errors
            'errorAction'=>'home/error',
        ),

        // Enables logs
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning',
                )
            )
        ),

        // Specify the asset folder path
        'assetManager'=>array(
            'basePath'=>_joinpath($homePath,'webroot/assets'),
            'baseUrl'=>'/indiosis/assets'
        )
    ),

    // Other parameters (accessible through Yii::app()->params['paramName'])
    'params'=>array(
        'indiosisEmail'=>'info@indiosis.com',
        'notificationEmail'=>'fred@roi-online.org',
        'adminEmail'=>'fred@roi-online.org',
        'indiosisVersion' => 'beta',
        'indiosisVersionNumber' => '0.2',
        'ajaxSuccess' => 'OK',
        'ajaxFailure' => 'ERROR',
        'linkedinKey' => 'L4gyxZw6qwgyw1Gc2baz0HutNqeIafCLf7WhjHklXyGnBvcL65-ysOa1smgdN3lc',
        'linkedinSecret' => '3mTvuDViCJia6Htx7Yhbq52Ia0eErN_MY1lzdwdEyR-Afpo9P8i3gCDJgMy9NdpQ',
        'countryList' => include( _joinpath(_joinpath($homePath,'protected'),'data').'/country-list.php' ),
        'industryList' => array('ACCOUNTING' => 'Accounting',
                                'AIRLINES_AVIATION' => 'Airlines/Aviation',
                                'ALTERNATIVE_DISPUTE_RESOLUTION' => 'Alternative Dispute Resolution',
                                'ALTERNATIVE_MEDICINE' => 'Alternative Medicine',
                                'ANIMATION' => 'Animation',
                                'APPAREL_AND_FASHION' => 'Apparel &amp; Fashion',
                                'ARCHITECTURE_AND_PLANNING' => 'Architecture &amp; Planning',
                                'ARTS_AND_CRAFTS' => 'Arts &amp; Crafts',
                                'AUTOMOTIVE' => 'Automotive',
                                'AVIATION_AND_AEROSPACE' => 'Aviation &amp; Aerospace',
                                'BANKING' => 'Banking',
                                'BIOTECHNOLOGY' => 'Biotechnology',
                                'BROADCAST_MEDIA" selected="' => 'Broadcast Media',
                                'BUILDING_MATERIALS' => 'Building Materials',
                                'BUSINESS_SUPPLIES_AND_EQUIPMENT' => 'Business Supplies &amp; Equipment',
                                'CAPITAL_MARKETS' => 'Capital Markets',
                                'CHEMICALS' => 'Chemicals',
                                'CIVIC_AND_SOCIAL_ORGANIZATION' => 'Civic &amp; Social Organization',
                                'CIVIL_ENGINEERING' => 'Civil Engineering',
                                'COMMERCIAL_REAL_ESTATE' => 'Commercial Real Estate',
                                'COMPUTER_AND_NETWORK_SECURITY' => 'Computer &amp; Network Security',
                                'COMPUTER_GAMES' => 'Computer Games',
                                'COMPUTER_HARDWARE' => 'Computer Hardware',
                                'COMPUTER_NETWORKING' => 'Computer Networking',
                                'COMPUTER_SOFTWARE' => 'Computer Software',
                                'CONSTRUCTION' => 'Construction',
                                'CONSUMER_ELECTRONICS' => 'Consumer Electronics',
                                'CONSUMER_GOODS' => 'Consumer Goods',
                                'CONSUMER_SERVICES' => 'Consumer Services',
                                'COSMETICS' => 'Cosmetics',
                                'DAIRY' => 'Dairy',
                                'DEFENSE_AND_SPACE' => 'Defense &amp; Space',
                                'DESIGN' => 'Design',
                                'EDUCATION_MANAGEMENT' => 'Education Management',
                                'E_LEARNING' => 'E-learning',
                                'ELECTRICAL_AND_ELECTRONIC_MANUFACTURING' => 'Electrical &amp; Electronic Manufacturing',
                                'ENTERTAINMENT' => 'Entertainment',
                                'ENVIRONMENTAL_SERVICES' => 'Environmental Services',
                                'EVENTS_SERVICES' => 'Events Services',
                                'EXECUTIVE_OFFICE' => 'Executive Office',
                                'FACILITIES_SERVICES' => 'Facilities Services',
                                'FARMING' => 'Farming',
                                'FINANCIAL_SERVICES' => 'Financial Services',
                                'FINE_ART' => 'Fine Art',
                                'FISHERY' => 'Fishery',
                                'FOOD_AND_BEVERAGES' => 'Food &amp; Beverages',
                                'FOOD_PRODUCTION' => 'Food Production',
                                'FUNDRAISING' => 'Fundraising',
                                'FURNITURE' => 'Furniture',
                                'GAMBLING_AND_CASINOS' => 'Gambling &amp; Casinos',
                                'GLASS_CERAMICS_AND_CONCRETE' => 'Glass, Ceramics &amp; Concrete',
                                'GOVERNMENT_ADMINISTRATION' => 'Government Administration',
                                'GOVERNMENT_RELATIONS' => 'Government Relations',
                                'GRAPHIC_DESIGN' => 'Graphic Design',
                                'HEALTH_WELLNESS_AND_FITNESS' => 'Health, Wellness &amp; Fitness',
                                'HIGHER_EDUCATION' => 'Higher Education',
                                'HOSPITAL_AND_HEALTH_CARE' => 'Hospital &amp; Health Care',
                                'HOSPITALITY' => 'Hospitality',
                                'HUMAN_RESOURCES' => 'Human Resources',
                                'IMPORT_AND_EXPORT' => 'Import &amp; Export',
                                'INDIVIDUAL_AND_FAMILY_SERVICES' => 'Individual &amp; Family Services',
                                'INDUSTRIAL_AUTOMATION' => 'Industrial Automation',
                                'INFORMATION_SERVICES' => 'Information Services',
                                'INFORMATION_TECHNOLOGY_AND_SERVICES' => 'Information Technology &amp; Services',
                                'INSURANCE' => 'Insurance',
                                'INTERNATIONAL_AFFAIRS' => 'International Affairs',
                                'INTERNATIONAL_TRADE_AND_DEVELOPMENT' => 'International Trade &amp; Development',
                                'INTERNET' => 'Internet',
                                'INVESTMENT_BANKING_AND_VENTURE' => 'Investment Banking/Venture',
                                'INVESTMENT_MANAGEMENT' => 'Investment Management',
                                'JUDICIARY' => 'Judiciary',
                                'LAW_ENFORCEMENT' => 'Law Enforcement',
                                'LAW_PRACTICE' => 'Law Practice',
                                'LEGAL_SERVICES' => 'Legal Services',
                                'LEGISLATIVE_OFFICE' => 'Legislative Office',
                                'LEISURE_AND_TRAVEL' => 'Leisure &amp; Travel',
                                'LIBRARIES' => 'Libraries',
                                'LOGISTICS_AND_SUPPLY_CHAIN' => 'Logistics &amp; Supply Chain',
                                'LUXURY_GOODS_AND_JEWELRY' => 'Luxury Goods &amp; Jewelry',
                                'MACHINERY' => 'Machinery',
                                'MANAGEMENT_CONSULTING' => 'Management Consulting',
                                'MARITIME' => 'Maritime',
                                'MARKETING_AND_ADVERTISING' => 'Marketing &amp; Advertising',
                                'MARKET_RESEARCH' => 'Market Research',
                                'MECHANICAL_OR_INDUSTRIAL_ENGINEERING' => 'Mechanical or Industrial Engineering',
                                'MEDIA_PRODUCTION' => 'Media Production',
                                'MEDICAL_DEVICE' => 'Medical Device',
                                'MEDICAL_PRACTICE' => 'Medical Practice',
                                'MENTAL_HEALTH_CARE' => 'Mental Health Care',
                                'MILITARY' => 'Military',
                                'MINING_AND_METALS' => 'Mining &amp; Metals',
                                'MOTION_PICTURES_AND_FILM' => 'Motion Pictures &amp; Film',
                                'MUSEUMS_AND_INSTITUTIONS' => 'Museums &amp; Institutions',
                                'MUSIC' => 'Music',
                                'NANOTECHNOLOGY' => 'Nanotechnology',
                                'NEWSPAPERS' => 'Newspapers',
                                'NON_PROFIT_ORGANIZATION_MANAGEMENT' => 'Nonprofit Organization Management',
                                'OIL_AND_ENERGY' => 'Oil &amp; Energy',
                                'ONLINE_PUBLISHING' => 'Online Publishing',
                                'OUTSOURCING_OFFSHORING' => 'Outsourcing/Offshoring',
                                'PACKAGE_AND_FREIGHT_DELIVERY' => 'Package/Freight Delivery',
                                'PACKAGING_AND_CONTAINERS' => 'Packaging &amp; Containers',
                                'PAPER_AND_FOREST_PRODUCTS' => 'Paper &amp; Forest Products',
                                'PERFORMING_ARTS' => 'Performing Arts',
                                'PHARMACEUTICALS' => 'Pharmaceuticals',
                                'PHILANTHROPY' => 'Philanthropy',
                                'PHOTOGRAPHY' => 'Photography',
                                'PLASTICS' => 'Plastics',
                                'POLITICAL_ORGANIZATION' => 'Political Organization',
                                'PRIMARY_SECONDARY' => 'Primary/Secondary',
                                'PRINTING' => 'Printing',
                                'PROFESSIONAL_TRAINING' => 'Professional Training',
                                'PROGRAM_DEVELOPMENT' => 'Program Development',
                                'PUBLIC_POLICY' => 'Public Policy',
                                'PUBLIC_RELATIONS' => 'Public Relations',
                                'PUBLIC_SAFETY' => 'Public Safety',
                                'PUBLISHING' => 'Publishing',
                                'RAILROAD_MANUFACTURE' => 'Railroad Manufacture',
                                'RANCHING' => 'Ranching',
                                'REAL_ESTATE' => 'Real Estate',
                                'RECREATIONAL_FACILITIES_AND_SERVICES' => 'Recreational Facilities &amp; Services',
                                'RELIGIOUS_INSTITUTIONS' => 'Religious Institutions',
                                'RENEWABLES_AND_ENVIRONMENT' => 'Renewables &amp; Environment',
                                'RESEARCH' => 'Research',
                                'RESTAURANTS' => 'Restaurants',
                                'RETAIL' => 'Retail',
                                'SECURITY_AND_INVESTIGATIONS' => 'Security &amp; Investigations',
                                'SEMICONDUCTORS' => 'Semiconductors',
                                'SHIPBUILDING' => 'Shipbuilding',
                                'SPORTING_GOODS' => 'Sporting Goods',
                                'SPORTS' => 'Sports',
                                'STAFFING_AND_RECRUITING' => 'Staffing &amp; Recruiting',
                                'SUPERMARKETS' => 'Supermarkets',
                                'TELECOMMUNICATIONS' => 'Telecommunications',
                                'TEXTILES' => 'Textiles',
                                'THINK_TANKS' => 'Think Tanks',
                                'TOBACCO' => 'Tobacco',
                                'TRANSLATION_AND_LOCALIZATION' => 'Translation &amp; Localization',
                                'TRANSPORTATION_TRUCKING_AND_RAILROAD' => 'Transportation/Trucking/Railroad',
                                'UTILITIES' => 'Utilities',
                                'VENTURE_CAPITAL' => 'Venture Capital',
                                'VETERINARY' => 'Veterinary',
                                'WAREHOUSING' => 'Warehousing',
                                'WHOLESALE' => 'Wholesale',
                                'WINE_AND_SPIRITS' => 'Wine &amp; Spirits',
                                'WIRELESS' => 'Wireless',
                                'WRITING_AND_EDITING' => 'Writing &amp; Editing')
    )
);