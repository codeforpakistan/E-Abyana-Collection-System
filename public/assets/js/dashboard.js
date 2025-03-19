$(function() {
	/*---ChartJS (#widgetChart1)---*/
    var ctx = document.getElementById( "widgetChart1" );
    ctx.height = 70;
    var myChart = new Chart( ctx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            type: 'line',
            datasets: [ {
                data: [1, 18, 9, 17, 34, 22, 11],
                label: 'Marketcap',
                backgroundColor: 'transparent',
                borderColor: '#4880FF',
            }, ]
        },
        options: {

            maintainAspectRatio: false,
            legend: {
                display: false
            },
            responsive: true,
            tooltips: {
                mode: 'index',
                titleFontSize: 12,
                titleFontColor: '#fff',
                bodyFontColor: '#fff',
                backgroundColor: '#000',
                cornerRadius: 3,
                intersect: false,
            },
            scales: {
                xAxes: [ {
                    gridLines: {
                        color: 'transparent',
                        zeroLineColor: 'transparent'
                    },
                    ticks: {
                        fontSize: 2,
                        fontColor: 'transparent'
                    }
                } ],
                yAxes: [ {
                    display:false,
                    ticks: {
                        display: false,
                    }
                } ]
            },
            title: {
                display: false,
            },
            elements: {
                line: {
                    borderWidth: 3
                },
                point: {
                    radius: 4,
                    hitRadius: 10,
                    hoverRadius: 4
                }
            }
        }
    } );
	/*---ChartJS (#widgetChart1) closed---*/

	/*---ChartJS (#widgetChart2)---*/
	var ctx = document.getElementById( "widgetChart2" );
    ctx.height = 70;
    var myChart = new Chart( ctx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            type: 'line',
            datasets: [ {
                data: [2, 4, 3, 4, 7, 5, 4, 3, 5, 6, 2],
                label: 'Marketcap',
                backgroundColor: 'transparent',
                borderColor: '#f47b25',
            }, ]
        },
        options: {

            maintainAspectRatio: false,
            legend: {
                display: false
            },
            responsive: true,
            tooltips: {
                mode: 'index',
                titleFontSize: 12,
                titleFontColor: '#fff',
                bodyFontColor: '#fff',
                backgroundColor: '#000',
               cornerRadius: 3,
                intersect: false,
            },
            scales: {
                xAxes: [ {
                    gridLines: {
                        color: 'transparent',
                        zeroLineColor: 'transparent'
                    },
                    ticks: {
                        fontSize: 2,
                        fontColor: 'transparent'
                    }
                } ],
                yAxes: [ {
                    display:false,
                    ticks: {
                        display: false,
                    }
                } ]
            },
            title: {
                display: false,
            },
            elements: {
                line: {
                    borderWidth: 3
                },
                point: {
                    radius: 4,
                    hitRadius: 10,
                    hoverRadius: 4
                }
            }
        }
    });
	/*---ChartJS (#widgetChart2) closed---*/

	/*----Echart2----*/
	var chartdata = [{
		name: 'Last price',
		type: 'bar',
		data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
	},
	{
		name: 'Daily change',
		type: 'line',
		smooth: true,
		symbolSize:10,
		data: [45.0, 66.9, 99.5, 114.5, 128.2, 156.5, 125.2, 130.5, 200.3, 180.3, 80.9, 49.6],
		 itemStyle: {
                    normal: {
                        lineStyle: {
                            width: 3
                        }
                    }
                },
	}];
	
	var chart = document.getElementById('echart1');
	var barChart = echarts.init(chart);
	var option = {
		xAxis: {
			data: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
			axisLine: {
				lineStyle: {
					color: '#ececff'
				}
			},
			axisLabel: {
				fontSize: 0,
				color: '#',
				
			},
		}, 
		grid: {
			top: '20',
			bottom: '20',
		    backgroundColor:'#ccc'
		},
			gridLines: {
			  color: 'rgba(142, 156, 173,0.1)',
			  lineWidth: 1
			},
		tooltip: {
			show: true,
			showContent: true,
			alwaysShowContent: true,
			triggerOn: 'mousemove',
			trigger: 'axis',
			axisPointer: {
				label: {
					show: true,
				}
			}
		},
		yAxis: [{
		    name: 'Last Price',
			color:'#9ca1b9',
			nameLocation: 'middle',
			nameGap: 50,
			splitLine: {
				lineStyle: {
					color: 'rgba(142, 156, 173,0.1)'
				}
			},
			gridLines: {
			  color: 'rgba(142, 156, 173,0.1)',
			  lineWidth: 1
			},
			axisLabel: {
				fontSize: 10,
				color: '#4880FF'
			}  
		},
		{
			data: ['0','80','160','240','320','400'],
		    name: 'Last Price',
			color:'#9ca1b9',
			nameLocation: 'middle',
			nameGap: 50,
			axisLine: {
				 show: true,
				 textStyle: {
					color: '#4880FF'
				} 
			},
			axisLabel: {
				fontSize: 10,
				color: '#9ca1b9'
			}  
		}],
		series: chartdata,
		color: ['#4880FF', '#f3a774', '#4880FF', ]
		
	};
	barChart.setOption(option);
	
	
 
 /*----Echart3----*/
 var chartdata = [{
		name: 'Hourly ,Position ,Values',
		type: 'area',
		smooth: false,
		data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
	}];
	
    var chart = document.getElementById('revenue-chart');
	var areaChart = echarts.init(chart);
	var option;
		
