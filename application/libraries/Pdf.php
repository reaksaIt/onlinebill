<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**


* CodeIgniter PDF Library
 *
 * Generate PDF's in your CodeIgniter applications.
 *
 * @package         CodeIgniter
 * @subpackage      Libraries
 * @category        Libraries
 * @author          Chris Harvey
 * @license         MIT License
 * @link            https://github.com/chrisnharvey/CodeIgniter-  PDF-Generator-Library



*/

require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;
class Pdf extends DOMPDF
{
/**
 * Get an instance of CodeIgniter
 *
 * @access  protected
 * @return  void
 */
protected function ci()
{
    return get_instance();
}

/**
 * Load a CodeIgniter view into domPDF
 *
 * @access  public
 * @param   string  $view The view to load
 * @param   array   $data The view data
 * @return  void
 */
public function load_view($view, $data = array())
{
    $options = new Options();
    $options->set('isRemoteEnabled',TRUE); // temp folder with write permission

    $dompdf = new Dompdf($options);
   // $dompdf->setOptions($options);
    $html = $this->ci()->load->view($view, $data, TRUE);

    $dompdf->loadHtml($html);

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();
    $time = time();

    // Output the generated PDF to Browser
    $dompdf->set_option('isHtml5ParserEnabled', true); 
    //at runtime? It uses CSS2.1 stuff like margin: 4em 1em 4em 1em;
    $dompdf->stream("welcome-". $time,array('Attachment'=>false));


    // $options = new Options();
    //     $options->set('isRemoteEnabled',TRUE);
    //     $dompdf = new Dompdf($options);
    //     $html = $this->ci->load->view($view,$data,TRUE);
    //     $canvas = $dompdf->get_canvas();
    //     $dompdf->loadHtml($html);
    //     $dompdf->setPaper($paper,$orientation);
    //     $dompdf->render();
    //     $dompdf->stream($filename.".pdf",array("Attachment"=>FALSE));
}
}
