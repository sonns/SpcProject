function notify(style,data) {
	if(style == "error"){
		icon = "fa fa-exclamation";
	}else if(style == "warning"){
		icon = "fa fa-warning";
	}else if(style == "success"){
		icon = "fa fa-check";
	}else if(style == "info"){
		icon = "fa fa-question";
	}else{
		icon = "fa fa-circle-o";
	}

    $.notify({
        title: (data.hasOwnProperty('title')) ? data.title : '',
        text: (data.hasOwnProperty('message')) ? data.message : '',
        image: "<i class='"+icon+"'></i>"
    }, {
        style: 'metro',
        className: style,
        globalPosition:(data.hasOwnProperty('position')) ? data.position : 'top right',
        showAnimation: "show",
        showDuration: 0,
        hideDuration: 0,
        autoHideDelay: 4000,
        autoHide: true,
        clickToHide: true
    });
}
