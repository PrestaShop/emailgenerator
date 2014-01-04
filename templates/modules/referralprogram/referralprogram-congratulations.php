<?php include ('header.php'); ?>

<tr>
	<td align="center" class="titleblock">
		<font size="2" face="Open-sans, sans-serif" color="#555454">
			<span class="title"><?php echo t('Congratulations!'); ?></span>
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
							<?php echo t('Your referred friend <span><strong>{sponsored_firstname} {sponsored_lastname}</strong></span> has placed his or her first order on <a href="{shop_url}">{shop_name}</a>!'); ?><br /><br /> 
							<?php echo t('We are pleased to offer you a voucher worth <span><strong>{discount_display} (voucher # {discount_name})</strong></span> that you can use on your next order.'); ?>
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
			<span><?php echo t('Best regards,'); ?></span>
		</font>
	</td>
</tr>

<?php include ('footer.php'); ?>