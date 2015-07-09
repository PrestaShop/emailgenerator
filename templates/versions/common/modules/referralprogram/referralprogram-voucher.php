<?php include ('header.php'); ?>

<tr>
	<td align="center" class="titleblock">
		<span class="title"><?php echo t('Hi {firstname} {lastname},'); ?></span>
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
							<?php echo t('Referral Program'); ?>
						</p>
						<span>
							<?php echo t('We have created a voucher in your name for referring a friend.'); ?><br /> 
							<?php echo t('Here is the code of your voucher:'); ?> <span><strong>{voucher_num}</strong></span><?php echo t(', with an amount of'); ?> <span><strong>{voucher_amount}</strong></span>.<br /><br />
							<?php echo t('Simply copy/paste this code during the payment process for your next order.'); ?>
						</span>
					</font>
				</td>
				<td width="10">&nbsp;</td>
			</tr>
		</table>
	</td>
</tr>

<?php include ('footer.php'); ?>