<?phpdefined('BASEPATH') OR exit('No direct script access allowed');class Newsletter extends CI_Controller {    function __construct() {        parent::__construct();        $this->load->model('Newsletter_model', 'newsletter');    }    public function index() {        $data['Module'] = "Newsletters";        $data['newsletterData'] = $this->newsletter->getData();        $this->load->view('templates/header', $data);        $this->load->view('newsletter/view', $data);        $this->load->view('templates/footer', $data);    }		public function view($id){	$data['Module'] = "Newsletter Information";        $data['newsletterData'] = $this->newsletter->getData_byId($id);		        $this->load->view('templates/header', $data);        $this->load->view('newsletter/viewinfo', $data);        $this->load->view('templates/footer', $data);	}	}?>