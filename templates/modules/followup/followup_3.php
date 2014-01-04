<?php include ('header.php'); ?>

<tr>
	<td align="center" class="titleblock">
		<font size="2" face="Open-sans, sans-serif" color="#555454">
			<span class="title"><?php echo t('Hi {firstname} {lastname},'); ?></span><br/>
			<span class="subtitle"><?php echo t('Thanks for your trust.'); ?></span>
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
						<p data-html-only="1" style="border-bottom:1px solid #D6D4D4;">
							<?php echo t('You are one of our best customers and as such we want to thank you for your continued patronage.'); ?>
						</p>
						<span>
							<?php echo t('As appreciation for your loyalty, we want to give you a discount of <span><strong>{amount}</strong></span>% valid on your next order! This offer is valid for <span><strong>{days}</strong></span> days, so do not waste a moment!'); ?><br /> <br /> 
							<span><strong><?php echo t('Here is your coupon:'); ?></strong></span> {voucher_num}<br /><br />
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
