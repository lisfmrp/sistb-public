$(document).ready(function() {
	var statistic = true; // you can disable statistic
	var calendar = true; // you can disable calendar
	var fixed = true; // slider to sidebar, if false the slider will be animated when scrolling the page
	
	/* effect at the close of messages */
	$('.message').live("click",function(){
		$(this).animate({opacity: 0}, 250, function(){
			$(this).slideUp(250, function(){$(this).remove()})});
			return false;
		}
	);
	
	/* === Tables javascripts [begin] === */
	/* optional menu in the table to each row */
	$(".action").live("click", function(){
		var pos = $(this).offset();
		$(this).addClass("active").next().css({top: pos.top + 24, left: pos.left}).show().find("li:last a").css("border-bottom", 0);
		return false;
	});
	
	/* when you click to close the active optional menu */
	$("body").click(function(){
		$.each($(".action.active"), function(){
			$(this).removeClass("active").next().hide();
		});
	});
	
	/* the effect of zebra */
	$(".infotable tbody tr:odd").css({backgroundColor: "#fbfbfb"});
	
	/* Check all */
	$('.checkall').click(function() {
		$(this).parents('.infotable').find('input:checkbox').attr('checked', $(this).is(':checked')).parents("tr").each(function(){
			if($(this).find('input:checkbox').is(':checked')) $(this).addClass("selected");
			else $(this).removeClass("selected");
		});  
	});
	
	/* selection row with the active checkbox */
	$("table.infotable input:checkbox").change(function(){
		if($(this).is(':checked')) $(this).parents("tr").addClass("selected");
		else $(this).parents("tr").removeClass("selected");
	});
	/* === Tables javascripts [end] === */
	
	/* sidebar resizable params */
	var resizable_params = {
		handles: 'e', 
		minWidth: 242, 
		maxWidth: 400, 
		resize: function(event, ui) {
			var w = $(this).width()+10;
			$("#content").css("marginLeft", w+"px").parent().css("marginLeft", "-"+w+"px");
			windowResize();
			if(statistic) getStats($("#placeholder").data("stats"));
		}
	};
	$("#sidebar").resizable(resizable_params);
	
	/* === Tabs [begin] === */
	/* mouseover menu tabs script */
	$('.mainmenu ul.tabs').delegate('li:not(.current)', 'mouseover', function() {
		$(this).addClass('current').siblings().removeClass('current')
			.parents('.mainmenu').find('div.box').hide().eq($(this).index()).show();
	});
	/* usual click tabs */
	$('.tabcontent ul.tabs').delegate('li:not(.current)', 'click', function() {
		$(this).parent().find(".current").removeClass('current').parents(".tabcontent").find(".panes").children('.pane').hide().eq($(this).index()).show();//fadeIn(150);
		$("a", this).addClass('current');
		return false;
	});
	/* === Tabs [end] === */
	
	/* === Slider [begin] === */
	/* slider option */
	var stoggle = $("<a/>", {id: 'stoggle', css: {top: (($("body").height()+$(window).scrollTop()-63)/2)+"px"}});
	$("#sidebar").append(stoggle);
	/* clicks on the slider */
	$("#stoggle").toggle(function(){
		var w = $("#sidebar").width();
		$("#sidebar").css("width", 0).resizable("destroy").data("width", w);
		$(this).addClass("active").css("right", 0).wrap($("<div/>", {css: {display:'block','font-size':'0.1px',position:'absolute',zIndex:'9999',/*background:'url("images/vdivider_bg.gif") repeat-y scroll left top #E6E6E6',*/height:'100%',right:'0px',top:'0',width:'6px'}}));
		$("#content").css("marginLeft", "10px").parent().css("marginLeft", "-10px");
		$("#sbcont").hide();
		if(statistic) getStats($("#placeholder").data("stats"));
		return false;
	},function(){
		var w = parseFloat($("#sidebar").data("width"));
		$("#stoggle").css("right", "0px").unwrap();
		$("#sidebar").resizable(resizable_params).css("width", w+"px");
		$(this).removeClass("active");
		var ow = $("#sidebar").width();
		$("#content").css("marginLeft", (ow+10)+"px").parent().css("marginLeft", "-"+(ow+10)+"px");
		$("#sbcont").show();
		if(statistic) getStats($("#placeholder").data("stats"));
		return false;
	});
	/* === Slider [end] === */
	
	if(statistic) { // if the statistics are enabled
		// loading...
		$("#placeholder").append($('<div/>', {'class': 'loading', text: 'Loading...'}));
		var ltop = ($('#placeholder').height()/2-$('#placeholder .loading').height()/2)+'px';
		var lleft = ($('#placeholder').width()/2-$('#placeholder .loading').outerWidth()/2)+'px';
		$('#placeholder .loading').css({top:ltop,left:lleft}).show();
		// ajax request
		if(statistic) $.post("php/ajax.php", {get: "statistic"}, getStats, 'json');
		
		// tips when hover
		var previousPoint = null;
		$("#placeholder").live("plothover", function (event, pos, item) {
			if (item) {
				if (previousPoint != item.datapoint) {
					previousPoint = item.datapoint;
					$("#tooltip").remove();
					var date = new Date(item.datapoint[0]);
					var contents = '<span>'+dateformat(date, LANG.dateformat)+'</span><p>'+LANG["visits"]+': <strong>'+item.datapoint[1]+'</strong></p>';
					showTooltip(item.pageX, item.pageY, contents);
				}
			} else {
				$("#tooltip").remove();
				previousPoint = null;            
			}
		});
	}else{
		$("#placeholder").hide();
	}
	
	/* resize functions and events */
	windowResize();
	$(window).bind("resize", windowResize);
	$("#content").resize(windowResize);
	
	// if slider animation are enabled
	if(!fixed) {
		var $window = $(window),
			bodyHeight = $("body").height();
		$window.bind("scroll", function (){
			var scrollTop = $window.scrollTop();
			if(scrollTop+$("body").height() < $("#wrapper").height())
				$("#stoggle").stop().animate({top: scrollTop+(bodyHeight-63)/2});
			else
				$("#stoggle").stop().animate({top: scrollTop-$("#footer").outerHeight()+(bodyHeight-63)/2});
		});
	}
	
	// button script
    $('a.minibutton').bind({
		mousedown: function() {
			$(this).addClass('mousedown');
		},
		blur: function() {
			$(this).removeClass('mousedown');
		},
		mouseup: function() {
			$(this).removeClass('mousedown');
		}
	});
	$("#tooltip").live("mouseover", function(){$(this).remove();});
	if(calendar) $("#datepicker").calendar({ajaxFile: "php/handler_calendar.php"});
	else $("#datepicker").hide();
	
	// Set WYSIWYG editor
	$('.wysiwyg').wysiwyg();
});

