//
function highlight_div(checkbox_node)
{
	label_node = checkbox_node.parentNode;

	if (checkbox_node.checked){
		label_node.style.backgroundColor = '#F1DCB4';
	} else {
		label_node.style.backgroundColor = '#E5E5E5';
	}
}
//
function selAllProyectos()
{
	var xcheckbox = '';
	var proyectos = document.getElementsByName('proyectos[]');
	
	for (var i=0; i<proyectos.length; i++)
	{
		proyectos[i].checked = true;
		highlight_div(proyectos[i]);
	}
}