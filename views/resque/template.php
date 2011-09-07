<!DOCTYPE html> 
<html> 
	<head>
		<title>Resque // <?php echo html::chars( $title ); ?></title>
		<!--// I'm so ashamed... //-->
		<style>
			html, body, div, span, applet, object, iframe,
			h1, h2, h3, h4, h5, h6, p, blockquote, pre,
			a, abbr, acronym, address, big, cite, code,
			del, dfn, em, font, img, ins, kbd, q, s, samp,
			small, strike, strong, sub, sup, tt, var,
			dl, dt, dd, ul, li,
			form, label, legend,
			table, caption, tbody, tfoot, thead, tr, th, td {
				margin: 0;
				padding: 0;
				border: 0;
				outline: 0;
				font-weight: inherit;
				font-style: normal;
				font-size: 100%;
				font-family: inherit;
			}

			:focus {
				outline: 0;
			}

			body {
				line-height: 1;
			}

			ul {
				list-style: none;
			}

			table {
				border-collapse: collapse;
				border-spacing: 0;
			}

			caption, th, td {
				text-align: left;
				font-weight: normal;
			}

			blockquote:before, blockquote:after,
			q:before, q:after {
				content: "";
			}

			blockquote, q {
				quotes: "" "";
			}
		</style>
		<style>
			html { background:#efefef; font-family:Arial, Verdana, sans-serif; font-size:13px; }
			body { padding:0; margin:0; }

			.header { background:#000; padding:8px 5% 0 5%; border-bottom:1px solid #444;border-bottom:5px solid #ce1212;}
			.header h1 { color:#333; font-size:90%; font-weight:bold; margin-bottom:6px;}
			.header ul li { display:inline;}
			.header ul li a { color:#fff; text-decoration:none; margin-right:10px; display:inline-block;  padding:8px; -webkit-border-top-right-radius:6px; -webkit-border-top-left-radius:6px; }
			.header ul li a:hover { background:#333;}
			.header ul li.current a { background:#ce1212; font-weight:bold; color:#fff;}

			.subnav { padding:2px 5% 7px 5%; background:#ce1212; font-size:90%;}
			.subnav li { display:inline;}
			.subnav li a { color:#fff; text-decoration:none; margin-right:10px; display:inline-block; background:#dd5b5b; padding:5px; -webkit-border-radius:3px; -moz-border-radius:3px;}
			.subnav li.current a { background:#fff; font-weight:bold; color:#ce1212;}
			.subnav li a:active { background:#b00909;}

			#main { padding:10px 5%; background:#fff; overflow:hidden; }
			#main .logo { float:right; margin:10px;}
			#main span.hl { background:#efefef; padding:2px;}
			#main h1 { margin:10px 0; font-size:190%; font-weight:bold; color:#ce1212;}
			#main h2 { margin:10px 0; font-size:130%;}
			#main table { width:100%; margin:10px 0;}
			#main table tr td, #main table tr th { border:1px solid #ccc; padding:6px;}
			#main table tr th { background:#efefef; color:#888; font-size:80%; font-weight:bold;}
			#main table tr td.no-data { text-align:center; padding:40px 0; color:#999; font-style:italic; font-size:130%;}
			#main a { color:#111;}
			#main p { margin:5px 0;}
			#main p.intro { margin-bottom:15px; font-size:85%; color:#999; margin-top:0; line-height:1.3;}
			#main h1.wi { margin-bottom:5px;}
			#main p.sub { font-size:95%; color:#999;}

			#main table.queues { width:40%;}
			#main table.queues td.queue { font-weight:bold; width:50%;}
			#main table.queues tr.failed td { background:#ffecec; border-top:2px solid #d37474; font-size:90%; color:#d37474;}
			#main table.queues tr.failed td a{  color:#d37474;}

			#main table.jobs td.class { font-family:Monaco, "Courier New", monospace; font-size:90%; width:50%;}
			#main table.jobs td.args{ width:50%;}

			#main table.workers td.icon {width:1%; background:#efefef;text-align:center;}
			#main table.workers td.where { width:25%;}
			#main table.workers td.queues { width:35%;}
			#main .queue-tag { background:#b1d2e9; padding:2px; margin:0 3px; font-size:80%; text-decoration:none; text-transform:uppercase; font-weight:bold; color:#3274a2; -webkit-border-radius:4px; -moz-border-radius:4px;}
			#main table.workers td.queues.queue { width:10%;}
			#main table.workers td.process { width:35%;}
			#main table.workers td.process span.waiting { color:#999; font-size:90%;}
			#main table.workers td.process small { font-size:80%; margin-left:5px;}
			#main table.workers td.process code { font-family:Monaco, "Courier New", monospace; font-size:90%;}
			#main table.workers td.process small a { color:#999;}
			#main.polling table.workers tr.working td { background:#f4ffe4; color:#7ac312;}
			#main.polling table.workers tr.working td.where a { color:#7ac312;}
			#main.polling table.workers tr.working td.process code { font-weight:bold;}


			#main table.stats th { font-size:100%; width:40%; color:#000;}
			#main hr { border:0; border-top:5px solid #efefef;  margin:15px 0;}

			#footer { padding:10px 5%; background:#efefef; color:#999; font-size:85%; line-height:1.5; border-top:5px solid #ccc; padding-top:10px;}  
			#footer p a { color:#999;}

			#main p.poll { background:url(poll.png) no-repeat 0 2px; padding:3px 0; padding-left:23px; float:right; font-size:85%; }

			#main ul.failed {}
			#main ul.failed li {background:-webkit-gradient(linear, left top, left bottom, from(#efefef), to(#fff)) #efefef; margin-top:10px; padding:10px; overflow:hidden; -webkit-border-radius:5px; border:1px solid #ccc; }
			#main ul.failed li dl dt {font-size:80%; color:#999; width:60px; float:left; padding-top:1px; text-align:right;}
			#main ul.failed li dl dd {margin-bottom:10px; margin-left:70px;}
			#main ul.failed li dl dd code, #main ul.failed li dl dd pre { font-family:Monaco, "Courier New", monospace; font-size:90%;}
			#main ul.failed li dl dd.error a {font-family:Monaco, "Courier New", monospace; font-size:90%; }
			#main ul.failed li dl dd.error pre { margin-top:3px; line-height:1.3;}

			#main p.pagination { background:#efefef; padding:10px; overflow:hidden;}
			#main p.pagination a.less { float:left;}
			#main p.pagination a.more { float:right;}

			#main form.clear-failed {float:right; margin-top:-10px;}

			ul.pagination{
					list-style-type: none;
			}
			ul.pagination li{
					text-decoration: none;
					display:inline;
			}		
		</style>
	</head>
	<body>
		<div class="header"> 
				<ul class='nav'> 
						<li><a href='/resque/'>Overview</a></li> 
						<li><a href='/resque/working/'>Working</a></li> 
						<li><a href='/resque/failed/'>Failed</a></li> 
						<li><a href='/resque/queues/'>Queues</a></li> 
						<li><a href='/resque/workers/'>Workers</a></li> 
						<li><a href='/resque/delayed/'>Delayed</a></li> 
						<li><a href='/resque/stats/'>Stats</a></li> 
				</ul> 
			</div> 
			
		<ul class='subnav'>
		<?php foreach( $subnav as $name => $target ): ?>
			<li><a href="<?php echo $target; ?>"><span><?php echo html::chars( $name ); ?></span></a></li>
		<?php endforeach; ?>
		</ul> 
		
		<div id="main">
			<?php echo $content; ?>
		</div> 
		 
		<div id="footer"> 
			<p>Powered by <a href="http://github.com/jmhobbs/K3-Resque">K3-Resque</a> version 0.1</p> 
			<p>Connected to Redis on localhost:6379</p> 
		</div> 
	 
	</body> 
</html>
