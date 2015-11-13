<?php session_start(); ?>
<?php
require_once 'connections/connection.php';

$query = "SELECT * FROM wwa";
$result = mysqli_query($con, $query);
$record = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<link rel="shortcut icon" href="assets/img/Consilium.svg">
	<title>Consilium - Who we are</title>
	<link rel="stylesheet" href="./assets/font-awesome/css/font-awesome.min.css" />
	<link rel="stylesheet" href="./assets/css/custom.min.css" />

</head>
<body class="wwa-body">
	<?php require_once('includes/header.html') ?>
	<div class="c-container">
		<?php
		require_once 'includes/curPageScript.php';
		if (isset($_SESSION['username']) && $_SESSION['access'] === "admin") {
			?>
			<div id="edit-page" class="pull-right">
				<a href="redirect-to.php?redirect-to=<?php echo curPageName(); ?>">Edit Page</a> | <a href="admin/index.php">Admin Panel</a>
			</div>
			
			<?php
		}
		?>
		<div class="banner">
			<div class="main-image-overlay">
				<div class="banner-word">"Helping people learn the lessons of Leadership can create a more connected, integrated and prosperous world."</div>
			</div>
		</div>
		<div class="container">
			<div class="heading-container">
		      <h2>Who We Are</h2>
		      <div style="position: relative"><hr class="fancy-line"></div>
		    </div>
			<?php echo $record['content'] ?>
			<div class="heading-container">
		      <h2>Founder's Intro</h2>
		      <div style="position: relative"><hr class="fancy-line"></div>
		      <h3 style="text-align: center; color: #F4A74B;">Hassan Khan</h3>
		      <div style="position: relative"><hr class="fancy-line"></div>
		    </div>
		    <div class="row">
					<img class="intro-hassan" src="assets/img/slider-images/intro-hassan.jpg" alt="">
		    	
		    		<p>Hassan has spent the best part of the last decade working with leaders and helping them successfully lead significant change and transformation efforts. A qualified Lawyer, Hassan transitioned into Consulting after moving to England from Australia a number of years ago. His work has been focused on and around Leadership Development, and enabling companies to formulate and then accelerate the implementation of their most important strategies – specifically facilitating the people change and transition of new organisational models, structures and culture into businesses.</p>

		    		<p>Hassan is a graduate and alumni of Harvard Business School, he holds an Economics degree, a Law degree and a Master of Business Administration degree, and he is a Master Practitioner in Neuro-Linguistic Programming. Hassan has worked for IBM Global Business Services and Capgemini Consulting, and has worked for a number of high profile clients, such as the NHS, BP, Merrill Lynch and EDF Energy (to name a few), and on numerous high profile projects. He has designed Leadership Programs for specific organisations, he has designed, initiated and scaled successful change efforts, and he has reorganised and reenergised systems and structures to create efficient processes within and for a number of different client organisations.</p>

		    		<p>During his few years at Harvard Business School, Hassan’s primary focus of study was on Leadership Development. He has completed extensive research on Personal Leadership, Leading Change and Decision Making, and he has studied in depth the function and practice of Leadership and its ability to mobilise people, groups, organisations, and cultures to achieve and produce results. Hassan believes strongly in the ability of effective Leadership to provide orientation and reassurance in addressing the biggest problems and toughest challenges facing the world today – within government, business, economic and social development, sports, management etc. He has no doubt that Leadership can be taught and shaped gradually, and that helping people find their unique voice and learn the lessons of Leadership can create a more connected, integrated and prosperous world.</p>

		    		<p>Motivated and inspired after graduating, Hassan was driven by a desire to do more meaningful work and make a bigger impact in the world. He is passionate about educating, motivating and helping people, and felt strongly about using his expertise and experience to enhance the Leadership capability of individuals and groups within various organisations and settings in different parts of world (and in particular the developing world, where there traditionally isn’t access to cutting-edge learning and/or deep Leadership expertise). Hassan’s diverse research background, coupled with his advanced study and broad base of experience enabled and led him to create Consilium - a Leadership Development firm offering a curriculum of learning that aims to develop the next generation of high potential leaders. Hassan hopes Consilium will provide and be a spark that makes a positive difference in people’s lives, and helps them grow, develop and perform at their highest potential on behalf of the common good. Consilium is offering its Leadership Development services and packages to entities all over the world.</p>

		    		<p>Hassan is an avid book reader, a passionate cricket fan and active player, an amateur magician, and is currently researching and writing a book about the psychological factors and influences that get in the way of leading effective change.</p>
					<?php echo $record['ceo'] ?>	
		    	
				
				
		    </div>
			<!--<div>
				<img class="img-responsive img-circle" src="gallery/images/<?php echo $record['img'] ?>" style="float:right; width: 340px; height: auto; margin-top: 4px; margin-bottom: 14px; margin-left: 16px">
				
			</div>-->
		
		
		</div>
	</div>
	<?php require_once 'includes/footer.html'; ?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/main.js"></script>
</body>
</html>
