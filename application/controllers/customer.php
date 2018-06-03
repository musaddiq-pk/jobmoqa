<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class customer extends CI_Controller 
{
	var $table_data = array();

	public function customer()
	{
		parent::__construct();
		$this->table_data = $this->config->item('table_data');
		$this->table_data['table'] = 'customer';
	}
	
	public function index()
	{
		//
	}
	
	function subscribe()
	{	
		//echo '<pre>';print_r($_SERVER);exit;
		$refferer_url = $_SERVER['HTTP_REFERER'];
		$this->form_validation->set_error_delimiters('<p class="error error_msg">', '</p>');
				
		if($this->form_validation->run('subscribe') == FALSE)
		{
			//$this->session->set_flashdata('subscription_msg', 'true');
			$this->session->set_flashdata('subscription_error', form_error('email'));
			
			redirect($refferer_url);
		}
		else
		{
			$email_id = $_POST['email'];
			$data = array('email'=>$email_id,'c_date'=>date('Y-m-d'));
			$id = $this->general_model->add('customer',$data);
			
			if($id > 0)
			{
				$html = $this->load->view('front/subscription_email',$data,true);
			
				$this->load->library('email_lib');
				$email['from'] = 'cs@jobmoqa.pk';
				$email['to'] = $email_id;
				//$email['cc'] = SALE_EMAIL;
				$email['subject'] = 'You are subscribed successfylly.';
				$email['message'] = $html;
				//echo $email['message'];
				$sent_to_admin = $this->email_lib->send_mail($email);	
			}
			//$this->session->set_flashdata('subscription_msg', 'true');
			//$this->session->set_flashdata('subscription_success', 'Subscribed successufully');
			
			redirect(BASE_URL.'thank-you');
		}
	}
	
	function thank_you()
	{
		$data['meta_desc'] = 'Thak you for subscription';
		$data['title'] = 'Thak you | '.SITE_NAME;
		
		$data['menu'] = $this->menu;
		$this->template->load(FRONT_TEMPLATE_URL.'template_home', 'front/thank_you',$data);
	}
	
	function news_letter()
	{
		$this->load->model('ad_model');
				
		$cust_data = $this->table_data;
		$cust_data['select'] = array('email');
		$cust_data['where'] = array('is_subscribed'=>1,'status'=>1);
		$customers = $this->general_model->get_records($cust_data);	
		
		
		$job_data = $this->table_data;
		$job_data['table'] = 'ad';
		//$job_data['select'] = array('name,url,image');
		$job_data['where'] = array('ad.status'=>1,'is_featured'=>1,'ad_category.cat_id'=>6,'ad_date'=>'2017-12-27');
		$data['jobs'] = $this->ad_model->get_ad($job_data);
		//echo '<pre>';print_r($data['jobs']);echo '</pre>';exit;
		$news_letter = $this->load->view('front/news_letter',$data,true);
				
		$this->load->library('email_lib');		
		foreach($customers as $cust)
		{	
			$email['from'] = 'cs@jobmoqa.pk';
			$email['to'] = $cust['email'];
			//$email['cc'] = SALE_EMAIL;
			$email['subject'] = 'Daily NewsLetter (JobMoqa)';
			$email['message'] = $news_letter;
			
			$email_status = $this->email_lib->send_mail($email);
		}
	}
}
