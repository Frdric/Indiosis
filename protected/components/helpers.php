<?php
/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 *
 * HELPER Functions
 * Class including all the various small helping functions used throughout the application.
 *
 * @package     all
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */

class Helpers {

    /**
     * Build and returns the page title for any page.
     * @param string $titlePart If the title should include a special indication.
     * @return string The final page title.
     */
    public static function buildPageTitle($titlePart=null)
    {
        if($titlePart!=null) {
            $pageTitle = $titlePart.' | Indiosis';
        }
        else {
            $pageTitle = 'Indiosis';
        }

        return $pageTitle;
    }

    /**
     * LinkedIn call helper.
     * @param string What needs to be retrieve (profile or company)
     * @param User The user you wish the retrieve information about (default is current user).
     * @return array The requested information or null if nothing has been retrieved.
     */
    public static function getFromLinkedIn($what=null,$user=null)
    {
        Yii::import('ext.simple-linkedin.*');
        $lkdinResponse = null;

        if($user==null) {
            $user = User::model()->findByAttributes(array('id'=>Yii::app()->user->_id));
        }
        $API_CONFIG = array(
          'appKey'       => Yii::app()->params['linkedinKey'],
          'appSecret'    => Yii::app()->params['linkedinSecret'],
          'callbackUrl'  => Yii::app()->params['linkedinBackUrl']
        );
        $linkedin = new LinkedIn($API_CONFIG);

        $linkedin->setToken(array('oauth_token' => $user->oauth_token, 'oauth_token_secret' => $user->oauth_secret));
        $linkedin->setResponseFormat(LINKEDIN::_RESPONSE_JSON);

        switch ($what) {
            case 'company':
                $lkdinResponse = $linkedin->profile('~:(id,first-name,last-name,email-address,positions)');
                break;
            case 'profile':
                $lkdinResponse = $linkedin->profile('~:(id,first-name,last-name,email-address,positions)');
                break;

            default:
                // get profile by default
                $lkdinResponse = $linkedin->profile('~:(id,first-name,last-name,email-address,positions)');
                break;
        }
        if($lkdinResponse!=null) {
            $lkdinResponse = $lkdinResponse['linkedin'];
        }

        return $lkdinResponse;
    }


    /**
     * Output an array of variables into the client's JS script.
     * @param array $phpVar An array of variables.
     */
    public static function varToJS($phpVar)
    {
        $jsVarScript = "// Set specific variables \r\n";

        if(is_array($phpVar)) {
            // transform each value into a JS variable
            $jsVarScript .= 'var specificVar = '.json_encode($phpVar);

            Yii::app()->clientScript->registerScript('specificVar',$jsVarScript,CClientScript::POS_HEAD);
        }
    }


