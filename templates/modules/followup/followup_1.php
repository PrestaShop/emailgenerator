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
							<?php echo t('Your cart at {shop_name}'); ?>
						</p>
						<span>
							<?php echo t('We noticed that during your last visit on {shop_name}, you did not complete the order you had started.'); ?><br /> <br /> 
							<?php echo t('Your cart has been saved, you can resume your order by visiting our shop:'); ?> <span><strong><a title="{shop_name}" href="{shop_url}">{shop_url}</a></strong></span><br /><br />
							<?php echo t('As an incentive, we can give you a discount of {amount}% off your next order! This offer is valid for <span><strong>{days}</strong></span> days, so do not waste a moment!'); ?>
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
	<td class="box" style="border:1px solid #D6D4D4;">
		<table class="table">
			<tr>
				<td width="10">&nbsp;</td>
				<td>
					<font size="2" face="<?php echo $emailDefaultFont ?>Open-sans, sans-serif" color="#555454">
						<p data-html-only="1" style="border-bottom:1px solid #D6D4D4;">
							<?php echo t('Your {shop_name} login details'); ?>
						</p>
						<span>
							<span><strong><?php echo t('Here is your coupon:'); ?></strong></span> {voucher_num}<br />
							<?php echo t('Enter this code in your shopping cart to get your discount.'); ?>
						</span>
					</font>
				</td>
				<td width="10">&nbsp;</td>
			</tr>
		</table>
	</td>
</tr>

<?php include ('footer.php'); ?>
