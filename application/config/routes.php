<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

/*echo 'here in rout';
echo $fburl= 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
exit;*/
$route['default_controller'] = "ad";

$route['admin'] = 'admin/login';
$route['^admin/(:any)/(:any)'] = "admin/$1/$2";
$route['^admin/(:any)'] = "admin/$1";

//Cron Job
$route['cron_job/site_map'] = 'cron_job/site_map';
//Test
$route['test'] = 'ad/test';

//Customer
$route['subscribe'] = 'customer/subscribe';
$route['thank-you'] = 'customer/thank_you';
$route['news-letter'] = 'customer/news_letter';
//Pages
$route['search'] = 'ad/search';
$route['search'] = 'ad/search/$1';
$route['regions'] = 'ad/regions';

$route['region/(:any)'] = 'ad/region/$1';
$route['about-us'] = 'page/view/about-us';
$route['interview-tips'] = 'page/view/interview-tips';
$route['cv-formats'] = 'page/view/cv-formats';

//Docs
$route['docs'] = 'docs';
$route['docs/(:any)'] = 'docs/documents';
$route['docs/(:any)/(:num)'] = 'docs/documents/$1/$2';

//Categories
//$route['industry/(:any)'] = 'ad/category/$1';
$route['industry/(:any)'] = 'ad/category/$1';
$route['industry/(:any)/(:num)'] = 'ad/category/$1/$2';

//News Paper
$route['epaper/(:any)'] = 'ad/news_paper/$1';
$route['epaper/(:any)/(:num)'] = 'ad/news_paper/$1/$2';

$route['all-news-papers'] = 'ad/all_news_papers';
$route['all-news-papers/(:num)'] = 'ad/all_news_papers/$1';

$route['industries'] = 'ad/categories';
$route['industries/(:num)'] = 'ad/categories/$1';

//Helper function
$route['ad/set_paper_date'] = 'ad/set_paper_date';
$route['ad/set_session_var'] = 'ad/set_session_var';

//Ad
$route['(:any)'] = 'ad/detail/$1';
$route['404_override'] = 'ad/show_404';
/* End of file routes.php */
/* Location: ./application/config/routes.php */