option = {
    xAxis: {
        type: 'category',
        boundaryGap: false,
        data: ['1980', '1985', '1990', '1995', '2000', '2005', '2010'],
		axisLine: {
			lineStyle: {
				color: '#ececff'
			}
		},
		    name: ' Hourly Position Values',
			color:'#9ca1b9',
			fontSize: 50,
			nameLocation: 'middle',
			nameGap: 50,
			splitLine: {
				lineStyle: {
					color: 'rgba(142, 156, 173,0.1)'
				}
			},
		axisLabel: {
			fontSize: 10,
			color: '#9ca1b9'
		}
    }, 
	tooltip: {
		show: true,
		showContent: true,
		alwaysShowContent: true,
		triggerOn: 'mousemove',
		trigger: 'axis',
		axisPointer: {
			label: {
				show: false,
			}
		}
	},
    yAxis: {
		boundaryGap: ['100%', '0%'],
		splitLine: {
			lineStyle: {
				color: '#ececff',
				labelFontColor: "green"
			}
		},
			title: {
				text: 'values',
				labelFontColor:'#000',
			},
		axisLine: {
			lineStyle: {
				color: '#ececff',
				labelFontColor: "green"
			}
		},
		axisLabel: {
			fontSize: 10,
			color: '#9ca1b9',
			labelFontColor: "green"
		},
		name: 'Values',
		nameLocation: 'middle',
		nameGap: 50,
		fontColor: '#000',
		labelFontColor: "green",
		color: '#ececff',
			splitLine: {
				lineStyle: {
					color: 'rgba(142, 156, 173,0.1)'
				}
			},
			gridLines: {
			  color: 'rgba(142, 156, 173,0.1)',
			  lineWidth: 1
			},
			
	},
    series:[{
        data: [400, 400, 400, 300, 400, 500, 600],
        type: 'line',
        itemStyle: {normal: {areaStyle: {type: 'default'}}},
		name:'simulation data',
		smooth:true,
		symbol: 'none',
		sampling: 'average',
		itemStyle: {
			normal: {
                    color: 'rgb(118, 115, 230)'
                }
            },
			areaStyle: {
                normal: {
                    color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                        offset: 0,
                        color: 'rgb(118, 115, 230)'
                    }, {
                        offset: 1,
                        color: 'rgb(118, 115, 230)'
                    }])
                }
            }

    }]
};
option && areaChart.setOption(option);
 /*----Echart3----*/
 




   

});