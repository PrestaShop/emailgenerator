<?php include ('header.php'); ?>

<tr>
	<td align="center" class="titleblock">
		<font size="2" face="<?php echo $emailDefaultFont ?>Open-sans, sans-serif" color="#555454">
			<span class="title"><?php echo t('Hi {firstname} {lastname},'); ?></span>
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
						<p data-html-only="1" style="border-bottom:1px solid #D6D4D4;">
							<?php echo t('Order {order_name}'); ?>&nbsp;-&nbsp;<?php echo t('In transit'); ?>
						</p>
						<span>
							<?php echo t('Your order with the reference <span><strong>{order_name}</strong></span> is currently in transit.'); ?> <br /><br />
							<?php echo t('You can track your package using the following link:'); ?> <a href="{followup}"><?php echo t('{followup}'); ?></a>
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
		<font size="2" face="<?php echo $emailDefaultFont ?>Open-sans, sans-serif" color="#555454">
			<span>
				<?php echo t('You can review your order and download your invoice from the <a href="{history_url}">"Order history"</a> section of your customer account by clicking <a href="{my_account_url}">"My account"</a> on our shop.'); ?>
			</span>
		</font>
	</td>
</tr>
<tr>
	<td class="linkbelow">
		<font size="2" face="<?php echo $emailDefaultFont ?>Open-sans, sans-serif" color="#555454">
			<span>
				<?php echo t('If you have a guest account, you can follow your order via the <a href="{guest_tracking_url}">"Guest Tracking"</a> section on our shop.'); ?>
			</span>
		</font>
	</td>
</tr>

<?php include ('footer.php'); ?>
