<?php include ('header.php'); ?>

<tr>
	<td align="center" class="titleblock">
		<font size="2" face="<?php echo $emailDefaultFont ?>Open-sans, sans-serif" color="#555454">
			<span class="title"><?php echo t('Message from a {shop_name} customer'); ?></span>
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
					<font size="2" face="<?php echo $emailDefaultFont ?>Open-sans, sans-serif" color="#555454">
						<span>
							<span><strong><?php echo t('Customer e-mail address:'); ?> <a href="mailto:{email}">{email}</a></strong></span><br /><br />
							<span><strong><?php echo t('Customer message:'); ?></strong></span> {message}<br /><br />
							<span><strong><?php echo t('Order ID:'); ?></strong></span> {order_name}<br />
							<span><strong><?php echo t('Attached file:'); ?></strong></span> {attached_file}
						</span>
					</font>
				</td>
				<td width="10">&nbsp;</td>
			</tr>
		</table>
	</td>
</tr>

<?php include ('footer.php'); ?>