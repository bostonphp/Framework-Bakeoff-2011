var toggleApproval = function toggleApproval() {
	var button = document.getElementById('approval_button');
	button.disabled = !button.disabled;
}

function hookCheckboxToApproval() {
	var checkbox = document.getElementById('is_not_spam');
	checkbox.onclick = toggleApproval;
}

function hookSelectOnFocus() {
	var input = document.getElementById('name');
	input.onclick = input.select;
	
	input = document.getElementById('email');
	input.onclick = input.select;
	
	input = document.getElementById('company');
	input.onclick = input.select;
	
	input = document.getElementById('location');
	input.onclick = input.select;
}

window.onload = function onload() {
	hookCheckboxToApproval();
	hookSelectOnFocus();
}