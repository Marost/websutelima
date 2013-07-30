<?php

/**
 * PHP Pagination Class
 * @author Imad Jomaa <http://codecanyon.net/user/ImadJomaa>
 * @copyright Copyright 2012 Imad Jomaa, All Rights Reserved
 * @license Envato Item Licenses
 * @version 1.1
 * class_pagination.php
 */

define("PAGINATION_PATH", dirname(__FILE__));

Class Pagination {

    /******
     * Stores the number of results to return per page
     * @var int $limit number of results per page
     */

    public $limit;

    /******
     * Number of results queried
     * @var int $rows Number of results returned from query
     */

    public $rows;

    /******
     * Stores current page
     * @var int $current_page The current page one is on
     */

    public $current_page;

    /******
     * The URI path
     * @var string $location The current URI path without page
     */

    public $location;

    /******
     * Stores total num of pages
     * @var int The total num of pages to ever exist
     */

    protected $total;

    /******
     * Stores the type of pagination to display
     * @var int $type 1|2, 1 being standard, 2 being arrow only
     */

    protected $type;

    /******
     * Stores whether to display jumpto or not
     * @var boolean $jumpto
     */

    protected $jumpTo;

    /******
     * Construct
     * @param int $limit Limit of number of results per page
     * @param int $rows Number of results returned by query
     * @param int $current_page Current page number
     * @param string $location URI
     * @return null
     */

    public function __construct($limit, $rows, $current_page, $location, $type=1, $jumpto=0)
    {
        $this->limit        = intval($limit);
        $this->rows         = intval($rows);
        $this->current_page = intval($current_page);
        $this->location     = strip_tags($location).'=';
	  $this->type         = intval($type);
	  $this->jumpTo       = intval($jumpto);

        if($this->limit < 1)
        {
            die("The limit (max results per page) must be greater than zero.");
        }

	  if(!file_exists(PAGINATION_PATH."/pagination_templates.php"))
	  {
		die("Unable to find pagination_templates.php file. Please refer to the manual for more information.");
	  }

	  if($this->type !== 1 && $this->type !== 2)
	  {
		$this->type = 1;
	  }

	  if($this->jumpTo !== 0 && $this->type !== 1)
	  {
		$this->jumpTo = 0;
	  }

        $this->total = (int)ceil($this->rows/$this->limit);

        //clear the air with the current page
        if(($this->current_page < 1) || $this->current_page > $this->total)
        {
            $this->current_page = 1;
        }

    }

    /******
     * Calculates the results starting point for the query
     * @return int $start
     */

    public function prePagination()
    {
        $start = ($this->current_page - 1) * $this->limit;

        return $start;
    }

    /******
     * Generates pagination code
     * @return string $display
     */

    public function pagination()
    {
	  //stores display output
	  $display = $this->_include("pagination_header");

        if($this->total > 1 && $this->type === 1)
        {
            //determine whether previous is displayed
            if($this->current_page !== 1)
            {
                $display .= $this->_include("previous");
            }

            //display all pages
            if($this->total > 1 && $this->total < 7)
            {
                for($i=1; $i <= $this->total; $i++)
                {
                    if($this->current_page === $i)
                    {
                        $display .= $this->_include("selected", $i);
                    }

                    else
                    {
                        $display .= $this->_include("unselected", $i);
                    }
                }
            }

            //split (hidden) view
            elseif($this->total >= 7)
            {
		    $least = $this->current_page - 3;
		    $great = $this->current_page + 3;

		    //when 5'fth page selected, only three dots
		    $nomore = false;

		    if($least < 1)
		    {
			  $least = 1;
		    }

		    if($great > $this->total)
		    {
			  $great = $this->total;
		    }

                for($i = $least; $i <= $great; $i++)
                {

			  if($this->current_page >= 5)
			  {
				if($i === $least)
				{
				    $display .= $this->_include("unselected", 1).'...';
				}

				if($this->current_page === 5 && $nomore === false)
				{
				    $display = substr($display, 0, -3);
				    $nomore   = true;
				}
			  }

                    if($this->current_page === $i)
                    {
                        $display .= $this->_include("selected", $i);
                    }

                    else
                    {
                        $display .= $this->_include("unselected", $i);
                    }

			  if($this->current_page <= ($this->total - 4))
			  {
				if($i === $great)
				{
				    $display .= '...'.$this->_include("unselected", $this->total);
				}
			  }
		    }
		}

            //see whether to display next or not
            if($this->current_page !== $this->total)
            {
                $display .= $this->_include("next");
            }
        }

	  //just display arrow based pagination
        elseif($this->total > 1 && $this->type === 2)
	  {
		if($this->current_page === 1)
		{
		    $display .= $this->_include("left_arrow_disabled");
		}

		else
		{
		    $display .= $this->_include("left_arrow");
		}

		if($this->current_page === $this->total)
		{
		    $display .= $this->_include("right_arrow_disabled");
		}

		else
		{
		    $display .= $this->_include("right_arrow");
		}
	  }

	  //determine if we need to display the jumpto menu
	  if($this->jumpTo === 1)
	  {
		$display .= $this->_include("jumpto_header");

		for($i=1; $i <= $this->total; $i++)
		{
		    $display .= $this->_include("jumpto_body", $i);
		}

		$display .= $this->_include("jumpto_footer");
	  }

	  $display .= $this->_include("pagination_footer");

        echo $display;
    }

    /******
     * Retreives and compiles templates
     * @param string $template name of template to retreive
     * @param int $page Page number provided, otherwise uses current page
     * @return string $match[1]
     */

    private function _include($template, $page=false)
    {
	  $cachedTemplates = array ();

        if($page === false)
        {
            $page = $this->current_page;
        }

        else
        {
		$page = intval($page);
        }

	  $search = array (
				  "[location]",
				  "[current_page]",
				  "[nth_page]",
				  "[previous_page]",
				  "[next_page]"
				);

	  $replacement = array (
					  $this->location,
					  $this->current_page,
					  $page,
					  $this->current_page - 1,
					  $this->current_page + 1
					);

	  if(array_key_exists($template, $cachedTemplates))
	  {
		//we have the template, compile it
		$result = str_ireplace($search, $replacement, $cachedTemplates[$template]);

		return $result;
	  }

        elseif(($template_file = file_get_contents(PAGINATION_PATH."/pagination_templates.php")))
	  {
		//retreive the template we need
		preg_match("/\<\!--$template--\>(.*?)\<\!--$template end--\>/is", $template_file, $match);

		if(isset($match[1]))
		{
		    //cache it for later use
		    $cachedTemplates[$template] = $match[1];

		    $result = str_ireplace($search, $replacement, $match[1]);

		    unset($match, $template_file);
		    return $result;
		}

		else
		{
		    echo "Warning: PHP Pagination template $template not found!";
		}
	  }
    }
}

?>
