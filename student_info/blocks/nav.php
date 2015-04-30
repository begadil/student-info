<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<?php 
				if($session_id == 'admin@gmail.com'){
					echo "<a class='navbar-brand' href='index.php'>STUDENT INFO</a>";
				}
				else{
					echo "<a class='navbar-brand' href='adviser.php'>STUDENT INFO</a>";
				}
			?>
			
		</div>
		<div class="collapse navbar-collapse navbar-right">
			<ul class="nav navbar-nav">
				<?php 
					if($session_id == 'admin@gmail.com'){
						echo "<li><a href='admin.php'>admin</a></li>";
					}
					else{
						echo "<li class = 'dropdown'>
								<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'>
									add student <span class='caret'></span>
								</a>
								<ul class='dropdown-menu' role='menu'>";
									
						$q = mysql_query("select gr.* from adviser_group as ag, `group` as gr, adviser as ad
										  		where gr.id = ag.group_id and 
												ag.adviser_id = ad.id and
												ad.email = '$session_id' order by gr.name");
						$n = mysql_num_rows($q);
						if($n > 0){
							$i = 0;
							while($a = mysql_fetch_array($q)){
								
								echo "<li><a href='adviser_student.php?group_id=$a[id]'>$a[name]</a></li>";
								if($i < $n-1){
									echo "<li class='divider'></li>";
								}
								$i++;
							}
						}
						else{
							echo "<li><a href='#'>no groups yet</a></li>";
						}
									
						echo "</ul></li>";
						echo "<li><a href='search_student.php'>search student</a></li>";
						echo "<li><a href='adviser_settings.php'>settigns</a></li>";
					}
				?>
				<li>
					<a href="blocks/logout.php">logout</a>
				</li>
			</ul>
		</div>
	</div>
</nav>