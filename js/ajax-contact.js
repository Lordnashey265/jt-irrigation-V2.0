//function sendEmail()
//{
//	var name;
//	var email;
//	var subject;
//	var mobile;
//	var message;
//	if (window.XMLHttpRequest)
//	{
//		// code for IE7+, Firefox, Chrome, Opera, Safari
//		xmlhttp=new XMLHttpRequest();
//	} 
//	else 
//	{   // code for IE6, IE5
//		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
//	}
//	xmlhttp.onreadystatechange=function() 
//	{
//		if (xmlhttp.readyState==4 && xmlhttp.status==200) 
//		{
//			var msg=xmlhttp.responseText;
//			
//			var result=document.getElementById("results");
//			result.classList.add("form-message-success"); 
//			result.innerHTML="Login Success, Please wait...";
//		}
//	}
//	name=document.getElementById("name").value;
//	email=document.getElementById("email").value;
//	subject=document.getElementById("subject").value;
//	phone=document.getElementById("phone").value;
//	message=document.getElementById("message").value;
//
//	xmlhttp.open("POST","php/contact.php",true);
//	xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
//	xmlhttp.send("name=" + name + "&email=" + email + "&subject=" + subject + "&phone=" + phone + "&message=" + message);
//}

//$(function() {
//
//	// Get the form.
//	var form = $('#contact-form');
//
//	// Get the messages div.
//	var formMessages = $('.form-message');
//
//	// Set up an event listener for the contact form.
//	$(form).submit(function(e) {
//		// Stop the browser from submitting the form.
//		e.preventDefault();
//
//		// Serialize the form data.
//		var formData = $(form).serialize();
//
//		// Submit the form using AJAX.
//		$.ajax({
//			type: 'POST',
//			url: $(form).attr('action'),
//			data: formData
//		})
//		.done(function(response) {
//			// Make sure that the formMessages div has the 'success' class.
//			$(formMessages).removeClass('error');
//			$(formMessages).addClass('success');
//
//			// Set the message text.
//			$(formMessages).text(response);
//
//			// Clear the form.
//			$('#contact-form input,#contact-form textarea').val('');
//		})
//		.fail(function(data) {
//			// Make sure that the formMessages div has the 'error' class.
//			$(formMessages).removeClass('success');
//			$(formMessages).addClass('error');
//
//			// Set the message text.
//			if (data.responseText !== '') {
//				$(formMessages).text(data.responseText);
//			} else {
//				$(formMessages).text('Oops! An error occured and your message could not be sent.');
//			}
//		});
//	});
//});