    /**
    * Returns either a relative date or a formatted date depending
    * on the difference between the current time and given datetime.
    * $datetime should be in a <i>strtotime</i>-parsable format, like MySQL's datetime datatype.
    *
    * Options:
    *  'format' => a fall back format if the relative time is longer than the duration specified by end
    *  'end' =>  The end of relative time telling
    *
    * Relative dates look something like this:
    *   3 weeks, 4 days ago
    *   15 seconds ago
    * Formatted dates look like this:
    *   on 02/18/2004
    *
    * The returned string includes 'ago' or 'on' and assumes you'll properly add a word
    * like 'Posted ' before the function output.
    *
    * @param string $dateString Datetime string
    * @param array $options Default format if timestamp is used in $dateString
    * @return string Relative time string.
    */
    function timeAgoInWords($dateTime, $options = array())
    {
        $now = time();

        $inSeconds = strtotime($dateTime);
        $backwards = ($inSeconds > $now);

        $format = 'j/n/y';
        $end = '+11 month';

        if (is_array($options)) {
            if (isset($options['format'])) {
                $format = $options['format'];
                unset($options['format']);
            }
            if (isset($options['end'])) {
                $end = $options['end'];
                unset($options['end']);
            }
        } else {
            $format = $options;
        }

        if ($backwards) {
            $futureTime = $inSeconds;
            $pastTime = $now;
        } else {
            $futureTime = $now;
            $pastTime = $inSeconds;
        }
        $diff = $futureTime - $pastTime;

        // If more than a week, then take into account the length of months
        if ($diff >= 604800) {
            $current = array();
            $date = array();

            list($future['H'], $future['i'], $future['s'], $future['d'], $future['m'], $future['Y']) = explode('/', date('H/i/s/d/m/Y', $futureTime));

            list($past['H'], $past['i'], $past['s'], $past['d'], $past['m'], $past['Y']) = explode('/', date('H/i/s/d/m/Y', $pastTime));
            $years = $months = $weeks = $days = $hours = $minutes = $seconds = 0;

            if ($future['Y'] == $past['Y'] && $future['m'] == $past['m']) {
                $months = 0;
                $years = 0;
            } else {
                if ($future['Y'] == $past['Y']) {
                    $months = $future['m'] - $past['m'];
                } else {
                    $years = $future['Y'] - $past['Y'];
                    $months = $future['m'] + ((12 * $years) - $past['m']);

                    if ($months >= 12) {
                        $years = floor($months / 12);
                        $months = $months - ($years * 12);
                    }

                    if ($future['m'] < $past['m'] && $future['Y'] - $past['Y'] == 1) {
                        $years --;
                    }
                }
            }

            if ($future['d'] >= $past['d']) {
                $days = $future['d'] - $past['d'];
            } else {
                $daysInPastMonth = date('t', $pastTime);
                $daysInFutureMonth = date('t', mktime(0, 0, 0, $future['m'] - 1, 1, $future['Y']));

                if (!$backwards) {
                    $days = ($daysInPastMonth - $past['d']) + $future['d'];
                } else {
                    $days = ($daysInFutureMonth - $past['d']) + $future['d'];
                }

                if ($future['m'] != $past['m']) {
                    $months --;
                }
            }

            if ($months == 0 && $years >= 1 && $diff < ($years * 31536000)) {
                $months = 11;
                $years --;
            }

            if ($months >= 12) {
                $years = $years + 1;
                $months = $months - 12;
            }

            if ($days >= 7) {
                $weeks = floor($days / 7);
                $days = $days - ($weeks * 7);
            }
        } else {
            $years = $months = $weeks = 0;
            $days = floor($diff / 86400);

            $diff = $diff - ($days * 86400);

            $hours = floor($diff / 3600);
            $diff = $diff - ($hours * 3600);

            $minutes = floor($diff / 60);
            $diff = $diff - ($minutes * 60);
            $seconds = $diff;
        }
        $relativeDate = '';
        $diff = $futureTime - $pastTime;

        if ($diff > abs($now - strtotime($end))) {
            $relativeDate = sprintf('on %s', date($format, $inSeconds));
        } else {
            if ($years > 0) {
                // years and months and days
                $relativeDate .= ($relativeDate ? ', ' : '') . $years . ' ' . ($years==1 ? 'year':'years');
                $relativeDate .= $months > 0 ? ($relativeDate ? ', ' : '') . $months . ' ' . ($months==1 ? 'month':'months') : '';
            } elseif (abs($months) > 0) {
                // months, weeks and days
                $relativeDate .= ($relativeDate ? ', ' : '') . $months . ' ' . ($months==1 ? 'month':'months');
            } elseif (abs($weeks) > 0) {
                // weeks and days
                $relativeDate .= ($relativeDate ? ', ' : '') . $weeks . ' ' . ($weeks==1 ? 'week':'weeks');
            } elseif (abs($days) > 0) {
                // days and hours
                $relativeDate .= ($relativeDate ? ', ' : '') . $days . ' ' . ($days==1 ? 'day':'days');
            } elseif (abs($hours) > 0) {
                // hours and minutes
                $relativeDate .= ($relativeDate ? ', ' : '') . $hours . ' ' . ($hours==1 ? 'hour':'hours');
            } elseif (abs($minutes) > 0) {
                // minutes only
                $relativeDate .= ($relativeDate ? ', ' : '') . $minutes . ' ' . ($minutes==1 ? 'minute':'minutes');
            } else {
                // seconds only
                $relativeDate .= ($relativeDate ? ', ' : '') . $seconds . ' ' . ($seconds==1 ? 'second':'seconds');
            }

            if (!$backwards) {
                $relativeDate = sprintf('%s ago', $relativeDate);
            }
        }
        return $relativeDate;
    }
}