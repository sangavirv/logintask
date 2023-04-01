<!DOCTYPE html>
<html>
<head>

<script src="vendor/jquery/jquery-3.2.1.min.js"></script>

<link rel="stylesheet" href="css/style.css">

<link rel="stylesheet"
    href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

 <script type="text/javascript" src="js/login.js"></script>
       
</head>

<body>

     
        
        

<div class="dashboard">
    <h2> <?php
    if (isset($_SESSION['username'])) {
        echo "Welcome  " . $_SESSION['username'];
        
        ?></h2>
        <div style="height: 10px"></div>
    <div>
        <a href="php/logout.php"><input type="button" class="btn-logout"
            value="Logout"></a>
			
			<a href="php/profile.php"><input type="button" class="btn-logout"
            value="My Profile"></a>

    </div>
        <?php
    }
    ?>
</div>


	
	

</body>
</html>