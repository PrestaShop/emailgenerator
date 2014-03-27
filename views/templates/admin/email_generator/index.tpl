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
	<BR/>
	<div class='form-horizontal'>
		<div class="form-group">
			<div class="col-lg-3">
				<button id='generate-all-emails' onclick='javascript:generateEmails();' class="btn btn-default" type="button">{l s='Generate All Emails'}</button>
			</div>
			<div class="col-lg-9">
				<div id="feedback"></div>
			</div>
		</div>
	</div>
</div>

<script>
	var emailsToBuild = {$toBuild};

	function generateEmails()
	{
		var queue;
		var total = 0;
		var processed = 0;

		function feedback(message, klass)
		{
			if (!klass)
			{
				klass = '';
			}
			$('#feedback').attr('class', klass).html(message);
		};

		function init()
		{
			// Maybe we need to do it again later, so clone the queue
			queue = JSON.parse(JSON.stringify(emailsToBuild));
			processed = 0;
			total = queue.length;
		};

		function done()
		{
			feedback('Done!', 'success');
		};

		function generate(languageCode, template, then)
		{
			feedback((processed/total*100).toFixed()+"% - Generating '"+template+"' in language '"+languageCode+"' ...");

			$.post("{$link->getAdminLink('AdminEmailGenerator')}&ajax=1&action=generateEmail", {
					languageCode: languageCode,
					template: template
				}, function(resp){
					then(JSON.parse(resp));
				}
			);
		};

		function dequeue()
		{
			if(queue.length === 0)
			{
				done();
			}
			else
			{
				var item = queue.shift();
				var res = generate(item.languageCode, item.template, function (resp) {
					if(resp.success === true)
					{
						processed += 1;
						dequeue();
					}
					else
					{
						var errclass = 'error';

						if(typeof resp.error_message === 'string')
						{
							feedback(resp.error_message, errclass);
						}
						else
						{
							feedback('Unspecified error.', errclass);
						}
					}
				});
			}
		};

		init();
		dequeue();
	}
</script>