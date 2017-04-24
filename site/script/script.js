function showHideMenu(){
	$(".page").toggle();
}

function signin(){
	$.ajax({
    type: "POST",
    url: '/action/signin',
    data: { "username": $("#username").val(), "password": $("#password").val(), "setcookie": "yes" },
    success: function(data){
			if (data.result == "good"){				
					window.location.href = "/"; 
			}
			else{
				alert ('Unsuccessful');				
			}
		},
    dataType: 'json'
  });
}