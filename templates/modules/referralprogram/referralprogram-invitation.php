<?php include ('header.php'); ?>

<tr>
	<td align="center" class="titleblock">
		<font size="2" face="<?php echo $emailDefaultFont ?>Open-sans, sans-serif" color="#555454">
			<span class="title">{firstname_friend} {lastname_friend}, <?php echo t('join us!'); ?></span>
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
							<?php echo t('Your friend <span><strong>{firstname} {lastname}</strong></span> wants to refer you on <a href="{shop_url}">{shop_name}</a>!'); ?><br /><br /> 
							<?php echo t('We are pleased to offer you a voucher worth <span><strong>{discount}</strong></span> that you can use on your next order.'); ?>			
							<?php echo t('Get referred and earn a discount voucher of <span><strong>{discount}!</strong></span>'); ?>
							<a title="Register" href="{link}"><?php echo t('It&#039;s very easy to sign up. Just click here!'); ?></a>
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
			<span><?php echo t('When signing up, don&#039;t forget to provide the e-mail address of your referring friend:'); ?> <span><strong>{email}</strong></span>.<br/><br/>
			<span><?php echo t('Best regards,'); ?>
		</font>
	</td>
</tr>

<?php include ('footer.php'); ?>