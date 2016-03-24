
var setSectionHeights = function() {

	setTimeout( function() {
		var innerHeight = $(window).innerHeight();

		$('#middle').css({
			'min-height': innerHeight
		});
		
		$('#sidebar').css({
			'min-height': innerHeight
		});
	}, 500);
	
};

$(document).ready(function(){

	
	$('.navbar-toggle[data-toggle="side-menu"]').click( function() {
		var target = $(this).attr('data-target');

		if ($(target).hasClass('in')) {
			$('#middle').animate({
				left: 0
			}, 300);
			$(target).removeClass('in');
		}
		else {
			$('#middle').animate({
				left: 200
			}, 300);
			$(target).addClass('in');
		}
	});

	setSectionHeights();

	$(window).resize( function() {
		setSectionHeights();
	});

	$(".scroll-viewport").niceScroll(".scroll-area", {
		touchbehavior: true
	});

	// re-styling select elements
	$('select').selectpicker({
		style: '',
		size: 4
	});

	// re-styling file elements
	$(':file').filestyle({
		icon: 'fa fa-folder-open',
		classButton: 'btn btn-default'
	});

	// Init tooltip
	$('a[data-toggle="tooltip"]').tooltip({
		container: 'body'
	});

	$('.wysihtml5').wysihtml5();

	

	

	// messages
	$('.message.old').click( function() {
		$(this).toggleClass('on').find('.body').toggle();
	});


	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();
	// FullCalendar
	$('.fullcalendar').fullCalendar({
		editable: true,
		events: [
			{
				title: 'All Day Event',
				start: new Date(y, m, 1)
			},
			{
				title: 'Long Event',
				start: new Date(y, m, d-5),
				end: new Date(y, m, d-2)
			},
			{
				id: 999,
				title: 'Repeating Event',
				start: new Date(y, m, d-3, 16, 0),
				allDay: false
			},
			{
				id: 999,
				title: 'Repeating Event',
				start: new Date(y, m, d+4, 16, 0),
				allDay: false
			},
			{
				title: 'Meeting',
				start: new Date(y, m, d, 10, 30),
				allDay: false
			},
			{
				title: 'Lunch',
				start: new Date(y, m, d, 12, 0),
				end: new Date(y, m, d, 14, 0),
				allDay: false
			},
			{
				title: 'Birthday Party',
				start: new Date(y, m, d+1, 19, 0),
				end: new Date(y, m, d+1, 22, 30),
				allDay: false
			},
			{
				title: 'Click for Google',
				start: new Date(y, m, 28),
				end: new Date(y, m, 29),
				url: 'http://google.com/'
			}
		],
		header: {
			left: '',
			right: 'title'
		}
	});

	$('.weekly-agenda').fullCalendar({
		defaultView: 'agendaWeek',
		header: {
			left: '',
			right: 'title'
		},
		editable: true,
		events: [
			{
				title: 'All Day Event',
				start: new Date(y, m, 1)
			},
			{
				title: 'Long Event',
				start: new Date(y, m, d-5),
				end: new Date(y, m, d-2)
			},
			{
				id: 999,
				title: 'Repeating Event',
				start: new Date(y, m, d-3, 16, 0),
				allDay: false
			},
			{
				id: 999,
				title: 'Repeating Event',
				start: new Date(y, m, d+4, 16, 0),
				allDay: false
			},
			{
				title: 'Meeting',
				start: new Date(y, m, d, 10, 30),
				allDay: false
			},
			{
				title: 'Lunch',
				start: new Date(y, m, d, 12, 0),
				end: new Date(y, m, d, 14, 0),
				allDay: false
			},
			{
				title: 'Birthday Party',
				start: new Date(y, m, d+1, 19, 0),
				end: new Date(y, m, d+1, 22, 30),
				allDay: false
			},
			{
				title: 'Click for Google',
				start: new Date(y, m, 28),
				end: new Date(y, m, 29),
				url: 'http://google.com/'
			}
		]
	});


	$('.daily-agenda').fullCalendar({
		defaultView: 'agendaDay',
		header: {
			left: '',
			right: 'title'
		},
		editable: true,
		events: [
			{
				title: 'All Day Event',
				start: new Date(y, m, 1)
			},
			{
				title: 'Long Event',
				start: new Date(y, m, d-5),
				end: new Date(y, m, d-2)
			},
			{
				id: 999,
				title: 'Repeating Event',
				start: new Date(y, m, d-3, 16, 0),
				allDay: false
			},
			{
				id: 999,
				title: 'Repeating Event',
				start: new Date(y, m, d+4, 16, 0),
				allDay: false
			},
			{
				title: 'Meeting',
				start: new Date(y, m, d, 10, 30),
				allDay: false
			},
			{
				title: 'Lunch',
				start: new Date(y, m, d, 12, 0),
				end: new Date(y, m, d, 14, 0),
				allDay: false
			},
			{
				title: 'Birthday Party',
				start: new Date(y, m, d+1, 19, 0),
				end: new Date(y, m, d+1, 22, 30),
				allDay: false
			},
			{
				title: 'Click for Google',
				start: new Date(y, m, 28),
				end: new Date(y, m, 29),
				url: 'http://google.com/'
			}
		]
	});

	$('.calendar .view-options li a').click( function() {
		$('.calendar .view-options li').removeClass('active');
		$(this).parent('li').addClass('active');
		$(this).parents('.panel').find('.fullCalendar').fullCalendar('changeView', $(this).attr('data-view'));
		return false;
	});

	$('.calendar .navigator li a').click( function() {
		$(this).parents('.panel').find('.fullCalendar').fullCalendar($(this).attr('data-view'));
		return false;
	});


	$('.code-preview li a').click( function() {
		var $parent = $(this).parents('.panel');
		var $task = $(this).attr('href').split('#')[1];

		// prevent action if the page is same with link clicked
		if ($parent.find('div.' + $task).is(':visible')) {
			return false;
		}

		$parent.find('.panel-utility li').removeClass('active');
		$parent.find('.panel-body > div').slideUp('fast', function() {
			$parent.find('div.' + $task).slideDown('fast');
		});
		$(this).parent('li').addClass('active');
		return false;
	});


	if ($('.error-page').length) {
		setInterval( function() {
			$('.error-page')
				.find('.code')
				.toggleClass('animated')
				.toggleClass('tada');
		}, 3000);
	}

	$('#flotTip').remove();
});


