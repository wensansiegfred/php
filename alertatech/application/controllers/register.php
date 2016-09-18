<?php
/**
 * Register controller register.php
 * Lets user sign-up/register. This should also have the capability to send confirmation/activation email.
 */

class Register extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
    function index()
    {
        $this->load->helper(array('form', 'url','date'));
		$this->load->library(array('form_validation','encrypt','session'));
        $fields_rules = array(
            array(
                'field'=>'email',
                'label'=>'Email Address',
                'rules'=>'required|valid_email|matches[emailconf]|xss_clean|callback_email_check'
            ),
            array(
                'field'=>'emailconf',
                'label'=>'Confirm Email Address',
                'rules'=>'required|valid_email|xss_clean'
            ),
            array(
                'field'=>'password',
                'label'=>'Password',
                'rules'=>'required|matches[passconf]|min_length[5]|xss_clean'
            ),
            array(
                'field'=>'passconf',
                'label'=>'Confirm Password',
                'rules'=>'required|xss_clean'
            ),
            array(
                'field'=>'company',
                'label'=>'Company Name',
                'rules'=>'required|xss_clean'
            ),
            array(
                'field'=>'address',
                'label'=>'Address',
                'rules'=>'xss_clean'
            ),
            array(
                'field'=>'city',
                'label'=>'City',
                'rules'=>'xss_clean'
            ),
            array(
                'field'=>'state',
                'label'=>'State',
                'rules'=>'xss_clean'
            ),
            array(
                'field'=>'country',
                'label'=>'Country',
                'rules'=>'xss_clean'
            ),
            array(
                'field'=>'agree',
                'label'=>'I agree to the Alert A Tech Terms of Service',
                'rules'=>'callback_agree_check'
            )
        );

        $data['page'] = 'register_view';
		$data['menu'] = array('home','about','support','clients','contact','setup');

        $this->form_validation->set_rules($fields_rules);
        $this->form_validation->set_rules('email', 'Email Address', 'required|callback_email_check');
        $this->form_validation->set_error_delimiters('<em>','</em>');

        if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('home',$data);
		}
		else
		{
            $canregister = true;
           //TODO: save to database after successful validation
            if ($this->input->post('agree')===FALSE)
            {
                $this->form_validation->set_message('register','You must accept to the Terms and Agreement.');
                $this->session->set_flashdata('message', 'You must accept to the Terms and Agreement.');
                $canregister = false;
            }
            $email = $this->input->post('email');
            $result = $this->db->get_where('user', array('email_address' => $email));
            if ($result->num_rows > 0)
            {
                $this->session->set_flashdata('message', 'Email address is already in use.');
                $canregister = false;
            }
            if ($canregister==TRUE)
            {
                $session_id = $this->session->userdata('session_id');
                $ip_address = $this->session->userdata('ip_address');
                $user_agent = $this->session->userdata('user_agent');
                $last_activity = $this->session->userdata('last_activity');
                $date= new DateTime('now');
                $expired_date = date_add($date, new DateInterval('P7D'));
                $user_data = array(
                    'email_address' => $email,
                    'password' => $this->encrypt->sha1($this->input->post('password')),
                    'activation_code' => 0,
                    'activation_expire_date' => $expired_date->format("Y/m/d m:i:s"),
                    'activated' => '1',
                    'register_date' => $date->format("Y/m/d m:i:s"),
                    'last_login' => $date->format("Y/m/d m:i:s"),
                    'ip_address' => $ip_address,
                    'lastlogin_ip' => $ip_address,
                    'blocked_to' => $date->format("Y/m/d m:i:s"),
                    'session_id' => $session_id
                );
                $this->db->insert('user', $user_data);
                $this->session->set_userdata('user_token',$email);
            }
            else
                $this->load->view('home',$data);
            //redirect(base_url());
		}
        
        //TODO: check on callback why it is not working.
        function agree_check($agree)
        {
            if ($agree==FALSE)
            {
                $this->form_validation->set_message('agree_check','You must accept to the Terms and Agreement.');
                return false;
            }
            else
            {
                return true;
            }
        }

        //TODO: check on callback why it is not working.
        function check_email(string $str)
        {
            //TODO: create database checking if email is already used
            if ($str=="email@email.com" || $str=="ryanpanares@yahoo.com")
            {
                $this->form_validation->set_message('email_check','Email address %s is already in use.');
                return false;
            }
            else
            {
                return true;
            }
        }

        function register_customer()
        {
            //TODO: save to database and allow user to use the service. create a new session like logged in.
            redirect(base_url());
        }
    }
}
/* End of file register.php */
/* Location: ./application/controllers/register.php */