{function showTranslationForm which=v title='Translations'}
<div class="panel">
	<h3>{$title}</h3>
	<form method="POST" class="form-horizontal">
		{$stay_here}
		<button data-showing='0' onclick="javascript:toggleShowAlreadyTranslated(this)" class="btn btn-default" type="button">Show already translated</button>
		<input type="hidden" name="language" value="{$language}">
		<div class='translations'>
			{foreach from=$which item=translations key=file}
				{foreach from=$translations item=translation key=key}
					<div {if $translation.translation}style="display: none"{/if} class="translation-row form-group same-height-container">
						<div class="col-lg-6">
							<pre class="same-height">{$translation.message|escape}</pre>	
						</div>
						<div class="col-lg-6">
							<textarea class="translation same-height" name="translations[{$file|replace:'[lc]':'(lc)'}][{$key|escape}]" type="text">{$translation.translation|escape}</textarea>
						</div>
					</div>
				{/foreach}
			{/foreach}
		</div>
		<button name="action" value="translations" class="btn btn-primary">Save And Stay</button>
	</form>
</div>
{/function}

<style type="text/css">
	div.translations
	{
		max-height: 400px;
		overflow-y: auto;
		padding-right: 30px;
		margin-top: 15px;
		margin-bottom: 15px;
	}
</style>

<p><a href="{$url}">&lt;&lt; go back to Email Generator</a></p>


{showTranslationForm which=$subjects title='Email Subjects'}
{showTranslationForm which=$content title='Email Contents'}

<p><a href="{$url}">&lt;&lt; go back to Email Generator</a></p>

<script type="text/javascript">

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

	function toggleShowAlreadyTranslated(e)
	{
		var button = $(e);
		var showing = 1 - parseInt(button.attr('data-showing'));
		if (showing)
		{
			button.html("Hide Already Translated");
		}
		else
		{
			button.html("Show Already Translated");
		}
		button.attr('data-showing', showing);
		var textareas = button.closest('form').find('textarea.translation');
		textareas.each(function(i, t){
			var row = $(t).closest('.translation-row');
			if($(t).val())
			{
				if (showing)
				{
					row.show();
				}
				else
				{
					row.hide();
				}
			}
		});

		fixHeights();
	}
</script>
