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
var sort_by = function(field, reverse, primer)
{
	reverse = (reverse) ? -1 : 1;

	return function(a,b) {
   a = a[field];
   b = b[field];

   if (typeof(primer) != 'undefined') {
     a = primer(a);
     b = primer(b);
   }
   if (a<b) return reverse * -1;
   if (a>b) return reverse * 1;

   return 0;
	}
}