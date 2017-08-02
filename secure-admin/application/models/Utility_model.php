<?phpclass Utility_model extends CI_Model {	public function __construct()	{		$this->load->database();	}		public function getConfigData()	{		$query = $this->db->get('config');		$result = $query->result_array();		$configData = array();				foreach ($result as $key=>$value)		{			$configData[$value['config_key']] = $value['config_value']; 		}		return $configData;	}		public function getcountryData()	{		$this->db->order_by('iso2_code', 'ASC');//		$query = $this->db->get('directory_country');		$query = $this->db->get('countries');		return $query->result_array();	}		public function getStateByCountry($country_code)	{		$this->db->order_by('region_id', 'ASC');		$this->db->where('country_id',$country_code);  		$query = $this->db->get('directory_country_region');		return $query->result_array();	}		public function getStateName($region_id)	{		$this->db->where('region_id',$region_id);  		$query = $this->db->get('directory_country_region');		return $query->row_array();	}}