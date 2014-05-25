<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?php echo $this->data['page_title']; ?></title>
    <link rel="stylesheet" href="/drb/css/foundation.css" />
    <link rel="stylesheet" href="/drb/css/drbfz.css" />
    <script src="/drb/js/vendor/modernizr.js"></script>
</head>

<body>

<div class="off-canvas-wrap" data-offcanvas="">
    <div class="inner-wrap">
        <div class="fixed">
            <nav class="tab-bar drb-bg-red">
                <section class="left-small">
                    <a class="left-off-canvas-toggle menu-icon" href="#"><span></span></a>
                </section>

                <section class="middle tab-bar-section">
                    <h1 class="title">DRB Thur Mixed</h1>
                </section>
            </nav>
        </div>

        <aside class="left-off-canvas-menu drb-bg-drd">
            <ul class="off-canvas-list">
                <li><a href="/drb/">Weekly Standings</a></li>
                <li><a href="/drb/index.php/players">Players</a></li>
            </ul>
        </aside>

        <section class="main-section">
            <!-- MAIN CONTENT GOES HERE -->
			<div class="row">
				<div class="large-12 small-12 alpha-horizontal omega-horizontal columns">
					<table class="drb-standings">
					<thead>
						<tr>
							<th class="text-center">Teams</th>
						</tr>
					</thead>
					<tbody>

					<?php
						
						$c = 1;

						foreach ($this->data['data'] as $teamData) { 
							echo "<tr>\n\t";
							echo "<td class='text-center'><a href='/drb/index.php/team/".$teamData['tid']."'>".$teamData['TeamName']."</a></td>\n\t";
							echo "</tr>\n";
							$c++;
						}

					?>
					</tbody>
					</table>
				</div>
			</div>

        </section><a class="exit-off-canvas"></a>
    </div>
</div>


<script src="/drb/js/vendor/jquery.js"></script>
<script src="/drb/js/foundation.min.js"></script>
<script>
  $(document).foundation();
</script>

</body>
</html>