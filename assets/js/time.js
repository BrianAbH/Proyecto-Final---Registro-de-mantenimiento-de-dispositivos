document.addEventListener('DOMContentLoaded', function() {
    const alert = document.querySelector('.alert-dismissible');
    if (alert) {
        setTimeout(() => {
            // Quitar clase 'show' para iniciar la transición
            alert.classList.remove('show');
            
            // Esperar la transición de Bootstrap (0.15s por defecto) antes de remover del DOM
            setTimeout(() => {
                alert.remove();
                //window.location.href = "index.php?accion=datoscliente";
            }, 150); 
        }, 4000);
    }
});

