var modeconfig;

$(document).ready(function() {
	mode($('#met').val());
	
	setInterval(function() {
		$.ajax({
			url: 'logs-2.txt',
			type: 'GET',
			cache: false,
			success: function (response) {
				$("#log").val(response);
			}
		});
	}, 1000);
});

function start() {
	$.ajax({
		url: 'api.php',
		type: 'POST',
		data: {
			action: 'start'
		},
		beforeSend: function () {
			$('#start').html('<span class="spinner-border spinner-border-sm"></span> Start').attr('disabled', true);
			$('#stop').attr('disabled', true);
			$('#autoBootRecon').attr('disabled', true);
			$("#log").val("");
		},
		success: function (response) {
			$('#start').html('Start');
			$('#stop').attr('disabled', false);
			$('#autoBootRecon').attr('disabled', false);
			$("#log").val(response);
		}
	});
}

function stop() {
	$.ajax({
		url: 'api.php',
		type: 'POST',
		data: {
			action: 'stop'
		},
		beforeSend: function () {
			$('#start').attr('disabled', true);
			$('#stop').html('<span class="spinner-border spinner-border-sm"></span> Stop').attr('disabled', true);
			$('#autoBootRecon').attr('disabled', true);
			$("#log").val("");
		},
		success: function (response) {
			$('#start').attr('disabled', false);
			$('#stop').html('Stop').attr('disabled', false);
			$('#autoBootRecon').attr('disabled', false);
			$("#log").val(response);
		}
	});
}

function saveConfig() {
    var met = $('#met').val();
	var pillstl = $('#pillstl').val();
	var host = $('#host').val();
	var port = $('#port').val();
	var udp = $('#udp').val();
	var user = $('#user').val();
	var pass = $('#pass').val();
	var proxy = $('#proxy').val();
	var pp = $('#pp').val();
	var bug = $('#bug').val();
	var payload = $('#payload').val();
	if (host && port && udp && user && pass) {
		$.ajax({
			url: 'api.php',
			type: 'POST',
			data: {
				action: 'saveConfig',
				met: met + '|' + modeconfig,
				pillstl: pillstl,
				host: host,
				port: port,
				udp: udp,
				user: user,
				pass: pass,
				proxy: proxy,
				pp: pp,
				bug: bug,
				payload: payload
			},
			beforeSend: function () {
				$('#saveConfig').attr('disabled', true);
			},
			success: function (response) {
				$('#saveConfig').attr('disabled', false);
				alert(response);
			}
		});
	} else {
		alert("Harap Isi Semua");
	}
}

function autoBootRecon(val) {
	option = val ? 'on' : 'off';
	$.ajax({
		url: 'api.php',
		type: 'POST',
		data: {
			action: 'autoBootRecon',
			option: option
		},
		beforeSend: function () {
			$('#start').attr('disabled', true);
			$('#stop').attr('disabled', true);
			$('#autoBootRecon').attr('disabled', true);
		},
		success: function (response) {
			if (!$("#start").is(":disabled")) $('#start').attr('disabled', false);
			$('#stop').attr('disabled', false);
			$('#autoBootRecon').attr('disabled', false);
			alert(response);
		}
	});
}

function mode(val) {
	switch (val) {
		case "http":
			$("#dBug").hide();
			$("#dProxy, #dPP, #dPayload").show();
			modeconfig = "1";
			break;
		case "https":
			$("#dBug").show();
			$("#dProxy, #dPP, #dPayload").hide();
			modeconfig = "2";
			break;
		case "direct":
			$("#dBug, #dProxy, #dPP").hide();
			$("#dPayload").show();
			modeconfig = "0";
			break;
		case "sp":
			$("#dBug, #dPayload").show();
			$("#dProxy, #dPP").hide();
			modeconfig = "3";
			break;
	}
	return;
}