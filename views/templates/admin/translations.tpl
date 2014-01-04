{function showTranslationForm which=v title='Translations'}
<div class="panel">
	<h3>{$title}</h3>
	<form method="POST" class="form-horizontal">
		{$stay_here}
		<input type="hidden" name="language" value="{$language}">
		{foreach from=$which item=translations key=file}
			{foreach from=$translations item=translation key=key}
				<div class="form-group same-height-container">
					<div class="col-lg-6">
						<pre class="same-height">{$translation.message|escape}</pre>	
					</div>
					<div class="col-lg-6">
						<textarea class="same-height" name="translations[{$file|replace:'[lc]':'(lc)'}][{$key|escape}]" type="text">{$translation.translation|escape}</textarea>
					</div>
				</div>
			{/foreach}
		{/foreach}
		<button name="action" value="translations" class="btn btn-primary">Save And Stay</button>
	</form>
</div>
{/function}

{showTranslationForm which=$subjects title='Email Subjects'}
{showTranslationForm which=$content title='Email Contents'}

<script type="text/javascript">
	$(document).ready(function(){
		$('.same-height-container').each(function(i, e){
			var children = $(e).find('.same-height').toArray();
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
		});
	});
</script>
