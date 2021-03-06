$(function(){
	var error = 0;

	$('input[name=participation]').click(participationChange);
	$('input[name=organisation]').click(participationChange2);

	$('#form').submit(function(){
		$('input').each(function(){
			error = 0;
			value = $(this).val();
			type = $(this).attr('input-type');
			title = $(this).attr('title');
			self = $(this);
			check = checkInput(value, type, title, self);
			
			 
			if(check.check == true || check == true) {

			}else{
				$('#msg-div span span').html(check.message);
				$('#msg-div').fadeIn();
				error = 1;
				return false;
				throw BreakException;
			}
		});
		
	
		
		if(error == 0) {
			$.ajax({
				url:'traitement.php',
				type:'POST',
				data: $('#form').serialize(),
				dataType: 'html',

				success: function(retour){
					console.log(retour);
					if(retour == "true") {
						$('#msg').removeClass('warning');
						$('#msg').addClass('success');
						$('#msg-div span span').html('Votre inscription a bien été prise en compte, nous vous en remercions');
						$('#msg-div').fadeIn();
						closeForm();
					}else if(retour == "loginTrue"){
						window.location.href="inscription.php";
					}else if(retour == "loginFalse"){
						$('#msg').removeClass('success');
						$('#msg').addClass('warning');
						$('#msg-div span span').html('Vos informations de connexion sont incorrectes');
						$('#msg-div').fadeIn();
					}else{
						$('#msg').removeClass('success');
						$('#msg').addClass('warning');
						$('#msg-div span span').html('Une erreur inconnue s\'est produite');
						$('#msg-div').fadeIn();
					}
				},

				error: function() {
		
				}

			});
		}else{
			// On ne fait rien
		}
		return false;
	});


	checkRadio = 0;
	compteurRadio = 0;
	checkCheckbox = 0;
	compteurCheckbox = 0;
	function checkInput(value, type, title, self) {
		
		switch(type) {
			case 'email':
				emailRegEx = /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/;
				checking = emailRegEx.test(value);
				message = 'L\'adresse email n\'est pas valide';
				return {"check": checking, "message": message};
				break;
			case 'phone':
				phoneRegEx = /^(0|\+33)[1-9]([-. ]?[0-9]{2}){4}$/;
				checking = phoneRegEx.test(value);
				message = 'Le numéro de téléphone n\'est pas valide';
				return {"check": checking, "message": message};
				break;
			case 'empty':
				if(value == '' || value == undefined) {
					message = 'Attention, vous n\'avez pas rempli le champ '+title+'';
					checking = false;
				}else{
					checking = true;
					message = "";
				}
				return {"check": checking, "message": message};	
				break;
			case 'radio':

				if(self.is(':checked')) {
					checkRadio++;
				}
				compteurRadio++;

				if(compteurRadio == 1) {
					return true;	
				}
				
				if(compteurRadio == 2) {
					if(checkRadio == 0) {
						checkRadio = 0;
						compteurRadio = 0;
						return {"check": false, "message": "Attention, vous n\'avez pas confirmé votre participation"};	
					}else{
						checkRadio = 0;
						compteurRadio = 0;
						return true;			
					}
				}	
				break;
			case 'radio2':

				console.log('Radio2 '+ checkRadio + ' / '+ compteurRadio );
				
				if(self.is(':checked')) {
					checkRadio++;
				}
				compteurRadio++;

				if(compteurRadio < 6) {
					return true;	
				}
				
				if(compteurRadio >= 6) {
					if(checkRadio == 0) {
						checkRadio = 0;
						compteurRadio = 0;
						
						return {"check": false, "message": "Attention, vous n\'avez pas confirmé vos dates"};	
					}else{
						checkRadio = 0;
						compteurRadio = 0;
						return true;			
					}
				}	
				break;
			case 'radio3':

				if(self.is(':checked')) {
					checkRadio++;
				}
				compteurRadio++;

				if(compteurRadio == 1) {
					return true;	
				}
				
				if(compteurRadio == 2) {
					if(checkRadio == 0) {
						checkRadio = 0;
						compteurRadio = 0;
						return {"check": false, "message": "Attention, vous n\'avez pas confirmé si vous organisiez des événements ou non"};	
					}else{
						checkRadio = 0;
						compteurRadio = 0;
						return true;			
					}
				}	
				break;			
				
				
				
			case 'checkbox':
				if(self.is(':checked')) {
					checkCheckbox++;
				}
				compteurCheckbox++;

				if(compteurCheckbox == 1) {
					return true;	
				}
				
				if(compteurCheckbox == 2) {
					if(checkCheckbox == 0) {
						checkCheckbox = 0;
						compteurCheckbox = 0;
						return {"check": false, "message": "Attention, vous n\'avez pas confirmé votre participation aux activités"};	
					}else{
						checkCheckbox = 0;
						compteurCheckbox = 0;
						return true;			
					}
				}	
				break;	
			default:
				return true;
				break;
		}
	}


	function participationChange() {
		value = $(this).val();
		if(value == "non") {
			$('.show').fadeOut();
			$('.show2').fadeOut();
			$('.participation-no').fadeIn();	
		}else{
			$('.participation-no').fadeOut();
			$('.show').fadeIn();
		}
	}

	function participationChange2() {
		value = $(this).val();
		if(value == "non") {
			$('.show2').fadeOut();	
		}else{
			$('.show2').fadeIn();
		}
	}
	
	$('#tierce').change(function() {
		value = $(this).val();
		if(value == "Je ne pourrai me rendre disponible et serai représentée") {
			$(".reset-tierce").val("");
		}
	});
	
	$('.inputcontact').change(function() {
		value = $(this).val();
		if(value != "date5") {
			$(".showcontact").fadeIn();
			$(".showacc").fadeIn();
		}
		if(value == "date5") {
			$(".showcontact").fadeOut();
			$(".showacc").fadeOut();
			$(".reset-acc").val("");
		}
	});

	function closeForm() {
		$('#form p').not('#msg-div').fadeOut();
	}

});