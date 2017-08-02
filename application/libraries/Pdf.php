<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';
 ini_set('memory_limit', -1);
 ini_set('max_execution_time',0);
 header("Content-Type: application/pdf");
 header("Content-Disposition: attachment; filename='filename.pdf'");
class Pdf extends TCPDF
{
    function __construct()
    {
        parent::__construct();
    }
    var $xheadertext  = '<table>
    						<tr>
        						<td rowspan="5"><img width="80" src="http://demosipl.com/upzurge/assets/images/logo.png"/></td>
       						</tr>
   						</table>';

    var $xheadercolor = array(255,255,255);
    var $xheaderfontsize = 15;
    var $xfootertext  = '<table>
							<tr>
								<td></td>
							</tr>
							<tr>
								<td style="font-size: 12px;">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Upzurge | Sassy Infotech
								</td>
							</tr>
						</table>';

    var $xfooterfont  = PDF_FONT_NAME_MAIN ;
    var $xfooterfontsize = 10 ;

    function Footer()
    {
        $year = date('Y');
        $footertext = sprintf($this->xfootertext, $year);
        $this->SetY(-10);

        $this->SetTextColor(128, 128, 128);
        $this->SetFont($this->xfooterfont,'',$this->xfooterfontsize);
       	$this->Cell(0,3, '','',1,'C');
        $this->WriteHTML($footertext);
		$this->Ln();
    }

    function Header()
    {
		list($r, $b, $g) = $this->xheadercolor;
        $this->setY(0); // shouldn't be needed due to page margin, but helas, otherwise it's at the page top
        //$img_file = ASSETS_URL.'images/main/bk_ground.png';

        //$this->Image($img_file, 0, 80, 410, 297, '', '', '', false, 600, '', false, false, 0);
        $this->SetFillColor($r, $b, $g);
        $this->SetTextColor(0 , 0, 0);
        $this->Cell(0,5, '', 0,1,'C', 1);
        $this->WriteHTML($this->xheadertext );
		$this->Ln();
    }
}

/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */