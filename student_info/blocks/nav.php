<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.php">STUDENT INFO</a>
		</div>
		<div class="collapse navbar-collapse navbar-right">
			<ul class="nav navbar-nav">
				<?php 
					if($session_id == 'admin@gmail.com'){
						echo "<li><a href='admin.php'>admin</a></li>";
					}
				?>
				<li>
					<a href="blocks/logout.php">logout</a>
				</li>
			</ul>
		</div>
	</div>
</nav>