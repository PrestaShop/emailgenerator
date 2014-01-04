<link rel='stylesheet' href='/modules/emailgenerator/css/index.css'>
<script src='/modules/emailgenerator/js/tree.js'></script>

{function templateActions template=[]}
	<a target='_blank' href="/modules/emailgenerator/templates/viewer.php?template={$template.path}&amp;preview">Preview</a>
{/function}

<div class="panel">
	<h3>Email Previews</h3>
	<div class="tree">
		<div class="node">
			<p class='node-label'>Core</p>
			{foreach from=$templates['core'] item=template}
				<div class="leaf node">
					{$template.name} {templateActions template=$template}
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
							{$template.name} {templateActions template=$template}
						</div>
					{/foreach}
				</div>
			{/foreach}
		</div>
	</div>
	<BR/>
	<form method="POST">
		{$stay_here}
		<button name="action" value="generate" class="btn btn-default">Generate all E-mails</button>
	</form>
</div>

<div class="panel">
	<h3>Email Translations</h3>
	<form method="GET" action="" class="form-horizontal">
		{$stay_here}
		<div class="form-group">
			<label for="language" class="col-lg-3 control-label">Language</label>
			<div class="col-lg-3">
				<select name="language" id="language">
					{foreach from=$languages item=language}
						<option value={$language.iso_code}>{$language.name}</option>
					{/foreach}
				</select>
			</div>
		</div>
		<div class="form-group">
			<div class="col-lg-3"></div>
			<div class="col-lg-3">
				<button name="action" value="translations" class="btn">Translate</button>
			</div>
		</div>
	</form>
</div>