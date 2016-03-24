function getRandomData() {
	if (data.length > 0) {
		data = data.slice(1);
	}
	while (data.length < totalPoints) {
		var prev = data.length > 0 ? data[data.length - 1] : 50,
			y = prev + Math.random() * 10 - 5;
		if (y < 0) {
			y = 0;
		} else if (y > 100) {
			y = 100;
		}
		data.push(y);
	}
	var res = [];
	for (var i = 0; i < data.length; ++i) {
		res.push([i, data[i]]);
	}

	return res;
}

$(document).ready( function() {

	if ($('#sparkline-graph2').length) {
		$("#sparkline-graph2").sparkline('html', {
			type: 'bar',
			height: '100',
			barWidth: 5,
			barColor: '#ff7f00',
			negBarColor: '#bf0000'
		});
	}

	if ($('#sparkline-graph3').length) {
		$("#sparkline-graph3").sparkline('html', {
			type: 'bar',
			height: '100',
			barWidth: 5,
			barColor: '#00bfbf',
			negBarColor: '#bf0000'
		});
	}

	if ($('#sparkline-graph4').length) {
		$("#sparkline-graph4").sparkline('html', {
			type: 'bar',
			height: '100',
			barWidth: 5,
			barColor: '#00bf5f',
			negBarColor: '#bf0000'
		});
	}

	if ($('#sparkline-graph5').length) {
		$("#sparkline-graph5").sparkline('html', {
			type: 'bar',
			height: '100',
			barWidth: 5,
			barColor: '#009cff',
			negBarColor: '#bf0000'
		});
	}


	// sample browser graph
	if ($('#browser_graph').length) {

		var data_firefox = [
			[new Date('08/02/2012').getTime(), 32],
			[new Date('08/03/2012').getTime(), 40],
			[new Date('08/04/2012').getTime(), 45],
			[new Date('08/05/2012').getTime(), 38],
			[new Date('08/06/2012').getTime(), 56],
			[new Date('08/07/2012').getTime(), 64],
			[new Date('08/08/2012').getTime(), 55]
		];
		var data_chrome = [
			[new Date('08/02/2012').getTime(), 67],
			[new Date('08/03/2012').getTime(), 44],
			[new Date('08/04/2012').getTime(), 39],
			[new Date('08/05/2012').getTime(), 51],
			[new Date('08/06/2012').getTime(), 55],
			[new Date('08/07/2012').getTime(), 62],
			[new Date('08/08/2012').getTime(), 49]
		];
		var data_safari = [
			[new Date('08/02/2012').getTime(), 29],
			[new Date('08/03/2012').getTime(), 26],
			[new Date('08/04/2012').getTime(), 54],
			[new Date('08/05/2012').getTime(), 38],
			[new Date('08/06/2012').getTime(), 35],
			[new Date('08/07/2012').getTime(), 19],
			[new Date('08/08/2012').getTime(), 66]
		];
		var data_iexplorer = [
			[new Date('08/02/2012').getTime(), 33],
			[new Date('08/03/2012').getTime(), 30],
			[new Date('08/04/2012').getTime(), 24],
			[new Date('08/05/2012').getTime(), 25],
			[new Date('08/06/2012').getTime(), 19],
			[new Date('08/07/2012').getTime(), 21],
			[new Date('08/08/2012').getTime(), 23]
		];

		var options = {
			grid: {
				clickable: true,
				hoverable: true,
				autoHighlight: true,
				backgroundColor: null,
				borderWidth: 0,
				color: "#666",
				labelMargin: 10,
				axisMargin: 0,
				mouseActiveRadius: 10,
				minBorderMargin: 5
			},
			series: {
				lines: {
					show: true,
					lineWidth: 3,
					steps: false
				},
				points: {
					show:true,
					radius: 4,
					symbol: "circle",
					fill: true
				}
			},
			tooltip: true,
			tooltipOpts: {
				content: "%x - Visitor: %y",
				shifts: {
					x: 10,
					y: 0
				},
				defaultTheme: true
			},
			xaxis: {
				mode: "time",
				minTickSize: [1, "day"],
				timeformat: "%d-%m",
				labelWidth: "40"
			},
			yaxis: { min: 10, max: 80 },
			legend: {
				//noColumns: 0,
				position: "ne"
			},
			colors: ["#ff9900", "#cccc00", "#66cc33", "#0066cc"],
			shadowSize: 0
		};

		$.plot($('#browser_graph'),[
		{
			label: "Mozilla Firefox",
			data: data_firefox,
			points: {
				fillColor: '#fff'
			}
		},
		{
			label: "Google Chrome",
			data: data_chrome,
			points: {
				fillColor: '#fff'
			}
		},
		{
			label: "Apple Safari",
			data: data_safari,
			points: {
				fillColor: '#fff'
			}
		},
		{
			label: "Internet Explorer",
			data: data_iexplorer,
			points: {
				fillColor: '#fff'
			}
		}
		], options);
	}

	// sample browser graph
	if($('#visitor_graph').length) {

		var visitors = [
			[new Date('10/02/2012').getTime(), 890],
			[new Date('10/03/2012').getTime(), 920],
			[new Date('10/04/2012').getTime(), 760],
			[new Date('10/05/2012').getTime(), 701],
			[new Date('10/06/2012').getTime(), 883],
			[new Date('10/07/2012').getTime(), 992],
			[new Date('10/08/2012').getTime(), 1073],
			[new Date('10/09/2012').getTime(), 782],
			[new Date('10/10/2012').getTime(), 550],
			[new Date('10/11/2012').getTime(), 773],
			[new Date('10/12/2012').getTime(), 904],
			[new Date('10/13/2012').getTime(), 1031],
			[new Date('10/14/2012').getTime(), 1373],
			[new Date('10/15/2012').getTime(), 1420],
			[new Date('10/16/2012').getTime(), 1190],
			[new Date('10/17/2012').getTime(), 1293],
			[new Date('10/18/2012').getTime(), 995],
			[new Date('10/19/2012').getTime(), 1163],
			[new Date('10/20/2012').getTime(), 875],
			[new Date('10/21/2012').getTime(), 899],
			[new Date('10/22/2012').getTime(), 934],
			[new Date('10/23/2012').getTime(), 1004],
			[new Date('10/24/2012').getTime(), 1299],
			[new Date('10/25/2012').getTime(), 1478],
			[new Date('10/26/2012').getTime(), 1533],
			[new Date('10/27/2012').getTime(), 1566],
			[new Date('10/28/2012').getTime(), 1593],
			[new Date('10/29/2012').getTime(), 1411],
			[new Date('10/30/2012').getTime(), 1329],
			[new Date('10/31/2012').getTime(), 870]
		];

		var opts = {
			grid: {
				clickable: true,
				hoverable: true,
				autoHighlight: true,
				backgroundColor: null,
				borderWidth: 0,
				color: "#666",
				labelMargin: 10,
				axisMargin: 0,
				mouseActiveRadius: 10,
				minBorderMargin: 5
			},
			series: {
				lines: {
					show: true,
					lineWidth: 3,
					steps: false,
					fill: true
				},
				points: {
					show:true,
					radius: 4,
					symbol: "circle",
					fill: true
				}
			},
			tooltip: true,
			tooltipOpts: {
				content: "%y visitors",
				shifts: {
					x: 20,
					y: 0
				},
				defaultTheme: false
			},
			xaxis: {
				mode: "time",
				minTickSize: [1, "day"],
				timeformat: "%d/%m",
				labelWidth: "10"
			},
			yaxis: { min: 0 },
			legend: {
				noColumns: 0,
				position: "ne"
			},
			colors: ["#02b7de"],
			shadowSize: 0
		};

		$.plot($('#visitor_graph'), [
		{
			label: "Visitors",
			data: visitors,
			points: {fillColor: '#fff'},
			lines: {fillColor: 'rgba(2, 183, 222, 0.2)'}
		}
		], opts);
	}


	if ($('#vector_map').length) {
		var data = {
			"US": 2320,
			"BR": 1945,
			"IN": 1779,
			"AU": 1486,
			"TR": 1024,
			"CN": 753,
			"JP": 892,
			"ID": 986
		};

		$('#vector_map').vectorMap({
			map: 'world_mill_en',
			zoomButtons : false,
			backgroundColor: 'transparent',
			regionStyle: {
				initial: {
					fill: '#c4c4c4'
				},
				hover: {
					"fill-opacity": 1
				}
			},
			series: {
				regions: [{
					values: data,
					scale: ['#b0e2fc', '#78caf5', '#40a8de', '#0d85c3'],
					normalizeFunction: 'polynomial'
				}]
			},
			onRegionLabelShow: function(e, el, code) {
				if(typeof data[code] === 'undefined') {
					e.preventDefault();
				} else {
					var countryLabel = data[code];
					el.html(el.html()+': '+countryLabel+' visits');
				}
			}
		});

		var map = $("#vector_map").vectorMap('get', 'mapObject');
		var currentScale = 1;

		$('.zoomin').click( function() {
			if (currentScale <= 5) {
				currentScale += 0.5;
				map.setScale(currentScale);
			}
			return false;
		});

		$('.zoomout').click( function() {
			if (currentScale > 1 && currentScale <= 6) {
				currentScale -= 0.5;
				map.setScale(currentScale);
			}
			return false;
		});
	}


	

	$('.inlinebar').sparkline('html', {
		type: 'bar', 
		barColor: '#468847',
		lineWidth: 1,
		height: "20px",
	});
	$('.inlinebar2').sparkline('html', {
		type: 'bar', 
		barColor: '#ea4519',
		lineWidth: 1,
		height: "20px",
	});
	$('.inlineline').sparkline('html', {
		type: 'line', 
		barColor: '#468847',
		lineWidth: 1,
		height: "20px",
		lineColor: '#82b721',
		fillColor: '#fff',
		width:"50px",
	});
	$('.inlineline2').sparkline('html', {
		type: 'line', 
		barColor: '#1386f2',
		lineWidth: 1,
		height: "20px",
		lineColor: '#1386f2',
		fillColor: '#b5d8f8',
		width:"50px",
	});
	$(".small-chart .inlineline").sparkline([5,6,7,9,9,5,3,2,0,4,6,7], {
		type: 'line',
		width: '150px',
		height: '100px',
		lineColor: '#82b721',
		fillColor: '#538115',
		lineWidth: 5,
		spotColor: '#95c535',
		minSpotColor: '#95c535',
		maxSpotColor: '#95c535',
		highlightSpotColor: '#333',
		highlightLineColor: '#000',
		spotRadius: 6,
		normalRangeColor: '#111',
		drawNormalOnTop: false
	});

	$(".small-chart .inlinebar").sparkline([5,6,7,2,0,-4,-2,-6], {
		type: 'bar',
		height: '100',
		barColor: '#4fa950',
		negBarColor: '#ce483d',
		stackedBarColor: '#FFA93C',
		barWidth: 10,
		barSpacing: 3,
		nullColor: '#aaa'
	});
	$('.small-chart .inlinestackbar').sparkline([ [1,4], [2,2], [2, 4], [5, 2], [3, 5], [4, 1] ], { type: 'bar',
		height: '100',
		barWidth: 10,
		barSpacing: 3,
		stackedBarColor: ['#00aced','#ce483d','#FFA93C','#4fa950']
	});

	$(".small-chart .inlinepie").sparkline([1,1,2,5], {
		type: 'pie',
		width: '100px',
		height: '100px',
		sliceColors: ['#00aced','#ce483d','#FFA93C','#4fa950'],
		offset: 0
	});

	function examplesGraph () {
		var d1 = [];
		for (var i = 0; i <= 10; i += 1) { d1.push([i, parseInt(Math.random() * 30)]); }
		var d2 = [];
		for (var i = 0; i <= 10; i += 1) { d2.push([i, parseInt(Math.random() * 30)]); }
		var d3 = [];
		for (var i = 0; i <= 10; i += 1) { d3.push([i, parseInt(Math.random() * 30)]); }
		var d4 = [];
		for (var i = 0; i <= 10; i += 1) { d4.push([i, parseInt(Math.random() * 30)]); }

		var e1 =[];
		for (var i = 0; i <= 7; i += 1) { e1.push([i, parseInt(Math.random() * 30)]); }

		var colors = [ "#008A17", "#0072C6",  "#FFA93C", "#AC193D"];
		var stack = 1,
			bars = true,
			lines = false,
			steps = false;
		
		function graphLine () {
			$.plot(
				$("#flot-line"), [ e1], {
					xaxis: {
						font: {
							color: "#555",
						}
					},
					yaxis: {
						font: {
							color: "#555",
						}
					},
					series: {
						lines: { 
							show: true,
							lineWidth: 5,
							fill: false,
						},
						points: { 
							show: false,
							lineWidth: 7
						},
					},
					grid: {
						clickable: true,
						hoverable: true,
						autoHighlight: true,
						mouseActiveRadius: 10,
						aboveData: true,
						color: "rgba(0,0,0,0.4)",
						borderWidth: 0,
						minBorderMargin: 25,
					},
					colors: ["#0072C6"],
					shadowSize: 0,
				}
			);
		}
		function graphLineFilled () {
			$.plot (
				$("#flot-line-filled"), [ d1, d2 ], {
					xaxis: {
						font: {
							color: "#ccc",
							size: 11,
						}
					},
					yaxis: {
						font: {
							color: "#ccc",
							size: 11,
						}
					},
					series: {
						lines: { 
							show: true,
							lineWidth: 5,
							fill: .8,
						},
						points: { 
							show: true,
							radius: 0,
						},
					},
					grid: {
						clickable: true,
						hoverable: true,
						autoHighlight: true,
						mouseActiveRadius: 10,
						aboveData: true,
						borderWidth: 0,
						minBorderMargin: 25,
					},
					colors: colors,
					shadowSize: 0,
				}
			);
		}
		function graphLineStacked (){
			$.plot (
				$("#flot-line-stacked"), [ d1, d2, d3 ], {
					xaxis: {
						font: {
							color: "#fff",
							size: 11,
						}
					},
					yaxis: {
						font: {
							color: "#fff",
							size: 11,
						}
					},
					series: {
						stack: stack,
						lines: { 
							show: true,
							lineWidth: 5,
							fill: .8,
							steps: steps
						},
						points: { 
							show: true,
							radius: 0,
						},
					},
					grid: {
						clickable: true,
						hoverable: true,
						autoHighlight: true,
						mouseActiveRadius: 10,
						aboveData: true,
						borderWidth: 0,
						minBorderMargin: 25,
					},
					colors: colors,
					shadowSize: 0,
				}
			);
		}
		function graphBars() {
			$.plot(
				$("#flot-bars"), [ e1], {
					xaxis: {
						font: {
							color: "#555"
						}
					},
					yaxis: {
						font: {
							color: "#555"
						}
					},
					series: {
						bars: { 
							show: true,
							lineWidth: 5,
							fill: false,
						},
						points: { 
							show: false,
						},
					},
					grid: {
						clickable: true,
						hoverable: true,
						autoHighlight: true,
						mouseActiveRadius: 10,
						aboveData: true,
						color: "rgba(0,0,0,0.4)",
						borderWidth: 0,
						minBorderMargin: 25,
					},
					colors: ["#0072C6"],
					shadowSize: 0,
				}
			);
		}
		function graphBarsFilled() {
			$.plot (
				$("#flot-bars-filled"), [ d1, d2 ], {
					xaxis: {
						font: {
							color: "#555",
							size: 11,
						}
					},
					yaxis: {
						font: {
							color: "#555",
							size: 11,
						}
					},
					series: {
						bars: { 
							show: true,
							lineWidth: 1,
							fill: .8,
						},
						points: { 
							show: true,
							radius: 0,
						},
					},
					grid: {
						clickable: true,
						hoverable: true,
						autoHighlight: true,
						mouseActiveRadius: 10,
						aboveData: true,
						borderWidth: 0,
						minBorderMargin: 25,
					},
					colors: colors,
					shadowSize: 0,
				}
			);
		}
		function graphBarsStacked() {
			$.plot (
				$("#flot-bars-stacked"), [ d1, d2, d3 ], {
					xaxis: {
						font: {
							color: "#555",
							size: 11,
						}
					},
					yaxis: {
						font: {
							color: "#555",
							size: 11,
						}
					},
					series: {
						stack: stack,
						bars: { 
							show: true,
							lineWidth: 1,
							fill: .8,
							steps: steps
						},
						points: { 
							show: true,
							radius: 0,
						},
					},
					grid: {
						clickable: true,
						hoverable: true,
						autoHighlight: true,
						mouseActiveRadius: 10,
						aboveData: true,
						borderWidth: 0,
						minBorderMargin: 25,
					},
					colors: colors,
					shadowSize: 0,
				}
			);
		}
		function graphSinCosTan() {
			var sin = [];
			for (var i = 0; i < Math.PI * 2; i += 0.25) { sin.push([i, Math.sin(i)]); }

			var cos = [];
			for (var i = 0; i < Math.PI * 2; i += 0.25) { cos.push([i, Math.cos(i)]); }

			var tan = [];
			for (var i = 0; i < Math.PI * 2; i += 0.1) { tan.push([i, Math.tan(i)]); }
			$.plot("#flot-sincostan", [
					{ label: "sin(x)", data: sin },
					{ label: "cos(x)", data: cos },
					{ label: "tan(x)", data: tan }
				], 
			{
				series: {
					lines: { show: true },
					points: {
						show: true,
						lineWidth: 5
					}
				},
				xaxis: {
					ticks: [
						0, [ Math.PI/2, "\u03c0/2" ], [ Math.PI, "\u03c0" ],
						[ Math.PI * 3/2, "3\u03c0/2" ], [ Math.PI * 2, "2\u03c0" ]
					],
					font: {
						color: "#555",
						size: 11,
					}
				},
				yaxis: {
					ticks: 10,
					min: -2,
					max: 2,
					tickDecimals: 3,
					font: {
						color: "#555",
						size: 11,
					}
				},
				grid: {
					borderWidth: 0,
					minBorderMargin: 25,
				},
				legend: {
					backgroundColor: "#fff",
					backgroundOpacity: "1"
				},
				colors : colors,
			});
		}
		function graphRealtime() {
			var data = [],
				totalPoints = 300;
			
			var updateInterval = 30;
			$("#updateInterval").val(updateInterval).change(function () {
				var v = $(this).val();
				if (v && !isNaN(+v)) {
					updateInterval = +v;
					if (updateInterval < 1) {
						updateInterval = 1;
					} else if (updateInterval > 2000) {
						updateInterval = 2000;
					}
					$(this).val("" + updateInterval);
				}
			});

			var plot = $.plot("#flot-realtime", [ getRandomData() ], {
				series: {
					shadowSize: 0,
				},
				yaxis: {
					min: 0,
					max: 100,
					font: {
						color: "#555",
						size: 11,
					}
				},
				xaxis: {
					show: false,
					font: {
						color: "#555",
						size: 11,
					}
				},
				grid: {
					borderWidth: 0,
					minBorderMargin: 25,
				},
				colors: ["#0072C6"],
				shadowSize: 0,
			});

			function update() {
				plot.setData([getRandomData()]);
				plot.draw();
				setTimeout(update, updateInterval);
			}

			update();
		}
		graphLineFilled();
		graphLine();
		graphLineStacked();
		graphBars();
		graphBarsFilled();
		graphBarsStacked();
		graphSinCosTan();
		graphRealtime();
	}
	examplesGraph();

});