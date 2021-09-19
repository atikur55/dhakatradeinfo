//Progress Script
let options = {
	startAngle: -1.55,
	size: 150,
	value: 0.90,
	fill: {gradient: ['#B74614', '#e96932']}
  }
  $(".circle .bar").circleProgress(options).on('circle-animation-progress',
  function(event, progress, stepValue){
	$(this).parent().find("span").text(String(stepValue.toFixed(2).substr(2)) + "%");
  });
  $(".js .bar").circleProgress({
	value: 0.75
  });
  $(".react .bar").circleProgress({
	value: 0.85
  });