<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Librarie</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<style>
	.parent {
		display: flex;
		flex-wrap: wrap;
	}
	.child {
		flex: 1 0 21%; /* explanation below */
		margin: 5px;
	}
	
	#material-item{
		margin-left: 40px;
	}
	
	#cover{
		width: 130px;
		height: auto;
		box-shadow: 0px 0px 6px 1px #9b9b9b;
		margin-bottom: 10px;
	}
input[type=button], input[type=submit], input[type=reset]  {
  background-color: #007bfe;
  border: none;
  color: white;
  padding: 10px 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  text-transform: uppercase;
  font-size: 13px;
  -webkit-box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
  box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
  -webkit-border-radius: 5px 5px 5px 5px;
  border-radius: 5px 5px 5px 5px;
  margin: 5px 10px 10px 0px;
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -ms-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}

input[type=button]:hover, input[type=submit]:hover, input[type=reset]:hover  {
  background-color: #39ace7;
}

input[type=button]:active, input[type=submit]:active, input[type=reset]:active  {
  -moz-transform: scale(0.95);
  -webkit-transform: scale(0.95);
  -o-transform: scale(0.95);
  -ms-transform: scale(0.95);
  transform: scale(0.95);
}
	</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light " >

  <div class="collapse navbar-collapse" id="navbarSupportedContent" >
    <ul class="navbar-nav mr-auto" >
      <li class="nav-item active">
        <a class="navbar-brand text-primary" href="<?php echo site_url('books/get_all_books')?>">Acasa</a>
      </li>
	  <li class="nav-item active">
        <a class="navbar-brand text-primary" href="<?php echo site_url('books/get_user_active_loans')?>">Imprumuturi active</a>
      </li>
	  <li class="nav-item active">
        <a class="navbar-brand text-primary" href="<?php echo site_url('books/get_user_history_loans')?>">Istoric imprumuturi</a>
      </li>
	  <li class="nav-item active">
        <a class="navbar-brand text-primary" href="#">Editare cont</a>
      </li>
	  <li class="nav-item active">
        <a class="navbar-brand text-danger" href="<?php echo site_url('welcome/logout')?>">Deconectare</a>
      </li>
	</ul>
   </div>
      
   
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Cauta" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Cauta</button>
    </form>
  </div>
</nav>

<h1 align="center" style="margin-top: 30px; color: #0000FF; #">Welcome, <?php echo $this->session->userdata('email');?>!</h1>