<div style="color:#fff; background-color: #000; padding-top: 20px;">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<p class="text-center">
					<a href="index.php"><?= base64_decode($sitename); ?></a> | Powered by <a href="https://www.codebrotherindia.com/Sudarshan" rel="nofollow" target="_blank">Sudarshan WB</a>
				</p>
			</div>
		</div>
	</div>
</div>

<?php
	if (strlen($whatsapp)>9) {
		?>
		<div class="wa">
		<a href="https://wa.me/<?= $whatsapp; ?>" style='position:fixed; right:2%; bottom:4%;'><img src="controlpanel/site_files/wa.png" alt="WhatsApp Chat"></a></div>

		<?php
	}
?>

<?php
	if (strlen($paymentlink) > 4) {
		?>
		<div class="icon-bar">
		  <a href="<?= $paymentlink; ?>" class="pay-button" style="position:fixed; left:0%; bottom:40%;"><img src="controlpanel/site_files/paynow.png" alt="Make Payments" title="Make Payments"></a> 
		</div>

		<?php
	}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>