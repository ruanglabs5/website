<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Axis Maps - Cartography. Visualization. Design.</title>
		<meta name="description" content="Axis Maps Data Design Code">
		<?php include('include/meta.php'); ?>
	</head>
	<body>
		<?php include('include/ga.php'); ?>
		<div id='wrapper'>
			<?php include('include/header.php'); ?>
			<div id='slideshow'>
				<img id='init' src='images/slideshow_start.png'>
				<div id='controls'><span id='prev'>&#9664;</span><span id='next'>&#9654;</span></div>
				<ul id='slides'></ul>
			</div><!-- end slideshow -->
			<?php include('include/nav.php'); ?>
			<div id='main'>
				<div id='main-content'>
					<section id='trio'>
						<h2 class='ribbon'>We build custom interactive maps. Each map is made of:</h2>
						<article class="data">
							<h3 class='more data' name='data'>Data</h3>
							<p>Every map begins with data - the raw material to be transformed into meaningful information for your audience. Whether it's a global historical narrative or rankings of local hospitals, your data is the foundation for the entire project.</p>
							<p class='more expand' name='data'><span>&#9654;</span> How we handle data</p>
						</article>
						<article class='design'>
							<h3 class='more design' name='design'>Design</h3>
							<p>Design is more than making a polished finished product. It's about turning your data into meaningful visuals and crafting a user-interface through which users can explore, discover, understand, and accomplish their goals for using the map.</p>
							<p class='more expand' name='design'><span>&#9654;</span> How we design</p>
						</article>
						<article class='code'>
							<h3 class='more code' name='code'>Code</h3>
							<p>Ideas and concepts become reality through code. It loads data, constructs the map framework and visual display, and makes your finished product look and work exactly as planned in the designs.</p>
							<p class='more expand' name='code'><span>&#9654;</span> How we code</p>
						</article>
					</section>
					<section id="explanations" class="clear-left">
						<article class='data'>
							<p><strong>Thorough understanding:</strong> Every project begins with a complete data inventory. We work with you to assemble a full picture of the geographic data as well as the numbers, text, and visual media associated with it. Once we know exactly what needs to be mapped, we can effectively design the right custom product for you.</p>
							<hr>
							<p><strong>Integration:</strong> For a map to stay healthy, active, and relevant, it needs to be updated to reflect the newest data available. It is very important for us to integrate as much of the map data as possible with your existing data processes. We want to design a system that fits into your existing workflow without expanding it.</p>
							<hr>
							<p><strong>Data Formats:</strong> We know that different organizations store their data differently. Some use databases, others rely on Excel. Because we custom design all of our maps, we can take your industry-specifc data format into account and help educate you on how geographic data fits into your current data systems.</p>
						</article>
						<article class='design'>
							<p><strong>Communicating functionality:</strong> The most important job of a user-interface is communication. Each UI element communicates a specific piece of map functionality to the user. Before we begin our design process, we'll work with you to understand your users. By knowing who it is you are targeting, we can craft the most appropriate UI for their needs and abilities.</p><hr>
							<p><strong>Comprehensive planning:</strong> At the end of the design phase, we produce a complete mock-up of every UI element and map-state for the entire project. This planning shows you exactly what is going to be built. More importantly, it gives us the chance to iterate over each element of the design, ensuring the finished product is well-thought-out, polished and unified.</p><hr>
							<p><strong>Supports your branding:</strong> Many of the maps we build for our clients exist as part of a larger project or online presence. During our design process, we'll look at your existing branding and graphic identity to ensure that our custom map fits seamlessly into the visual look you already have in place.</p>
						</article>
						<article class='code'>
							<p><strong>The right tool for the job:</strong> We believe in being versatile in the technology we use. It allows us to choose the right data and mapping technologies to be responsive to you the needs of your project and technological constraints. By not being married to a single technology, we remain current, ensuring the technology powering your map is the best available.</p><hr>
							<p><strong>Multi-device compatibility:</strong> Now more than ever, people do not access online maps in the same way. Maps need to work independent of the devices they are accessed on. We design our maps to look great on all screens, PC / Mac / tablet and to be accessible by a mouse or by touch.</p><hr>
							<p><strong>Open-source:</strong> We are proud to use open-source mapping libraries in our projects.</p>
						</article>
					</section>
					<section class='axis-summary clear-left'>
						<h2 class='ribbon'>Interactive. Data-driven. Cartographically sound.</h2>
						<h3>The power of interactive maps</h3>
						<p>Unlike simple tables, charts, and graphs, maps show your data in spatial context. Interactive maps add a set of powerful mapping tools that engage your audience in new ways.</p>
						<h3>A world of data waiting to be mapped</h3>
						<p>The world is constantly changing around us. A steady stream of location-based data provides countless opportunities to map the world.</p>
						<h3>Custom cartography</h3>
						<p>Before we became designers and developers, we were trained as cartographers. Now, we bring the traditions of our field to the Web. We custom-build each map to match your data, visual identity, message, and audience.</p>
					</section>
					<section id="mini-portfolio">
						<h2 class='ribbon'>Designed &amp; Built by Axis Maps:</h2>
						<div id='mini_portfolio'></div>
					</section>
				</div><!-- end main-content -->
				<?php include('include/sidebar.php'); ?>
				<?php include('include/footer.php'); ?>
			</div><!-- end main -->
		</div><!-- end wrapper -->
		<script src="js/jquery.js"></script>
		<script src="js/main.js"></script>
		<script>
			$(document).ready(function() {
				mini_portfolio();
			});
		</script>
	</body>
</html>