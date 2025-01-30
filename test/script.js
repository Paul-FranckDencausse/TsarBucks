document.getElementById('registrationForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Empêche le rechargement de la page

    // Récupérer les valeurs du formulaire
    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    // Vérifier si l'utilisateur existe déjà
    const existingUsers = JSON.parse(localStorage.getItem('users')) || [];

    if (existingUsers.find(user => user.email === email)) {
        alert('Un utilisateur avec cet email existe déjà.');
        return;
    }

    // Ajouter l'utilisateur au tableau
    existingUsers.push({ username, email, password });
    localStorage.setItem('users', JSON.stringify(existingUsers));

    alert('Inscription réussie ! Vous pouvez maintenant vous connecter.');
    // Rediriger vers la page de connexion
    window.location.href = 'login.html';
});
