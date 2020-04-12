jQuery(document).ready(function($){
	$('#the-list').sortable().bind('sortupdate', function(){
		var order = [];
		var count = 0;
		var qs = getQueryParams(jQuery('input[name="_wp_http_referer"]').val().slice(jQuery('input[name="_wp_http_referer"]').val().indexOf('?') + 1));
		if(qs.hasOwnProperty('paged')){
			var page = qs.paged;
		} else {
			var page = 1;
		}
		var taxonomy = qs.taxonomy;
		var perpage = $('input[type="number"].screen-per-page').val();
		console.log(page);
		$(this).find('tr').each(function(){
			order[count] = parseInt($(this).attr('id').replace("tag-", ""));
			count++;
		});
		$.ajax({
			url: ajaxurl,
			type: 'POST',
			data: {
				action: 'sort-taxonomy',
				page: page,
				order: order,
				taxonomy: taxonomy,
				perpage: perpage
			},
			dataType: 'html'
		});
	});
});

function getQueryParams(qs) {
    qs = qs.split('+').join(' ');

    var params = {},
        tokens,
        re = /[?&]?([^=]+)=([^&]*)/g;

    while (tokens = re.exec(qs)) {
        params[decodeURIComponent(tokens[1])] = decodeURIComponent(tokens[2]);
    }

    return params;
}
