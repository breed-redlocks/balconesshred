$(document).ready(function(){

	$('div#ftr div.icons img').first().css('display','none');
	
	//var $patch = $('<div id="patch" style=""/>'),
    //newdiv2 = document.createElement('div'),
    //existingdiv1 = document.getElementById('foo');

	if(!$('#categories')[0]){
		$('div#top').append('<div id="patch" style="position: absolute; top: 100px; left: 740px; width: 145px; background-color: rgb(142, 184, 37); height: 180px;">&nbsp;</div>');
	}
});