$(document).ready(function(){

	var toggleTree = function(node)
	{
		var children = node.children('.node');

		if(children.is(':hidden'))
		{
			node.removeClass('closed').addClass('opened');
			children.show();
		}
		else
		{
			node.removeClass('opened').addClass('closed');
			children.hide();
		}
	};

	$('.node-label').click(function(){
		var my = $(this).closest('.node');
		toggleTree(my);
	});
});