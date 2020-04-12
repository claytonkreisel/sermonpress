jQuery(document).ready(function($){
	bindFilterDropDown();
});

function bindFilterDropDown(){
	jQuery('#filter-dropdown').off();
	jQuery('#filter-dropdown').on('change',function(){
		var val = jQuery(this).find('option:selected').attr('href');
		window.location = val;
	});
}
