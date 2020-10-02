userReadOnly=false;
msgUserError="Acceso limitado, no tiene los permisos necesarios para realizar esta acci\xF3n.";

function submitForm(action){
	$('#frmMain').attr('action', (typeof(action)!='undefined')? action: '');
	$('#frmMain').submit();
}

function Search(){
	$('#FormView').val('list');
	$('#Command').val('');
	$('#Page').val('0');
	submitForm();
}

function MovePg(nPage){
	$('#FormView').val('list');
	$('#Command').val('');
	$('#Page').val(nPage);
	submitForm();
}

function OrderBy(sort){
	$('#OrderBy').val(sort);
	submitForm();
}

function addNew(){
	if(userReadOnly) { alert(msgUserError); return;}
	$('#kID').val('');
	$('#FormView').val('add');
	submitForm();
}

function Edit(kID){
	if(userReadOnly) { alert(msgUserError); return;}
	$('#kID').val(kID);
	$('#FormView').val('edit');
	submitForm();
}

function View(kID){
	$('#kID').val(kID);
	$('#FormView').val('view');
	submitForm();
}

function Export(){
	$('#FormView').val('xls');
	submitForm("&callback=true");
}

function moveUp(kID){
	if(userReadOnly) { alert(msgUserError); return;}
	$('#kID').val(kID);
	$('#Command').val('moveUp');
	submitForm();
}

function Back(view){
	$('#kID').val('');
	$('#FormView').val((typeof(view)!='undefined')? view: 'list');
	$('#Command').val('');
	submitForm();
}

function Delete(kID){
	if(userReadOnly) { alert(msgUserError); return;}
	if(confirm("\xBFEsta seguro que desea eliminar este Item?")){
		$('#kID').val(kID);
		$('#FormView').val('list');
		$('#Command').val('delete');
		submitForm();
	}
}

function Print(){
	window.print();
}

function Close(){
	window.close();
}

function validateEmail(valor) {
  if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(valor))
    return true;
  else
    return false;
}

function BrowseImages(pInput, path){
	window.open("../assets/plugins/filemanager/index.php?pForm="+pInput+"&pDirectory="+path,"buscar","top=50,left=100,width=501,height=326,status=yes",1,-1);
}

function loadScript(file){
  var js=document.createElement('script')
  js.setAttribute("type","text/javascript")
  js.setAttribute("src", file)
}

function getPositionX(e) {
	var posx = 0;
	if (!e) var e = window.event;
	if (e.pageX) posx = e.pageX;
	else if (e.clientX)
		posx = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
return posx;
}

function getPositionY(e) {
var posy = 0;
	if (!e) var e = window.event;
	if (e.pageY) posy = e.pageY;
	else if (e.clientY)
		posy = e.clientY + document.body.scrollTop + document.documentElement.scrollTop;
return posy;
}

$(document).ready(function() {
	$("#title").focus();
	$('form,input,select,textarea').attr("autocomplete", "off");
	
	if($('#userName').val()==""){
    	setTimeout('$("#userName, #password").val("");', 50); 
	}
});
