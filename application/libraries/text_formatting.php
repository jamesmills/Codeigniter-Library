<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Text formatting library
 *
 * Basic formatting of certain things that you will want to do over and over again.
 * Main use is for returning a MySQL date as 'Today ' or 'Just now!' with optional time
 * @author James Millr <james@jamesmills.co.uk>
 * @version 1.0
 * @package JGMCore
 */

class Text_formatting {

	function __construct()
	{

	}

    /**
     * Format the date to look nice and add Today or yesterday to the output!
     * @results string $myOutputDate this is actually what is returned
     * @param string $my_date the date in original format
     * @param integer $time bool to set if to return the time in brackets with nice date
     * @param string $my_format format to return the date in if different from default
     * @return string
     */
	function date_special($my_date, $time = 0, $my_format = 'l jS F Y')
	{
	
		if ($my_date == "0000-00-00 00:00:00" || $my_date == "")
		{
			$myOutputDate = 'empty';
		}
		else
		{
			$yesterday = 			mktime(0,0,0,date("m"),date("d")-1,date("Y"));			// Time stamp for yesterday
			$today = 				mktime(0,0,0,date("m"),date("d"),date("Y"));			// Time stamp for today
			
			//tomorrow can also be -> strtotime("+1 day")
			$tomorrow = 			mktime(0,0,0,date("m"),date("d")+1,date("Y"));			// Time stamp for tomorrow
			$tomorrow_plus_one = 	mktime(0,0,0,date("m"),date("d")+2,date("Y"));			// Time stamp for tomorrow
			$my_date = 				strtotime($my_date);										// Convert the given time into a unix time stamp
			
			
			if($my_date >= $today && $my_date < $tomorrow)
			{
				if($my_date > (time() - (60*5)))
				{
					$myOutputDate = '<span class="nice_justnow">Just now!';
                    if($time === 1)
                    {
                        $myOutputDate .= '(' . date("g:ia", $my_date) . ')';
                    }
                    $myOutputDate .= ' </span>';
				}
				else
				{
					if (date("h:i:s", $my_date) == "12:00:00")
					{
						$myOutputDate = '<span class="nice_today">Today</span>';
					}
					else
					{
						$myOutputDate = '<span class="nice_today">Today';
                        if($time === 1)
                        {
                            $myOutputDate .= ' (' . date("g:ia", $my_date) . ')';
                        }
                        $myOutputDate .= '</span>';
					}
				}
			}
			else if($my_date >= $yesterday && $my_date < $today)
			{
				if (date("h:i:s", $my_date) == "12:00:00")
				{

					$myOutputDate = '<span class="nice_yesterday">Yesterday</span>';
				}
				else
				{
                    $myOutputDate = '<span class="nice_yesterday">Yesterday';
                    if($time === 1)
                    {
                        $myOutputDate .= ' (' . date("g:ia", $my_date) . ')';
                    }
                    $myOutputDate .= '</span>';

				}
				
			}
			else if($my_date > $today && $my_date < $tomorrow_plus_one )
			{
				$myOutputDate = '<span class="nice_tomorrow">Tomorrow';
                if($time === 1)
                {
                    $myOutputDate .= ' (' . date("g:ia", $my_date) . ')';
                }
                $myOutputDate .= '</span>';
			}
			else
			{
				$myOutputDate = date($my_format, $my_date);
			}
		}
	
	
		return $myOutputDate;
	}

}