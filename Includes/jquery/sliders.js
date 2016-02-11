$(document).ready(function() {
	$(".slider").slider({
		range: "min",
		min: 0,
		max: 100,
		step: 1,
		create: function(event, ui)
		{
			var deviceId = this.id.split("-")[1];
			$(this).slider("option", "value", $("#slider-status-" + deviceId).html());
			$("#slider-status-" + deviceId).html($("#slider-status-" + deviceId).html() + " %");
		},
		stop: function(event, ui)
		{
			var sliderVal = ui.value;
			var deviceId = this.id.split("-")[1];
			var UnitId = deviceId.split("_")[1];			
			var name = $(this).attr("name");
			$("#slider-status-" + deviceId).html(sliderVal + " %");
			
			setStatus(UId, name, sliderVal);
		},
		slide: function(event, ui)
		{
			var sliderVal = ui.value;
			var deviceId = this.id.split("-")[1];
			$("#slider-status-" + deviceId).html(sliderVal + " %");
		}
	});
});

function setStatus(deviceId, name, status)
{
	$.ajax({
		url: "setstatus.php",
		dataType: "json",
		data: 
		{
			'deviceid': deviceId,
			'name': name,
			'level': status
		},
		error: function(jqXHR, textStatus, errorThrown) {
		},
		success: function(json)
		{
		}
	});
}
