{function showTranslations from=null}
	{foreach from=$from item=data key=message}
		<input 
			type="hidden" 
			name="translations[{$data.id}][message]" 
			value="{$message|escape}"
		>

		<input 
			type="hidden" 
			name="translations[{$data.id}][file]" 
			value="{$data.file}"
		>

		<div class="row same-height-container">
			<div class="col-lg-6">
				<pre class="same-height">{$message|escape}</pre>
			</div>
			<div class="col-lg-6">
				<textarea name="translations[{$data.id}][translation]" class="same-height">{$data.translation}</textarea>
			</div>
		</div>
	{/foreach}
{/function}

<div class="panel">
	<h3>{$template_name}</h3>
	<div class="alert alert-info">
		<p>{l s='You are viewing the "%s" template.' mod='emailgenerator' sprintf=$template_name}</p>
	</div>

	<form action="" method="POST">
		{foreach from=$strings.files item=path key=id}
			<input type='hidden' name='files[{$id}]' value="{$path}">
		{/foreach}
		<input type="hidden" name="subAction" value="postTranslations">
		{if isset($strings.subjects) and $strings.subjects|count > 0}
			<h4>{l s='Subject strings for this email'}</h4>
			{showTranslations from=$strings.subjects}
		{/if}
		{if isset($strings.potential_subjects) and $strings.potential_subjects|count > 0}
			<h4>{l s='Potential subject strings for this email'}</h4>
			{showTranslations from=$strings.potential_subjects}
		{/if}
		<h4>{l s='Strings in the email body' mod='emailgenerator'}</h4>
		{showTranslations from=$strings.body}
		<div class='alert alert-warning'>
			<p>{l s='<strong>Warning</strong>: On some systems, due to internal caching mechanisms, you may not see your translations saved after submitting them, but they should be. Just refresh the page to make sure if that happens!' mod='emailgenerator'}</p>
		</div>
		<button class='btn btn-success'>{l s='Save Translations' mod='emailgenerator'}</button>
	</form>
</div>

<script>
	function fixHeights()
	{
		$('.same-height-container').each(function(i, e){
			var jchildren = $(e).find('.same-height');
			var children = jchildren.toArray();
			if(jchildren.is(':visible'))
			{
				var maxHeight = -1;
				for(var i in children)
				{
					var h = $(children[i]).outerHeight();
					if(h > maxHeight)
					{
						maxHeight = h;
					}
				}
				for(var i in children)
				{
					var c = $(children[i]);
					c.height(maxHeight - (c.outerHeight()-c.height()));
				}
			}
		});
	};

	$(document).ready(function(){
		fixHeights();
	});
</script>