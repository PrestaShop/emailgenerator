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
	<td class="linkbelow">
		<span>{reply}</span>
	</td>
</tr>
<tr>
	<td class="space_footer">&nbsp;</td>
</tr>
<tr>
	<td class="linkbelow">
		<span>
			<?php echo t('Please do not reply directly to this email, we will not receive it.'); ?>
			<br>
			<?php echo t('In order to reply, please use the following link: <a href="{link}">{link}</a>'); ?>
		</span>
	</td>
</tr>

<?php include ('footer.php'); ?>
