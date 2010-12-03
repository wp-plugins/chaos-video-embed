function copyToClipboard(txt) {
	switchEditors.go('content', 'html');
	
	var appendText = "[mcmplayer objectId=\"" + txt + "\"]";

	insertAtCursor(edCanvas, appendText);

}





function insertAtCursor(myField, myValue) {
	//IE support
	if (document.selection) {
		myField.focus();
		sel = document.selection.createRange();
		sel.text = myValue;
	}
	//MOZILLA/NETSCAPE support
	else if (myField.selectionStart || myField.selectionStart == "0") {
		var startPos = myField.selectionStart;
		var endPos = myField.selectionEnd;
		myField.value = myField.value.substring(0, startPos)
		+ myValue
		+ myField.value.substring(endPos, myField.value.length);
	} 
	else {
		myField.value += myValue;
	}
}
// calling the function
