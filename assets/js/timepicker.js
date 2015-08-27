function constructTimepicker() {
	var timepicker = $('timepicker');
	var fieldName = timepicker.attr('name');
	timepicker.removeAttr('name');
	
	var inputGroup = $('<div class="input-group">');
	inputGroup.append('<input class="form-control" type="text" name="' + fieldName + '" readonly/>');
	var inputGroupSpan = $('<span class="input-group-btn">');
	var inputGroupButton = $('<button class="btn btn-primary" type="button">');
	inputGroupButton.append('<i class="fa fa-calendar">');
	inputGroupSpan.append(inputGroupButton);
	inputGroup.append(inputGroupSpan);
	inputGroupButton.click(showTimepicker);
	timepicker.append(inputGroup);
	
	var tanggal = ['','',''];
	var waktu = ['',''];
	if (timepicker.attr('value') != '') {
		var timepickerValue = timepicker.attr('value').split(' ');
		tanggal = timepickerValue[0].split('/');
		waktu = timepickerValue[1].split(':');
	}
	var panel = $('<div class="panel panel-default" style="display:none; z-index: 10; min-width: 300px; width: inherit; position:absolute;">');
	var panelBody = $('<div class="panel-body" style="box-shadow: 2px 2px 3px 1px #aaa">');
	var formTanggal = $('<div class="form form-inline">');
	var closeButton = $('<button type="button" style="background: transparent; border: none; height: 20px; position:absolute; top:0; right:0;"><i class="fa fa-times"></i></button>');
	closeButton.click(dismissTimepicker);
	panel.append(closeButton);
	formTanggal.append('<input class="form-control timepicker-tanggal" maxlength="2" placeholder="Tanggal" style="width: 30%; margin-right: 2%;" value="' + tanggal[0] +'">');
	formTanggal.append('<input class="form-control timepicker-bulan" maxlength="2" placeholder="Bulan" style="width: 30%; margin-right: 2%;" value="' + tanggal[1] +'">');
	formTanggal.append('<input class="form-control timepicker-tahun" placeholder="Tahun" style="width: 30%;" value="' + tanggal[2] +'">');
	panelBody.append(formTanggal);
	panelBody.append('<hr/>');
	var formWaktu = $('<div class="form form-inline">');
	formWaktu.append('<input class="form-control timepicker-jam" maxlength="2" placeholder="Jam" style="width: 30%; margin-left: 20%; margin-right: 2%;" value="' + waktu[0] +'">');
	formWaktu.append('<input class="form-control timepicker-menit" maxlength="2" placeholder="Menit" style="width: 30%;" value="' + waktu[1] +'">');
	panelBody.append(formWaktu);
	panelBody.append('<div style="text-align: center"><br/><strong class="timepicker-warning" style="color: red; display: none;">Tanggal / waktu tidak valid!</strong></div>')
	panel.append(panelBody);
	timepicker.append(panel);
}
function showTimepicker(event) {
	var button = $(event.currentTarget);
	var timepicker = button.parent().parent().parent();
	var panel = $(timepicker.children()[1]);
	panel.show();
	button.empty();
	button.text('OK');
	button.off('click');
	button.click(submitTimepicker);
}
function submitTimepicker(event) {
	var button = $(event.currentTarget);
	var timepicker = button.parent().parent().parent();
	var panel = $(timepicker.children()[1]);
	var tanggal = parseInt(panel.find('.timepicker-tanggal')[0].value);
	var bulan = parseInt(panel.find('.timepicker-bulan')[0].value);
	var tahun = parseInt(panel.find('.timepicker-tahun')[0].value);
	var jam = parseInt(panel.find('.timepicker-jam')[0].value);
	var menit = parseInt(panel.find('.timepicker-menit')[0].value);
	if (cek_tanggal(tanggal, bulan, tahun) && cek_waktu(jam, menit)) {
		panel.hide();
		button.empty();
		button.append('<i class="fa fa-calendar">');
		button.off('click');
		button.click(showTimepicker);
		$(timepicker.find('.timepicker-warning')[0]).hide();
		cetak_waktu($(timepicker.find('input')[0]), tanggal, bulan, tahun, jam, menit);
	}
	else {
		$(timepicker.find('.timepicker-warning')[0]).show();
	}
}
function dismissTimepicker(event) {
	var button = $(event.currentTarget).parent().siblings().find('button')[0];
	button = $(button);
	button.append('<i class="fa fa-calendar">');
	button.off('click');
	button.click(showTimepicker);
	var panel = $(event.currentTarget).parent();
	panel.hide();
}
function cek_tanggal(tanggal, bulan, tahun) {
   var now = new Date();
   if (tanggal > 0 && bulan > 0 && tahun > 0) {
      var date = new Date(tahun, bulan-1, tanggal);
      if (date.getTime() < now.getTime() &&
          date.getDate() == tanggal &&
          date.getMonth() == bulan-1 &&
          date.getFullYear() == tahun
      ) {
        	return true;
      }
		return false;
   }
	return false;
}
function cek_waktu(jam, menit) {
	if (jam >= 0 && jam < 24 && menit >= 0 && menit < 60) {
		return true;
	}
	return false;
}
function cetak_waktu(timepicker_field, tanggal, bulan, tahun, jam, menit) {
	if (tanggal < 10) {
		tanggal = "0" + tanggal;
	}
	if (bulan < 10) {
		bulan = "0" + bulan;
	}
	if (jam < 10) {
		jam = "0" + jam;
	}
	if (menit <10) {
		menit = "0" + menit;
	}
	timepicker_field.val(tanggal + '/' + bulan + '/' + tahun + ' ' + jam + ':' + menit);
}