// sending data to build a graphics
function getStats(data){
	if(!data) return false;
	if(data.stats.length > 0){
		$("#placeholder").data("stats", data);
		var d = data.stats;
		var options = {
			xaxis: { mode: "time", timeformat: "%d %b", monthNames: LANG.monthShortNames, tickSize: [7, "day"] },
			selection: { mode: "xy" },
			lines: { show: true, fill: 0.1, lineWidth: 4 },
			points: { show: true, radius: 4, fillColor: "#ffffff" },
			yaxis: { min: data.min, max: data.max, ticks: data.ticks },
			grid: { markings: weekendAreas, hoverable: true, clickable: true, labelMargin: 10, borderWidth: 1 },
			colors: ["#0077cc"], //639ecb //e03c42 // 9f9f9f // 8dceff
			shadowSize: 0
		};
		var plot = $.plot($("#placeholder"), [d], options);
		$("#placeholder").append('<div id="galogo"></div>');
	}
}

// selection weekend on the graph statistics
function weekendAreas(axes) {
	var markings = [];
	var d = new Date(axes.xaxis.min);
	// go to the first Saturday
	d.setUTCDate(d.getUTCDate() - ((d.getUTCDay() + 1) % 7));
	d.setUTCSeconds(0);
	d.setUTCMinutes(0);
	d.setUTCHours(0);
	var i = d.getTime();
	do {
		// when we don't set yaxis the rectangle automatically
		// extends to infinity upwards and downwards
		markings.push({ xaxis: { from: i, to: i + 2 * 24 * 60 * 60 * 1000 } });
		i += 7 * 24 * 60 * 60 * 1000;
	} while (i < axes.xaxis.max);
	return markings;
}

// display tooltips on the graph statistics
function showTooltip(x, y, contents) {
	$('<div id="tooltip" class="tooltip"><div class="tcont-1"><div class="tcont-2"><div class="tcont-3">' + contents + '</div></div></div></div>').appendTo("body").css( {
		top: y - 20,
		left: x - $("#tooltip").width() - 10
	});
	if((x - $("#tooltip").width()) < $("#placeholder").offset().left) $("#tooltip").css({left: x + 10}).fadeIn(200);
	else $("#tooltip").fadeIn(200);
}

// low-powered like formatting dates 
function dateformat(date, format){
	return format.replace(/(Y|y|M|F|m|j|D|l|d)/g,
		function($1){
			switch ($1){
				case 'Y': return date.getFullYear();
				case 'y': var f = date.getFullYear()+"";
					return f.substr(2,4);
				case 'F': return LANG["monthFullNames"][date.getMonth()];
				case 'M': return LANG["monthShortNames"][date.getMonth()];
				case 'm': return (date.getMonth() < 9 ? '0' : '') + (date.getMonth() + 1);
				case 'j': return date.getDate();
				case 'D': return LANG['daysOfWeekShort'][date.getDay()];
				case 'l': return LANG['daysOfWeek'][date.getDay()];
				case 'd': return  (date.getDate() < 10 ? '0' : '') + date.getDate();
			}
		}
	);
}

// function is triggered when resizing the lateral columns and columns
// with content need to specify a minimum height of the sidebar and 
// regulating the minimum height in the rubber blocks with the same height
function windowResize(){
	var wrap = $("#wrapper"),
		wrapheight = $("#wrapper").height(),
		contheight = $("#page-body .container").height(),
		sbcontHeight = $("#sbcont").outerHeight();
	if(contheight < sbcontHeight) contheight = sbcontHeight;
	if($("body").height() >= contheight + $("#footer").outerHeight()){
		var wrapheight_new = $("body").height()-$("#footer").outerHeight();
		wrap.css("min-height", wrapheight_new);
		$("#sidebar").css({"min-height": wrapheight_new});
	}else $("#sidebar").css({"min-height": contheight});
	boxEqualHeights();
}

function boxEqualHeights(){
	$(".container_6").each(function(){
		equalHeight($(".box-3", this));
	});
}

// function of the same height group of objects
function equalHeight(group) {
	var maxHeight = 0;
	group.css("min-height", 0).each(function() {
		var elHeight = $(this).height();
		if(elHeight > maxHeight) maxHeight = elHeight;
	});
	group.css("min-height", maxHeight);
}