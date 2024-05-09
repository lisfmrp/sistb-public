(function($){
	$.fn.calendar = function(options){
		// defaults
		var options = jQuery.extend({
			activeDay: false, // default do not select any day; activeDay: '2010-06-22',
			ajaxFile: '/handler_calendar.php', // file to send ajax requests
			path: '/#DATE#/' // URL template; for example: "/news/#DATE#/"
		}, options);
		var cache_days = new Array();
		var curr_date = null;
		var is_hide = null;
		var is_first = true;
		var ajax_exec = false;
		return this.each(function(){
			var j = jQuery;
			var today = new Date();
			var year = today.getFullYear();
			var month = today.getMonth()+1;
			loadMonthCalendar(year, month);
		});
		function createCalendar(){
			/*
			You can find more documentation http://jqueryui.com/demos/datepicker/
			*/
			$("#datepicker .calendar").datepicker({
				dateFormat: 'yy-mm-dd',
				firstDay: 1,
				gotoCurrent: false,
				isRTL: false,
				hideIfNoPrevNext: true,
				shortYearCutoff: 20,
				minDate: new Date(2010, 0, 01),
				maxDate: getMaxDate(),
				onChangeMonthYear: function(year, month, inst){
					curr_date = year+'-'+addZero(month);
					if(is_first) return false;
					if(ajax_exec) return false;
					loadMonthCalendar(year, month);
				},
				onSelect: function(dateText, inst){
					year = dateText.substr(0,4);
					month = dateText.substr(5,2);
					day = dateText.substr(8,2);
					if(typeof(cache_days[year+'-'+month])=='object'){
						if(in_array(day, cache_days[year+'-'+month])){
							var path = options.path;
							// here you can handle ajax request if you do not want to transition to other pages
							/*
							location.href = path.replace("#DATE#", year+'-'+month+'-'+day);
							*/
						}
					}
					return false;
				},
				beforeShowDay: function(date){
					this_day = date.getFullYear()+'-'+addZero(date.getMonth() + 1)+'-'+addZero(date.getDate());
					var ret = [false, '', ''];
					if(is_hide) return ret;
					is_other = (date.getFullYear()+'-'+addZero(date.getMonth() + 1) != curr_date);
					is_week_end = (date.getDay() == 6 || date.getDay() == 0);
					is_selected = (this_day == options.activeDay);
					is_href = in_array(date.getDate(), cache_days[date.getFullYear()+'-'+addZero(date.getMonth()+1)]);
					if(is_other){
						// other month
						ret[0] = false;
						ret[1] = 'selected';
					}else if(is_week_end && !is_selected){
						ret[0] = is_href;
						ret[1] = 'week-end';
					}else if(!is_week_end && is_selected){
						ret[0] = false;
						ret[1] = 'selected';
					}else if(!is_week_end && !is_selected){
						ret[0] = is_href;
						ret[1] = 'weekday';
					}
					return ret;
				}
			});
		}
		function loadMonthCalendar(year, month){
			ajax_exec = true;
			if(typeof(cache_days[year+'-'+addZero(month)])=='object'){
				// if the request was repeated and the desired results of the query are in the cache
				showCalendar();
				createCalendar();
				ajax_exec = false;
			}else{
				// If such a request has not yet been
				hideCalendar();
				destroyCalendar();
				$.post(options.ajaxFile, {year: year, month: month}, function(data){
					// ajax request and data caching
					cache_days[data.year+'-'+data.month] = data.days;
					curr_date = year+'-'+addZero(month);
					showCalendar();
					createCalendar();
					ajax_exec = false;
					if(is_first){
						is_first = false;
						$("#datepicker .calendar").datepicker('setDate', new Date(year, month - 1, 6));
					}else{
						$("#datepicker .calendar").datepicker('setDate', new Date(year, month - 1, 1));
					}
				}, 'json');
			}
		}
		function in_array(val, ar){ // search value in array, for cache
			if(typeof(ar) != 'object' || !ar || !ar.length) return false;
			for (key in ar) if(val == ar[key]) return true;
			return false;
		}
		function addZero(str){
			if(typeof(str) != 'string') str = str.toString();
			return str.length < 2 ? '0'+str: str;
		}
		function getMaxDate(){
			// returns the last day of next month
			var today = new Date();
			var today_year = today.getFullYear();
			var today_month = today.getMonth()+1;
			var dayCount = new Date(today_year, today_month + 1, 0).getDate();
			return new Date(today_year, today_month, dayCount);
		}
		function destroyCalendar(){
			$("#datepicker .calendar").datepicker("destroy");
		}
		function hideCalendar(){
			is_hide = true;
			$("#datepicker .content").css('display','block');
			$("#datepicker .calendar").css('display','none');
		}
		function showCalendar(){
			is_hide = false;
			$("#datepicker .content").css('display','none');
			$("#datepicker .calendar").css('display','block');
		}
	};
})(jQuery);