<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

/*
사이트의 루트 url만 요청될때 실행될 기본 컨트롤러를 지정하려면 
application/config/routes.php 파일 안의 변수에 세팅할 수 있다.
이런식으로
$route['default_controller'] = 'Topic';

위의 코드는 default controller를 topic.php로 정하는 코드이다.
*/
# $route의 키값은 규칙을 의미한다.

# url을 main/get_topic/숫자값 대신 topic/숫자값 으로도 표현할 수 있다고 설정하는것
# $route['topic/(:num)'] = 'main/get_topic/$1';

# 위와 똑같은 방식으로 url을 main/get_topic/숫자값 대신 post/숫자값 으로도 표현할 수 있다고 설정하는것
# $route['post/(:num)'] = 'main/get_topic/$1';

$route['default_controller'] = 'Main';
$route['404_override'] = 'errors/notfound';
$route['translate_uri_dashes'] = FALSE;
