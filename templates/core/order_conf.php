<?php include ('header_order_conf.php'); ?>

<tr>
	<td align="center" class="titleblock">
		<font size="2" face="<?php echo $emailDefaultFont ?>Open-sans, sans-serif" color="#555454">
			<span class="title"><?php echo t('Hi {firstname} {lastname},'); ?></span><br/>
			<span class="subtitle"><?php echo t('Thank you for shopping with {shop_name}!'); ?></span>
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
							<?php echo t('Order details'); ?>
						</p>
						<span>
							<span><strong><?php echo t('Order:'); ?></strong></span> {order_name} <?php echo t('Placed on'); ?> {date}<br /><br />
							<span><strong><?php echo t('Payment:'); ?></strong></span> {payment}
						</span>
					</font>
				</td>
				<td width="10">&nbsp;</td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td>
		<font size="2" face="<?php echo $emailDefaultFont ?>Open-sans, sans-serif" color="#555454">
			<table class="table table-recap" bgcolor="#ffffff"><!-- Title -->
				<tr>
					<th bgcolor="#f8f8f8" style="border:1px solid #D6D4D4;background-color: #fbfbfb;color: #333;font-family: Arial;font-size: 13px;padding: 10px;"><?php echo t('Reference'); ?></th>
					<th bgcolor="#f8f8f8" style="border:1px solid #D6D4D4;background-color: #fbfbfb;color: #333;font-family: Arial;font-size: 13px;padding: 10px;"><?php echo t('Product'); ?></th>
					<th bgcolor="#f8f8f8" style="border:1px solid #D6D4D4;background-color: #fbfbfb;color: #333;font-family: Arial;font-size: 13px;padding: 10px;" width="17%"><?php echo t('Unit price'); ?></th>
					<th bgcolor="#f8f8f8" style="border:1px solid #D6D4D4;background-color: #fbfbfb;color: #333;font-family: Arial;font-size: 13px;padding: 10px;"><?php echo t('Quantity'); ?></th>
					<th bgcolor="#f8f8f8" style="border:1px solid #D6D4D4;background-color: #fbfbfb;color: #333;font-family: Arial;font-size: 13px;padding: 10px;" width="17%"><?php echo t('Total price'); ?></th>
				</tr>
				<tr>
					<td colspan="5" style="border:1px solid #D6D4D4; text-align: center">
						&nbsp;&nbsp;<html-only>{products}</html-only> <span data-text-only="1">{products_txt}</span>
					</td>
				</tr>
				<tr>
					<td colspan="5" style="border:1px solid #D6D4D4;text-align: center">
						&nbsp;&nbsp;{discounts}
					</td>
				</tr>
				<tr class="conf_body">
					<td bgcolor="#f8f8f8" colspan="4" style="border:1px solid #D6D4D4;">
						<table class="table">
							<tr>
								<td width="10">&nbsp;</td>
								<td align="right">
									<font size="2" face="<?php echo $emailDefaultFont ?>Open-sans, sans-serif" color="#555454">
										<strong><?php echo t('Products'); ?></strong>
									</font>
								</td>
								<td width="10">&nbsp;</td>
							</tr>
						</table>
					</td>
					<td bgcolor="#f8f8f8" align="right" colspan="4" style="border:1px solid #D6D4D4;">
						<table class="table">
							<tr>
								<td width="10">&nbsp;</td>
								<td align="right">
									<font size="2" face="<?php echo $emailDefaultFont ?>Open-sans, sans-serif" color="#555454">
										{total_products}
									</font>
								</td>
								<td width="10">&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr class="conf_body">
					<td bgcolor="#f8f8f8" colspan="4" style="border:1px solid #D6D4D4;">
						<table class="table">
							<tr>
								<td width="10">&nbsp;</td>
								<td align="right">
									<font size="2" face="<?php echo $emailDefaultFont ?>Open-sans, sans-serif" color="#555454">
										<strong><?php echo t('Discounts'); ?></strong>
									</font>
								</td>
								<td width="10">&nbsp;</td>
							</tr>
						</table>
					</td>
					<td bgcolor="#f8f8f8" colspan="4" style="border:1px solid #D6D4D4;">
						<table class="table">
							<tr>
								<td width="10">&nbsp;</td>
								<td align="right">
									<font size="2" face="<?php echo $emailDefaultFont ?>Open-sans, sans-serif" color="#555454">
										{total_discounts}
									</font>
								</td>
								<td width="10">&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr class="conf_body">
					<td bgcolor="#f8f8f8" colspan="4" style="border:1px solid #D6D4D4;">
						<table class="table">
							<tr>
								<td width="10">&nbsp;</td>
								<td align="right">
									<font size="2" face="<?php echo $emailDefaultFont ?>Open-sans, sans-serif" color="#555454">
										<strong><?php echo t('Gift-wrapping'); ?></strong>
									</font>
								</td>
								<td width="10">&nbsp;</td>
							</tr>
						</table>
					</td>
					<td bgcolor="#f8f8f8" colspan="4" style="border:1px solid #D6D4D4;">
						<table class="table">
							<tr>
								<td width="10">&nbsp;</td>
								<td align="right">
									<font size="2" face="<?php echo $emailDefaultFont ?>Open-sans, sans-serif" color="#555454">
										{total_wrapping}
									</font>
								</td>
								<td width="10">&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr class="conf_body">
					<td bgcolor="#f8f8f8" colspan="4" style="border:1px solid #D6D4D4;">
						<table class="table">
							<tr>
								<td width="10">&nbsp;</td>
								<td align="right">
									<font size="2" face="<?php echo $emailDefaultFont ?>Open-sans, sans-serif" color="#555454">
										<strong><?php echo t('Shipping'); ?></strong>
									</font>
								</td>
								<td width="10">&nbsp;</td>
							</tr>
						</table>
					</td>
					<td bgcolor="#f8f8f8" colspan="4" style="border:1px solid #D6D4D4;">
						<table class="table">
							<tr>
								<td width="10">&nbsp;</td>
								<td align="right">
									<font size="2" face="<?php echo $emailDefaultFont ?>Open-sans, sans-serif" color="#555454">
										{total_shipping}
									</font>
								</td>
								<td width="10">&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr class="conf_body">
					<td bgcolor="#f8f8f8" colspan="4" style="border:1px solid #D6D4D4;">
						<table class="table">
							<tr>
								<td width="10">&nbsp;</td>
								<td align="right">
									<font size="2" face="<?php echo $emailDefaultFont ?>Open-sans, sans-serif" color="#555454">
										<strong><?php echo t('Total Tax paid'); ?></strong>
									</font>
								</td>
								<td width="10">&nbsp;</td>
							</tr>
						</table>
					</td>
					<td bgcolor="#f8f8f8" colspan="4" style="border:1px solid #D6D4D4;">
						<table class="table">
							<tr>
								<td width="10">&nbsp;</td>
								<td align="right">
									<font size="2" face="<?php echo $emailDefaultFont ?>Open-sans, sans-serif" color="#555454">
										{total_tax_paid}
									</font>
								</td>
								<td width="10">&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr class="conf_body">
					<td bgcolor="#f8f8f8" colspan="4" style="border:1px solid #D6D4D4;">
						<table class="table">
							<tr>
								<td width="10">&nbsp;</td>
								<td align="right">
									<font size="2" face="<?php echo $emailDefaultFont ?>Open-sans, sans-serif" color="#555454">
										<strong><?php echo t('Total paid'); ?></strong>
									</font>
								</td>
								<td width="10">&nbsp;</td>
							</tr>
						</table>
					</td>
					<td bgcolor="#f8f8f8" colspan="4" style="border:1px solid #D6D4D4;">
						<table class="table">
							<tr>
								<td width="10">&nbsp;</td>
								<td align="right">
									<font size="4" face="<?php echo $emailDefaultFont ?>Open-sans, sans-serif" color="#555454">
										{total_paid}
									</font>
								</td>
								<td width="10">&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
				</tbody>
			</table>
		</font>
	</td>
