$(document).ready(function(){
	$("#idbusqueda").keyup(function(e){
		if(e.keyCode==13){
			search_producto();
		}
	});
});
function search_producto(){
	window.location.href="busqueda.php?text="+$("#idbusqueda").val();
}
document.getElementById('search-form').addEventListener('submit', function(event) {
    event.preventDefault();  // Previene el envío del formulario

    const query = document.querySelector('input[name="query"]').value;
    fetch(`search.php?query=${encodeURIComponent(query)}`)
        .then(response => response.text())
        .then(data => {
            document.getElementById('search-results').innerHTML = data;
        })
        .catch(error => {
            console.error('Error:', error);
        });
});