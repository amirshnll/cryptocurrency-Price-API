<!DOCTYPE html>
<html>
<head>
	<title>Cryptocurrency</title>
	<link rel="stylesheet" href="assets/lib/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="assets/lib/bootstrap/css/bootstrap-grid.min.css" />
	<link rel="stylesheet" href="assets/css/layout.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<?php
require_once('api.php');
$API = new API();
$data = $API->read();
?>

<body class="krub">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="col-md-6 float-left">
					<h1 class="display-4">Cryptocurrency Price?!</h1>
				</div>
				<div class="col-md-6 float-right text-right">
					<p id="updated_time">updated time : <?php echo $API->get_updated_time(); ?></p>
				</div>
			</div>
			<?php
			$limit = 15;
			$counter = 0;
			foreach ($data as $key => $value) {
				$counter++;
				if($counter > $limit)
					break;
				?>
				<div class="float-left col-md-3 col-sm-6 col-xs-6">
					<div class="items text-dark">
						<div class="col-md-12">
							<div class="float-left col-6">
									<h5><?php echo $value['name']; ?></h5>
									<p><?php echo $value['currency']; ?></p>
								</div>
							<div class="float-right col-4 text-right">
								<img class="card-img-top text-right" class="img-fluid" src="<?php echo $value['logo_url']; ?>" alt="Card image cap" />
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="col-12 price-box text-right">
							<p>#<?php echo $value['rank']; ?></p>
							<p>~<?php echo round($value['price'], 4); ?>$</p>
						</div>
					</div>
				</div>
			<?php } ?>
			<div class="clearfix"></div>

			<div class="col-md-12">
				<p id="copyright">&copy; 2020; <a href="https://amirshnll.ir" title="Amir Shokri">Amir Shokri</a></p>
			</div>
		</div>
	</div>


	<script src="assets/lib/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>