<!-- Begin navigation bar-->
<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<a class="navbar-brand" href="/"><?php echo SITE_NAME; ?></a>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav my-2 my-lg-0">
			<li id="navGradcheck" class="nav-item"><a href="check.php" class="nav-link">Check</a></li>
			<li id="navManage" class="nav-item"><a href="modules.php" class="nav-link">Modules</a></li>
			<li id="navPillars" class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Pillars
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				<a class="dropdown-item" href="pillars.php?pillar=ISTD">ISTD</a>
				<a class="dropdown-item" href="pillars.php?pillar=ASD">ASD</a>
				<a class="dropdown-item" href="pillars.php?pillar=EPD">EPD</a>
				<a class="dropdown-item" href="pillars.php?pillar=ESD">ESD</a>
				</div>
			</li>
		</ul>
	</div>
</nav>
