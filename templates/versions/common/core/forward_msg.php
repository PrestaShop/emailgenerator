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
							<?php echo t('Customer service - Forwarded discussion'); ?>
						</p>
						<span>
							<?php echo t('<span><strong>{employee}</strong></span> wanted to forward this discussion to you.'); ?> <br /><br />
							<span><strong><?php echo t('Discussion history:'); ?></strong></span> {messages}<br /><br />
							<?php echo t('<span><strong>{employee}</strong></span> added <span><strong>"{comment}"</strong></span>'); ?> 
						</span>
					</font>
				</td>
				<td width="10">&nbsp;</td>
			</tr>
		</table>
	</td>
</tr>

<?php include ('footer.php'); ?>
