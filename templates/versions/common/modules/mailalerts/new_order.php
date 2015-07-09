<?php include ('header.php'); ?>

<tr>
	<td align="center" class="titleblock">
		<font size="2" face="<?php echo $emailDefaultFont ?>Open-sans, sans-serif" color="#555454">
			<span class="title"><?php echo t('Congratulations!'); ?></span>
		</font>
	</td>
</tr>
<tr>
	<td class="linkbelow">
		<font size="2" face="<?php echo $emailDefaultFont ?>Open-sans, sans-serif" color="#555454">
			<span><?php echo t('A new order was placed on {shop_name} by the following customer: {firstname} {lastname} ({email})'); ?></span>
		</font>
	</td>
</tr>
<tr>
	<td class="space_footer">&nbsp;</td>
</tr>
<tr>
	<td class="box" colspan="3" style="border:1px solid #D6D4D4;">
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
				<thead>
					<tr>
						<th style="border:1px solid #D6D4D4;"><?php echo t('Reference'); ?></th>
						<th style="border:1px solid #D6D4D4;"><?php echo t('Product'); ?></th>
						<th style="border:1px solid #D6D4D4;"><?php echo t('Unit price'); ?></th>
						<th style="border:1px solid #D6D4D4;"><?php echo t('Quantity'); ?></th>
						<th style="border:1px solid #D6D4D4;"><?php echo t('Total price'); ?></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td colspan="5" style="border:1px solid #D6D4D4;">
							&nbsp;&nbsp;{items}
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
									<td align="right" class="total_amount">
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
	<td class="box" colspan="3" style="border:1px solid #D6D4D4;">
		<table class="table">
			<tr>
				<td width="10">&nbsp;</td>
				<td>
					<font size="2" face="<?php echo $emailDefaultFont ?>Open-sans, sans-serif" color="#555454">
						<p data-html-only="1" style="border-bottom:1px solid #D6D4D4;">
							<?php echo t('Carrier:'); ?>
						</p>
						<span>
							{carrier}
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
									<span>
										{delivery_block_html}
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
									<span>
										{invoice_block_html}
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
	<td class="box" colspan="3" style="border:1px solid #D6D4D4;">
		<table class="table">
			<tr>
				<td width="10">&nbsp;</td>
				<td>
					<font size="2" face="<?php echo $emailDefaultFont ?>Open-sans, sans-serif" color="#555454">
						<p data-html-only="1" style="border-bottom:1px solid #D6D4D4;">
							<?php echo t('Customer message:'); ?>
						</p>
						<span>
							{message}
						</span>
					</font>
				</td>
				<td width="10">&nbsp;</td>
			</tr>
		</table>
	</td>
</tr>

<?php include ('footer.php'); ?>