</tr>
<tr>
	<td class="box" style="border:1px solid #D6D4D4;">
		<table class="table">
			<tr>
				<td width="10">&nbsp;</td>
				<td>
					<font size="2" face="<?php echo $emailDefaultFont ?>Open-sans, sans-serif" color="#555454">
						<p data-html-only="1" style="border-bottom:1px solid #D6D4D4;">
							<?php echo t('Shipping'); ?>
						</p>
						<span>
							<span><strong><?php echo t('Carrier:'); ?></strong></span> {carrier}<br /><br />
							<span><strong><?php echo t('Payment:'); ?></strong></span> {payment}
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
	<td>
		<table class="table">
			<tr>
				<td class="box address" width="310" style="border:1px solid #D6D4D4;">
					<table class="table">
						<tr>
							<td width="10">&nbsp;</td>
							<td>
								<font size="2" face="<?php echo $emailDefaultFont ?>Open-sans, sans-serif" color="#555454">
									<p data-html-only="1" style="border-bottom:1px solid #D6D4D4;">
										<?php echo t('Delivery address'); ?>
									</p>
									<span data-html-only="1">
										{delivery_block_html}
									</span>
									<span data-text-only="1">
										{delivery_block_txt}
									</span>
								</font>
							</td>
							<td width="10">&nbsp;</td>
						</tr>
					</table>
				</td>
				<td width="20" class="space_address">&nbsp;</td>
				<td class="box address" width="310" style="border:1px solid #D6D4D4;">
					<table class="table">
						<tr>
							<td width="10">&nbsp;</td>
							<td>
								<font size="2" face="<?php echo $emailDefaultFont ?>Open-sans, sans-serif" color="#555454">
									<p data-html-only="1" style="border-bottom:1px solid #D6D4D4;">
										<?php echo t('Billing address'); ?>
									</p>
									<span data-html-only="1">
										{invoice_block_html}
									</span>
									<span data-text-only="1">
										{invoice_block_txt}
									</span>
								</font>
							</td>
							<td width="10">&nbsp;</td>
						</tr>
					</table>
				</td>
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
