<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {

	private static $instance;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		self::$instance =& $this;
		
		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');

		$this->load->initialize();
		
		log_message('debug', "Controller Class Initialized");
	}

	public static function &get_instance()
	{
		return self::$instance;
	}
        
        function cpf_putmask($cpf)
	{
		$cpf1 = substr_replace($cpf,'.',3,0);
		$cpf2 = substr_replace($cpf1,'.',7,0);
		$cpf_with_mask = substr_replace($cpf2,'-',11,0);
		return $cpf_with_mask;
	}
	
	function cpf_removemask($cpf)
	{
		$chrs = array('.','-');
		$cpf_without_mask = str_replace($chrs,'',$cpf);
		return $cpf_without_mask;
	}
        function cnpj_putmask($cnpj)
	{
		$cnpj1 = substr_replace($cnpj,'.',3,0);
		$cnpj2 = substr_replace($cnpj1,'.',7,0);
		$cnpj3 = substr_replace($cnpj2,'/',11,0);		
		$cnpj_with_mask = substr_replace($cnpj3,'-',16,0);
		return $cnpj_with_mask;
	}
	
	function cnpj_removemask($cnpj)
	{
		$chrs = array('.','/','-');
		$cnpj_without_mask = str_replace($chrs,'',$cnpj);
		return $cnpj_without_mask;
	}
        function convertDate($inputdate)
	{ //inputdate format dd/mm/yyyy
		$date=explode('/',$inputdate);
		$dated=$date[2].'-'.$date[1].'-'.$date[0];
		return $dated; //dated format yyy-mm-dd
	}

	function re_convertDate($inputdate)
	{ //inputdate format yyyy-mm-dd
		$date=explode('-',$inputdate);
		$dated=$date[2].'/'.$date[1].'/'.$date[0];
		return $dated; //dated format dd/mm/yyyy
	}
	
        }
// END Controller class

/* End of file Controller.php */
/* Location: ./system/core/Controller.php */