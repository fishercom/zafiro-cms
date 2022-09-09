//forms actions

window.onload = function() {
	init();
};

init=()=>{
	const frm_contact = document.getElementById('frm_contact');

	if(frm_contact){
		frm_contact.addEventListener('submit', submit_form);
		Array.from(frm_contact.elements).forEach(element => {
			element.addEventListener('change', (e)=>{
				validateElem(e.target);
			});
			if(element.type && element.type!='checkbox'){
				element.addEventListener('keyup', (e)=>{
					validateElem(e.target);
				});
			}
		});	
	}
}

validateElem = (element)=>{
	if(element.classList.contains('required')){
		if((element.value=="" && element.type!='checkbox') || (element.type=='checkbox' && !element.checked)){
			if(element.type=='checkbox')
				element.parentElement.parentElement.querySelector('.label-err').classList.remove("d-none");
			else
				element.parentElement.querySelector('.label-err').classList.remove("d-none");
			
			return false;
		}
		else{
			if(element.type=='checkbox')
				element.parentElement.parentElement.querySelector('.label-err').classList.add("d-none");
			else
				element.parentElement.querySelector('.label-err').classList.add("d-none");
		}	
	}

	return true;
}

validateForm = (form)=>{
	let errors = 0;

	Array.from(form.elements).forEach(element => {
		if(!validateElem(element)) errors++;
	});

	return errors==0;
}

submit_form = async (e)=>{
	e.preventDefault();

	if(!validateForm(e.target)) return false;

	const form = e.target;
	const url = form.getAttribute('action');
	const params = new FormData(form);

	const message = document.querySelector('.form-message');
	const submit = document.querySelector('button[type=submit]');
    const lblsubmit = submit.innerHTML;
    const lblsending = submit.getAttribute('sending');

	if(submit.innerHTML==lblsending) return false;

	submit.innerHTML=lblsending;

	post_form(url, params, function(data){
		console.log(data);
		submit.innerHTML=lblsubmit;
		form.classList.add('d-none');
		message.classList.remove('d-none');
		//window.scrollTo(0, 0);
	});

  return false;

}

post_form = (url, params, callback)=>{
	fetch(url, {
		method: 'POST',
		body: params,
		mode: "no-cors",
		cache: "no-cache",
		credentials: "same-origin",
		headers: {
			"Content-Type": "application/json",
		},
	})
	.then(response => response.json())
	.then(data => callback(data))
	.catch(error => {
		console.error(error);
		alert(error);
	});
}
