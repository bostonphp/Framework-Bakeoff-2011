<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

// https://github.com/MaherSaif/codeigniter-twig

class Twig
{
	private $CI;
	private $_twig;
	private $_template_dir;
	private $_cache_dir;

	/**
	 * Constructor
	 *
	 */
	function __construct($debug = false)
	{
	    $this->CI =& get_instance();
	    $this->CI->config->load('twig');

            require_once FCPATH . APPPATH . "third_party/Twig/lib/Twig/Autoloader.php";

            log_message('debug', "Twig Autoloader Loaded");

            Twig_Autoloader::register();

            $this->_template_dir = $this->CI->config->item('template_dir');
            $this->_cache_dir = $this->CI->config->item('cache_dir');

            $loader = new Twig_Loader_Filesystem($this->_template_dir);

            $this->_twig = new Twig_Environment($loader, array(
                'cache' => $this->_cache_dir,
                'debug' => $debug,
            ));

            $this->defineFunctions();
	}

	public function render($template, $data = array()) {

            $template = $this->_twig->loadTemplate($template);

            return $template->render($data);
	}

        public function display($template, $data = array()) {

            $template = $this->_twig->loadTemplate($template);

            $template->display($data);
	}

	private function defineFunctions() {
	    $this->CI->load->helper('url');
	    $this->_twig->addFunction('anchor', new Twig_Function_Function('anchor'));
	    $this->_twig->addFunction('site_url', new Twig_Function_Function('site_url'));
	    $this->_twig->addFunction('base_url', new Twig_Function_Function('base_url'));
	    $this->_twig->addFunction('index_page', new Twig_Function_Function('index_page'));
	    $this->_twig->addFunction('uri_string', new Twig_Function_Function('uri_string'));
		$this->_twig->addFunction('mailto', new Twig_Function_Function('safe_mailto'));
	}
}

?>
