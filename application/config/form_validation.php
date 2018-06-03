<?php
$config = array(
				
				'login' => array(
							array('field' => 'login_email','label' => 'User E-mail','rules' => 'required|valid_email|xss_clean|trim'),
							array('field' => 'login_pass','label' => 'Password','rules' => 'required|xss_clean|trim')                                   
							),
				'admin_login' => array(
							array('field' => 'txtUserName','label' => 'User Name','rules' => 'required|xss_clean|trim'),
							array('field' => 'txtPassword','label' => 'Password','rules' => 'required|xss_clean|trim')                                   
							),
				'forgot_password' => array(
							array('field' => 'forgot_email','label' => 'E-mail','rules' => 'required|valid_email|xss_clean|trim'),                            
							),
				'change_pwd' => array(
							array('field' => 'old_pass','label' => 'Old','rules' => 'required|xss_clean|trim'),
							array('field' => 'new_pass','label' => 'New Password','rules' => 'required|matches[re_new_pass]|xss_clean|trim'),
							array('field' => 're_new_pass','label' => 'Re-Password','rules' => 'required|xss_clean|trim'),
							),	
							
				//Custoemr
				'subscribe' => array(
							array('field' => 'email','label' => 'Email','rules' => 'required|valid_email|is_unique[customer,id=>cust_id,email=>email]|xss_clean|trim'),
                              
							),	
				
				//Admin validation...
				'ad' => array(
							array('field' => 'ad_name','label' => 'Name','rules' => 'required|xss_clean|min_length[10]|trim'),
							array('field' => 'required_skills','label' => 'Required Skills','rules' => 'xss_clean|trim'),
							array('field' => 'desc','label' => 'Desc','rules' => 'required|xss_clean|trim'),
							array('field' => 'ad_date','label' => 'Publish Date','rules' => 'required|xss_clean|trim'),
							array('field' => 'last_date','label' => 'Last Date','rules' => 'xss_clean|trim'),
							array('field' => 'hdn_image','label' => 'Image','rules' => 'xss_clean|trim'), //required_select 
							array('field' => 'seo_title','label' => 'SEO Title','rules' => 'required|xss_clean|trim'),
							array('field' => 'seo_desc','label' => 'SEO Meta Desc','rules' => 'required|xss_clean|trim'),                          
							),
				'category' => array(
							array('field' => 'cat_name','label' => 'Name','rules' => 'required|is_unique[category,id=>id,name=>cat_name]|xss_clean|min_length[3]|trim'),
							array('field' => 'desc','label' => 'Desc','rules' => 'required|xss_clean|trim'),
							array('field' => 'seo_title','label' => 'SEO Title','rules' => 'required|xss_clean|trim'),
							array('field' => 'seo_meta_desc','label' => 'SEO Meta Desc','rules' => 'required|xss_clean|trim'),                          
							),
				'newspapaer' => array(
							array('field' => 'paper_name','label' => 'Name','rules' => 'required|is_unique[news_paper,id=>id,name=>paper_name]|xss_clean|min_length[3]|trim'),
							array('field' => 'hdn_image','label' => 'Image','rules' => 'required|xss_clean|trim'),
							array('field' => 'desc','label' => 'Desc','rules' => 'required|xss_clean|trim'),
							array('field' => 'seo_title','label' => 'SEO Title','rules' => 'required|xss_clean|trim'),
							array('field' => 'seo_meta_desc','label' => 'SEO Meta Desc','rules' => 'required|xss_clean|trim'),                          
							),
				'page' => array(
							array('field' => 'page_name','label' => 'Pange Name','rules' => 'required|is_unique[page,id=>id,name=>page_name]|xss_clean|min_length[3]|trim'),
							array('field' => 'desc','label' => 'Desc','rules' => 'required|xss_clean|trim'),
							array('field' => 'seo_title','label' => 'SEO Title','rules' => 'required|xss_clean|trim'),
							array('field' => 'seo_meta_desc','label' => 'SEO Meta Desc','rules' => 'required|xss_clean|trim'),                          
							),
				'document' => array(
							array('field' => 'type','label' => 'Type','rules' => 'required|xss_clean|trim'),
							array('field' => 'doc_title','label' => 'Title','rules' => 'required|xss_clean|trim'),
							array('field' => 'hdn_file','label' => 'File','rules' => 'required|xss_clean|trim'),
							array('field' => 'hdn_image','label' => 'Image','rules' => 'required|xss_clean|trim'),                         
							),
               );
?>