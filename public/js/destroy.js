function confirmarEliminacao() {
    const select = document.getElementById('idTournament');
    const id = select.value;

    if (confirm("Estas seguro que quieres eliminar este torneo?")) {
        const form = document.getElementById('form-eliminar');
        // Actualiza el action del formulario con la ID correcta
        form.action = `/dados/${id}`;
        form.submit();
    }
}
