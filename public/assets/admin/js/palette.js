// JavaScript Document
timer=0;
base_url='../core/ajax/';

function getColor(flagID){
	switch(flagID){
		case 1:
			return "#FFD800"; break;
		case 2:
			return "#FF0000"; break;
		case 3:
			return "#00FF21"; break;
		default:
			return "#edefee"; break;
	}
}

function getPalette(id){
	HidePalette();
	$("#divPalette").html('<table cellspacing="1" cellpadding="1"><tr>'+
		'<td style="background-color:'+getColor(1)+'"><a href="javascript:;" onclick="pickColor('+id+', 1)" title="Amarillo">&nbsp;</a></td>'+
		'<td style="background-color:'+getColor(2)+'"><a href="javascript:;" onclick="pickColor('+id+', 2)" title="Rojo">&nbsp;</a></td>'+
		'<td style="background-color:'+getColor(3)+'"><a href="javascript:;" onclick="pickColor('+id+', 3)" title="Verde">&nbsp;</a></td>'+
		'<td style="background-color:'+getColor(0)+'"><a href="javascript:;" onclick="pickColor('+id+', 0)" title="Ninguno">&nbsp;</a></td>'+
		'</tr></table>');
	var pX=getPositionX();
	var pY=getPositionY();
	$("#divPalette").css("left",pX+7);
	$("#divPalette").css("top",pY-8);
	$("#divPalette").fadeIn();
	
	$("#divPalette").mouseover(function(){
		timer=0;
	});

	$("#divPalette").mouseout(function(){
		timer=1;
		var t=setTimeout("HidePalette();",2000);
	});

}
function HidePalette(){
	if(timer==1){
		$("#divPalette").hide('fast');
		timer=0;
	}
}
function pickColor(denunciaID, flagID){
	
	//alert(base_url+'denuncia.php?cmd=setflag&dID='+denunciaID+'&fID='+flagID+'&callback=?');
	//location.href=base_url+'denuncia.php?cmd=setflag&dID='+denunciaID+'&fID='+flagID+'&callback=?';
	$.getJSON(base_url+'denuncia.php?cmd=setflag&dID='+denunciaID+'&fID='+flagID+'&callback=?', function(data)
	{
		if(data.resp=='0'){
			alert('Ha ocurrido un error en la aplicación, inténtelo mas tarde \n'+data.err);
			return;
		}
		else
		{
			$("#tr_"+denunciaID+" td").css('background-color', getColor(flagID));
			$("#divPalette").hide('fast');
		}

	});

}
