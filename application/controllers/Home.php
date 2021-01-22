<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
    public $result = 0;

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
    	$this->session->sess_destroy();
        $this->load->view('header');
        $this->load->view('home');
        $this->load->view('footer');
    }

    public function process()
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[guestlists.email]');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|is_unique[guestlists.phone]');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone')
            );
            $insert = $this->db->insert('guestlists', $data);
            if ($insert) {
            	$guestuser = array(
                	'guestname' => $this->input->post('name'),  
                	'guestemail' => $this->input->post('email')
                );    
            	$this->session->set_userdata($guestuser); 

                redirect('home/exam');
            }
        }
    }

    public function exam()
    {
        $content = file_get_contents("https://opentdb.com/api.php?amount=10");
		$result  = json_decode($content);
		$data['results'] = $result->results;

        $this->load->view('header');
        if ($this->session->userdata('guestname'))   
        {  
	       $this->load->view('exam', $data);
        } else {  
           redirect(base_url());
       	}
        $this->load->view('footer');
    }

    public function result()
    {
    	if($this->input->post('answer1')){
    		if($this->input->post('answer1') == $this->input->post('canswer1')){
    			$this->result += 1;
    		} else {
    			$this->result += 0;
    		}
    	} else {
    		$this->result += 0;
    	}

    	if($this->input->post('answer2')){
    		if($this->input->post('answer2') == $this->input->post('canswer2')){
    			$this->result += 1;
    		} else {
    			$this->result += 0;
    		}
    	} else {
    		$this->result += 0;
    	}

    	if($this->input->post('answer3')){
    		if($this->input->post('answer3') == $this->input->post('canswer3')){
    			$this->result += 1;
    		} else {
    			$this->result += 0;
    		}
    	} else {
    		$this->result += 0;
    	}

    	if($this->input->post('answer4')){
    		if($this->input->post('answer4') == $this->input->post('canswer4')){
    			$this->result += 1;
    		} else {
    			$this->result += 0;
    		}
    	} else {
    		$this->result += 0;
    	}

    	if($this->input->post('answer5')){
    		if($this->input->post('answer5') == $this->input->post('canswer5')){
    			$this->result += 1;
    		} else {
    			$this->result += 0;
    		}
    	} else {
    		$this->result += 0;
    	}

    	if($this->input->post('answer6')){
    		if($this->input->post('answer6') == $this->input->post('canswer6')){
    			$this->result += 1;
    		} else {
    			$this->result += 0;
    		}
    	} else {
    		$this->result += 0;
    	}

    	if($this->input->post('answer7')){
    		if($this->input->post('answer7') == $this->input->post('canswer7')){
    			$this->result += 1;
    		} else {
    			$this->result += 0;
    		}
    	} else {
    		$this->result += 0;
    	}

    	if($this->input->post('answer8')){
    		if($this->input->post('answer8') == $this->input->post('canswer8')){
    			$this->result += 1;
    		} else {
    			$this->result += 0;
    		}
    	} else {
    		$this->result += 0;
    	}

    	if($this->input->post('answer9')){
    		if($this->input->post('answer9') == $this->input->post('canswer9')){
    			$this->result += 1;
    		} else {
    			$this->result += 0;
    		}
    	} else {
    		$this->result += 0;
    	}

    	if($this->input->post('answer10')){
    		if($this->input->post('answer10') == $this->input->post('canswer10')){
    			$this->result += 1;
    		} else {
    			$this->result += 0;
    		}
    	} else {
    		$this->result += 0;
    	}

        $data['result'] = $score = $this->result;

        $this->load->view('header');
        if ($this->session->userdata('guestname'))   
        {  
        	$guestdata = array( 
		        'score'  =>  $score
		    );
			$this->db->where(array('name'=>$this->session->userdata('guestname'), 'email'=>$this->session->userdata('guestemail')));
			$this->db->update('guestlists', $guestdata);
	       	$this->load->view('result', $data);
        } else {  
           redirect(base_url());
       	}
        $this->load->view('footer');

    }

    public function admin()
    {
    	$this->load->view('header');
    	if ($this->session->userdata('currently_logged_in'))   
        {  
	        redirect(base_url('adminview'));
        } else {  
            $this->load->view('admin');
        }
        $this->load->view('footer');
    }

    public function adminlogin()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|callback_validation');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                	'currently_logged_in' => 1  
                );    
            $this->session->set_userdata($data);  
           	echo json_encode(array('flag'=>1, 'redirect'=>base_url('adminview')));
        } else {
            echo json_encode(array('flag'=>0, 'redirect'=>base_url('admin')));
        }
    }

    public function adminview()
    {
    	if ($this->session->userdata('currently_logged_in'))   
        { 
	        $data['results'] = $this->db->get('guestlists')->result_array();

            $this->load->view('header');
	        $this->load->view('guestlist',$data);
	        $this->load->view('footer');
        } else {  
            redirect(base_url('admin'));
        }  
    }

    public function adminlogout()
    {
    	$this->session->sess_destroy();
        redirect(base_url('admin'));
    }

    public function validation()  
    {  
        if ($this->log_in_correctly())  
        {  
            return true;  
        } else {
            $this->form_validation->set_message('validation', 'Incorrect username/password.');  
            return false;  
        }  
    }

    public function log_in_correctly()
    {
        $this->db->where('username', $this->input->post('username'));  
        $this->db->where('password', $this->input->post('password'));  
        $query = $this->db->get('adminuser');  
  
        if ($query->num_rows() == 1){  
            return true;  
        } else {
            return false;  
        }  
  
    }
}
