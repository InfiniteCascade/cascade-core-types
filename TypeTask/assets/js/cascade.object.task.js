$preparer.add(function(context) {
	$(".taskCompletedStatus", context).change(function() {
		if ($(this).is(':checked')) {
			$(this).attr('title', 'Task was completed');
		} else {
			$(this).attr('title', 'Task has not been completed');
		}
	});
});