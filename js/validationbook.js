$(document).ready(function () {
	//if this page is load to browser then execute this code(call back functions)
	$('form').submit(function () {
		// this is happenning when submit button is clicked

		var isbn = $('#isbn').val(); //val is use to getting value of inside element
		var book_title = $('#book_title').val(); //get the value of the input feild with the id $user_email
		var author_name = $('#author_name').val(); //get the value of the input feild with the id $user_nic

		if (isbn == '') {
			$('#isbnerr').text('Empty ISBN'); //if fname is empty then do this
			$('#isbn').css('border-color', 'red');
			$('#isbn').focus(); //focus the pointer to the relevent input feild
			return false; // is yes then dont go to server
		}

		if (book_title == '') {
			$('#titleerr').text('Empty Title Please Fill');
			$('#book_title').css('border-color', 'red');
			$('#book_title').focus();
			return false; // i
		}

		if (author_name == '') {
			$('#authorerr').text('Author Feild Empty'); //if fname is empty then do this
			$('#author_name').css('border-color', 'red');
			$('#author_name').focus(); //focus the pointer to the relevent input feild
			return false; // is yes then dont go to server
		}
	});

	$('#isbn').keypress(function () {
		$('#isbnerr').text(''); //to delete error message after enter a text
		$('#isbn').css('border-color', 'grey');
	});

	$('#book_title').keypress(function () {
		$('#titleerr').text(''); //to delete error message after enter a text
		$('#book_title').css('border-color', 'grey');
	});

	$('#author_name').keypress(function () {
		$('#authorerr').text(''); //to delete error message after enter a text
		$('#author_name').css('border-color', 'grey');
	});
});
