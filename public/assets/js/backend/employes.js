/*document.addEventListener('DOMContentLoaded', function () {
    // Capture l'ID de l'employé pour le modal
    document.querySelectorAll('.reset-password-link').forEach(link => {
        link.addEventListener('click', function () {
            const employeeId = this.getAttribute('data-id');
            document.getElementById('employeeId').value = employeeId;
        });
    });

    // Envoie le mot de passe réinitialisé en Ajax
    document.getElementById('submitResetPassword').addEventListener('click', function () {
        const employeeId = document.getElementById('employeeId').value;
        const newPassword = document.getElementById('newPassword').value;

        fetch('index.php?action=resetEmployeePassword', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                employee_id: employeeId,
                new_password: newPassword
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Mot de passe réinitialisé avec succès');
                document.getElementById('resetPasswordForm').reset();
                const modal = bootstrap.Modal.getInstance(document.getElementById('modalMdp'));
                modal.hide();
            } else {
                alert('Erreur : ' + data.message);
            }
        })
        .catch(error => console.error('Erreur:', error));
    });
});*/