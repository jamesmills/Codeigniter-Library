<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author		James Mills
 * @copyright	Copyright (c) 2008 - 2010, JGM Web Design
 * @link		http://www.jgmwebdesign.co.uk
 * @since		Version 1.0
 */

// ------------------------------------------------------------------------

class Text_formatting {


	function __construct()
	{
	
	}

	// --------------------------------------------------------------------

	/**
	 * Format the date to look nice and add Today or yesterday to the output!
	 *
	 * Will return a string
	 *
	 * @access	public
	 * @return	array
	 */

	public function date_special($my_date, $my_format = 'l jS F Y')
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
					$myOutputDate = '<span class="nice_justnow">Just now! (' . date("g:ia", $my_date) . ')</span>';
				}
				else
				{
					if (date("h:i:s", $my_date) == "12:00:00")
					{
						$myOutputDate = '<span class="nice_today">Today</span>';
					}
					else
					{
						$myOutputDate = '<span class="nice_today">Today (' . date("g:ia", $my_date) . ')</span>';
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
					$myOutputDate = '<span class="nice_yesterday">Yesterday (' . date("g:ia", $my_date) . ')</span>';
				}
				
			}
			else if($my_date > $today && $my_date < $tomorrow_plus_one )
			{
				$myOutputDate = 'Tomorrow ' . date("g:ia", $my_date);
			}
			else
			{
				$myOutputDate = date($my_format, $my_date);
			}
		}
	
	
		return $myOutputDate;
	}
	
	
	





}
// END Text_formatting Class

/* End of file test_formatting.php */
/* Location: ./application/libraries/test_formatting.php */
