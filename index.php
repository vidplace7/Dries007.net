<!DOCTYPE html>
<?
	Error_Reporting( E_ALL | E_STRICT );
	Ini_Set( 'display_errors', true );
	$start = microtime(true);
	
	date_default_timezone_set("America/New_York");
	
	include("assets/php/service.class.php");
	include("assets/php/link.class.php");
	include("assets/php/serverstats.php");
	
	$services = array(
		new service("Website Http", 80, "http://vidplace7.com", "vidplace7.com"),
		new service("MySQL", 3306),
		new service("SSH", 22),
		new service("Deluge", 8112, "http://t.vidplace7.com/deluge", "t.vidplace7.com")
	);
	
	$links = array(
		"Online profiles" => array(
			new link("Home", "http://vidplace7.com", "globe"),
			new link("Github", "https://github.com/vidplace7", "github"),
			new link("Bitbucket", "https://bitbucket.com/vidplace7", "bitbucket"),
			new link("Youtube", "https://www.youtube.com/user/vidplace7", "youtube-play"),
			new link("Twitter", "https://twitter.com/austlane", "twitter"),
			new link("Email", "#contactModal", "envelope", "data-toggle=\"modal\"")
		),
		"Links" => array(
			new link("Aegis Gaming", "http://aegisgaming.org/", "gamepad"),
			new link("Not Enough Mods", "http://bot.notenoughmods.com/", "download-alt")
		)
	);
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>vidplace7.com</title>
		<meta name="author" content="vidplace7">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Le styles -->
		<link href="assets/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
		<link href="assets/css/font-awesome.css" rel="stylesheet">
		<style type="text/css">
			/* Custom container */
			.container-narrow {
			margin: 0 auto;
			max-width: 600px;
			}
			.container-narrow > hr {
			margin: 30px 0;
			}
			
			table {
			table-layout: fixed;
			}
			
			table th, table td {
			overflow: hidden; 
			}
			
			  /* Sticky footer styles
			  -------------------------------------------------- */

			  html,
			  body {
				height: 100%;
				text-align: center;
				/* The html and body elements cannot have any padding or margin. */
			  }

			  /* Wrapper for page content to push down footer */
			  #wrap {
				min-height: 100%;
				height: auto !important;
				height: 100%;
				/* Negative indent footer by it's height */
				margin: 0 auto -60px;
			  }

			  /* Set the fixed height of the footer here */
			  #push,
			  #footer {
				height: 30px;
			  }
			  #footer {
				background-color: #f5f5f5;
			  }

			  /* Lastly, apply responsive CSS fixes as necessary */
			  @media (max-width: 767px) {
				#footer {
				  margin-left: -20px;
				  margin-right: -20px;
				  padding-left: 20px;
				  padding-right: 20px;
				}
			  }
		</style>
		<link rel="shortcut icon" href="assets/ico/favicon.ico">
	</head>
	<body>
		<? include_once("assets/php/analyticstracking.php") ?>
		<div class="container-fluid" id="wrap">
			<div class="row-fluid" style="padding-top: 30px;">
				<!-- Nav sidebar -->
				<div class="span3 offset1 well sidebar-nav">
					<img src="https://secure.gravatar.com/avatar/8b54f71c3fe02069e1ddecb61084e7f6" class="img-rounded" />
					<hr>
					<ul class="nav nav-list">
					  <? foreach ($links as $catName => $cat)
						{
							echo "<li class=\"nav-header\">$catName</li>";
							foreach ($cat as $link)
							{
								$link->makeLink();
							}
						}
					  ?>
					</ul>
				</div>
				<!-- Services -->
				<div class="span4">
					<? if (isset($msg)) echo $msg;?>
					<table class="table table-hover table-condensed">
						<thead>
							<th style="text-align: right;width: 45%">Service</td>
							<th style="text-align: left;">Status</td>
						</thead>
						<? foreach($services as $service){ ?>
						<tr>
							<td style="text-align: right;"><? echo $service->name; ?></td>
							<td style="text-align: left;"><? echo $service->makeButton(); ?></td>
						</tr>
						<?}?>
					</table>
                    <hr>
                    <!-- Pr0xy -->
                    <div>
                        <span>I &lt;/3 censorship.</span>
                        <div class="form-inline">
                            <fieldset class="input-append">
                                <input type="text" id="url" placeholder="URL here please..." onkeydown="if (event.keyCode == 13) document.getElementById('goBtn').click();">
                                <a class="btn btn-success" id="sslBtn" onClick="toggleSSL();"><i class="icon-lock" id="sslIco"></i> SSL</a>
                                <a class="btn" id="goBtn" onClick="goPr0xy();">Go!</a>
                            </fieldset>
                        </div>
                        <span class="muted">Currently not usable with login systems, sorry.</span>
                    </div>
				</div>
				<!-- Server stats -->
				<div class="span3 well">
					<!-- System Load -->
					<p><b>System load</b></p>
					<? makeLoadBars(); ?>
					<hr>
					<!-- RAM Usage -->
					<p><b>RAM Usage</b></p>
					<? makeRAMBars(); ?>
					<hr>
					<!-- Disk Space -->
					<p><b>Disk space</b></p>
					<? makeDiskBars(); ?>
				</div>
			</div>
		</div>
		<!-- Footer -->
		<div id="footer">
			<div class="container">
				<p class="muted credit">
					<a href="http://vidplace7.com">&copy; vidplace7</a> <? echo date("Y")?>. Website source available <a href="https://github.com/vidplace7/vidplace7.com">here.</a><br>
					Build with <a href="https://twitter.github.io/bootstrap/"><i class="icon-github"></i> Bootstrap</a> & <a href="https://fortawesome.github.io/Font-Awesome/"><i class="icon-flag"></i> Font Awesome</a> in <? $end = microtime(true); echo round(($end - $start), 4);?> sec.
				</p>
			  </div>
		</div>
		<!-- Contact modal -->
		<div id="contactModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="myModalLabel">Contact info</h3>
			</div>
			<div class="modal-body">
				<p>I prefer to be contacted through project related channels but, if its really necessary, you can mail me at the address below.<p>
				<img src="/contact.png" style="width: 150px;"/>
			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			</div>
		</div>
		<!-- End Contact modal -->
		<script src="assets/js/jquery.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
        <script type="text/javascript">
        var ssl = true;
        function toggleSSL()
        {
            ssl = !ssl;
            if (!ssl)
            {
                document.getElementById('sslBtn').className = "btn btn-warning";
                document.getElementById('sslIco').className = "icon-unlock-alt";
            }
            else
            {
                document.getElementById('sslBtn').className = "btn btn-success";
                document.getElementById('sslIco').className = "icon-lock";
            }
            
        }
        function goPr0xy()
        {
            location.href = 'http' + (ssl ? 's' : '') + '://pr0xy.dries007.net/' + document.getElementById('url').value;
        }
        </script>
	</body>
</html>