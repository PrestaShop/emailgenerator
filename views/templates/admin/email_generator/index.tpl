{function templateActions template=[]}
	<a href='{$emailgenerator}&amp;action=details&amp;template={$template.path}'>{$template.name}</a>
{/function}

<div class="panel">
	<h3>Email Templates</h3>
	<div class="alert alert-info">
		<p>{l s='Here are the email templates currently installed on your shop.' mod='emailgenerator'}</p>
		<p>{l s='Unroll the tree and click on any e-mail to access its translations and more.' mod='emailgenerator'}</p>
	</div>
	<div class="tree">
		<div class="node">
			<p class='node-label'>Core</p>
			{foreach from=$templates['core'] item=template}
				<div class="leaf node">
					{templateActions template=$template}
				</div>
			{/foreach}
		</div>
		<div class="node">
			<p class='node-label'>Modules</p>
			{foreach from=$templates['modules'] item=files key=module}
				<div class="node">
					<p class='node-label'>{$module}</p>
					{foreach from=$files item=template}
						<div class="leaf node">
							{templateActions template=$template}
						</div>
					{/foreach}
				</div>
			{/foreach}
		</div>
	</div>
</div>