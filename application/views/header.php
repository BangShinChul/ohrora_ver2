<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
	<head>
    	<meta charset="utf-8"/>
    	<meta name="apple-mobile-web-app-capable" content="yes" />
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<!--<link rel="stylesheet" href="/static/css/main.css" type="text/css" media="all">-->
    	<link rel="stylesheet" href="/static/css/bootstrap/bootstrap.css" type="text/css" media="all">
    	<link rel="stylesheet" href="/static/css/bootstrap/bootstrap.min.css" type="text/css" media="all">
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
    	<style type="text/css">
			::selection { background-color: #E13300; color: white; }
			::-moz-selection { background-color: #E13300; color: white; }

			body {
				background-color: #fff;
				margin: 40px;
				font: 13px/20px normal Helvetica, Arial, sans-serif;
				color: #4F5155;
			}

			a {
				color: #003399;
				background-color: transparent;
				font-weight: normal;
			}

			h1 {
				color: #444;
				background-color: transparent;
				border-bottom: 1px solid #D0D0D0;
				font-size: 19px;
				font-weight: normal;
				margin: 0 0 14px 0;
				padding: 14px 15px 10px 15px;
			}

			code {
				font-family: Consolas, Monaco, Courier New, Courier, monospace;
				font-size: 12px;
				background-color: #f9f9f9;
				border: 1px solid #D0D0D0;
				color: #002166;
				display: block;
				margin: 14px 0 14px 0;
				padding: 12px 10px 12px 10px;
			}

			#body {
				margin: 0 15px 0 15px;
			}

			p.footer {
				text-align: right;
				font-size: 11px;
				border-top: 1px solid #D0D0D0;
				line-height: 32px;
				padding: 0 10px 0 10px;
				margin: 20px 0 0 0;
			}

			#container {
				margin-top: 5%;
				margin: 10px;
				border: 1px solid #D0D0D0;
				box-shadow: 0 0 8px #D0D0D0;
			}

			#footer {
				text-align: left;
				font-size: 11px;
				border-top: 1px solid #D0D0D0;
				line-height: 32px;
				padding: 0 10px 0 10px;
				margin: 20px 0 0 0;
			}
		</style>
		<style>
			.top-menu ul {
			    list-style:none;
			    margin:0;
			    padding:0;
			}

			.top-menu ul > li {
				display: inline-block;
			    margin: 0 0 0 0;
			    padding: 0 0 5 5;
			    border : 1px solid lightgray;
			    float: left;
			}

		</style>
		<header>
			<div class="top-menu">
				<ul>
					<li>
						<a href="/index.php/main/">Home</a>
					</li>
					
					<?php 
						if(@$this->session->userdata('logged_in') == TRUE) :
					?>
					<li>
						<a href="/index.php/auth/get_logout" class="do_logout">Logout</a>
					</li>
					<?php 
						else : 
					?>
					<li>
						<a href="/index.php/auth/" class="do_login">Login</a>
					</li>
					<?php endif; ?>
					
					<li>
						<a href="/index.php/todo/">TODO</a>
					</li>
					<li>
						<a href="/index.php/board/">게시판</a>
					</li>
					<li>
						<a href="#">Menu 4</a>
					</li>
				</ul>
			</div>
		</header>
		<br>
