<?php

require_once(__ROOT__ . "view/View.php");

class ViewUser extends View{	
	public function output(){
		$str="";
		$str.="<h1>Welcome ".$this->model->getName()."</h1>";
		$str.="<h5>Age: ".$this->model->getAge()."</h5>";
		$str.="<h5>Phone: ".$this->model->getPhone()."</h5>";
		$str.="<br><br>";
		$str.="<a href='profile.php?action=edit'>Edit Profile </a><br><br>";
		$str.="<a href='profile.php?action=movie'>My Movies </a><br><br>";
		$str.="<a href='profile.php?action=signOut'>SignOut </a><br><br>";
		$str.="<a href='profile.php?action=delete'>Delete Account </a>";
		return $str;
	}
	
	function loginForm(){
		$str='<form action="index.php" method="post">
		<div><input type="text" name="UserName" placeholder="Enter name"/></div><br>
		<div><input type="password" name="password" placeholder="Enter password"/></div><br>
		<div><input type="submit" name="login"/></div>
		</form>';
		return $str;
	}
    function login(){
        $str='  <form method="POST" action=" ">
        <!-- Your form content here -->
        <div class="square2">
            <h2 class="h3-title-bold-uppercase">
                SIGN IN
                <p class="sq1-small-writing">
                    Sign in to your account to add
                    or edit your addresses and
                    email preferences, save
                    
                </p>
                <input type="text" name="UserName" placeholder="UserName">
                <input type="password" name="password" placeholder="Password">
            </h2>
            <input class="acc-buttons" type="submit" value="Submit" name="login">
        </div>
    </form>';
    return $str;
    }
    
function signup(){
	$str='<form action="index.php?action=insert" method="post">
                <h2>Create Account</h2>
                <p>Save your shipping information for faster checkout.
                    Opt-in for our email list to receive early access to new products &amp; exclusive offers.</p>
                <div>
                    <input type="text" name="UserName" placeholder="User Name" required="">
                    
                </div>
                <div class="err"><span id="FnameERR"></span> <span id="LnameERR"></span></div>
                <input type="email" name="Email" required="" placeholder="Email Address">
                <span id="eErr" class="err"></span>
                <input type="password" name="password" placeholder="Password" required="">
                <span id="pErr" class="err"></span>
                <input type="password" name="Confirmpass" placeholder="Confirm Password" required="">
                <span id="pcErr" class="err"></span>
                <br>
                <select name="months" required="">
                    <option value=""> Months</option>
                    <option value="january">January</option>
                    <option value="february">February</option>
                    <option value="march">March</option>
                    <option value="april">April</option>
                    <option value="may">May</option>
                    <option value="june">June</option>
                    <option value="july">July</option>
                    <option value="august">August</option>
                    <option value="september">September</option>
                    <option value="october">October</option>
                    <option value="november">November</option>
                    <option value="december">December</option>

                </select>
                <select name="Days" required="">
                    <option value="">Day</option>
                    <option value="1"> 1</option>
                    <option value="2"> 2</option>
                    <option value="3"> 3</option>
                    <option value="4"> 4</option>
                    <option value="5"> 5</option>
                    <option value="6"> 6</option>
                    <option value="7"> 7</option>
                    <option value="8"> 8</option>
                    <option value="9"> 9</option>
                    <option value="10"> 10</option>
                    <option value="11"> 11</option>
                    <option value="12"> 12</option>
                    <option value="13"> 13</option>
                    <option value="14"> 14</option>
                    <option value="15"> 15</option>
                    <option value="16"> 16</option>
                    <option value="17"> 17</option>
                    <option value="18"> 18</option>
                    <option value="19"> 19</option>
                    <option value="20"> 20</option>
                    <option value="21"> 21</option>
                    <option value="22"> 22</option>
                    <option value="23"> 23</option>
                    <option value="24"> 24</option>
                    <option value="25"> 25</option>
                    <option value="26"> 26</option>
                    <option value="27"> 27</option>
                    <option value="28"> 28</option>
                    <option value="29"> 29</option>
                    <option value="30"> 30</option>
                    <option value="31"> 31</option>
                </select>
                <input type="submit"  name="signup">
            </form>';
			return $str;
}


	public function editForm(){
		$str='<form action="profile.php?action=editaction" method="post">
		<div>Name:</div><div> <input type="text" name="UserName" value="'.$this->model->getName().'"/></div><br>
		<div>Password:</div><div> <input type="password" name="password" value="'.$this->model->getPassword().'"/></div><br>
		<div>Age:</div><div> <input type="text" name="age" value="'.$this->model->getAge().'"/></div><br>
		<div>Phone: </div><div><input type="text" name="phone" value="'.$this->model->getPhone().'"/></div><br>
		<div><input type="submit" /></div>';
		return $str;
	}
	public function reviwsform(){
		$str='<form method="post" action="">
        Product ID: <input type="text" name="productid"><br><br>
        Rating: <input type="text" name="rating"><br><br>
        Comment: <textarea name="review"></textarea><br><br>
        Date: <textarea name="reviewdate"></textarea><br><br>
        <input type="submit" name="reviews">
    </form>';
    
	return $str;
	}
}

?>
