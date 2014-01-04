<?php include ('header.php'); ?>

<tr>
	<td align="center" class="titleblock">
		<font size="2" face="Open-sans, sans-serif" color="#555454">
			<span class="title"><?php echo t('Your message to {shop_name} Customer Service'); ?></span>
		</font>
	</td>
</tr>
<tr>
	<td class="space_footer">&nbsp;</td>
</tr>
<tr>
	<td class="box" style="border:1px solid #D6D4D4;">
		<table class="table">
			<tr>
				<td width="10">&nbsp;</td>
				<td>
					<font size="2" face="Open-sans, sans-serif" color="#555454">
						<span>
							<?php echo t('Your message has been sent successfully.'); ?><br /><br />
							<span><strong><?php echo t('Message:'); ?></strong></span> {message}<br /><br />
							<span><strong><?php echo t('Order ID:'); ?></strong></span> {order_name}<br />
							<span><strong><?php echo t('Product:'); ?></strong></span> {product_name}<br />
							<span><strong><?php echo t('Attached file:'); ?></strong></span> {attached_file}
						</span>
					</font>
				</td>
				<td width="10">&nbsp;</td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td class="space_footer">&nbsp;</td>
</tr>
<tr>
	<td class="linkbelow">
		<font size="2" face="Open-sans, sans-serif" color="#555454">
			<span>
				<?php echo t('We will answer as soon as possible.'); ?>
			</span>
		</font>
	</td>
</tr>

<?php include ('footer.php'); ?>