function loadPage(url) {  
    obj = $('main');
    obj.load(url + '?ajax');
}

$(function() {
	var bar = $('.determinate');
	var result = $('.result');
	var percent = $('.percent');
	var progress = $('.progress');
	var progressbar = $('.progressbar');
	$('#upload').ajaxForm({
		beforeSubmit: function() {
			progressbar.css('display', 'block');
			var current = '0%';
			bar.width(current);
			percent.html(current);
		},
		uploadProgress: function(event, position, total, total) {
			if (20 === total) {
				progress.removeClass('red darken-3');
				progress.addClass('red darken-2');
			} else if (40 === total) {
				progress.removeClass('red darken-2');
				progress.addClass('blue');
			} else if (60 === total) {
				progress.removeClass('blue');
				progress.addClass('green darken-2');
			} else if (80 === total) {
				progress.removeClass('green darken-2');
				progress.addClass('green');
			}
			var current = total + '%';
			bar.width(current);
			percent.html(current);
		},
		success: function() {
			var current = '100%';
			bar.width(current);
			percent.html(current);
		},
		complete: function(xhr) {
			result.html(xhr.responseText);
		}
	}); 
});

$(document).ready(function(){
	$('.sidenav').sidenav(),
	$('a[rel="dyn"]').bind("click", function(event) {
        url = $(this).attr('href');
        loadPage(url);
        event.preventDefault();
        event.stopPropagation();
    });
});